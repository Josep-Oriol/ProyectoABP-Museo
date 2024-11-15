<?php
require_once "Database.php";
class Exposiciones extends Database{

    
    public function datosExposiciones(){
        $sql = "SELECT * FROM exposiciones";
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    
    public function eliminarExposicion($id){
        $db = $this->conectar();
        $sql = "UPDATE obras_exposiciones SET fk_exposicion = NULL WHERE fk_exposicion = $id";
        $sql2 = "DELETE FROM exposiciones WHERE id_exposicion = $id";
        try{
            $query = $db->prepare($sql);
            $query->execute();
            $query2 = $db->prepare($sql2);
            $query2->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }
    public function datosExposicion($id){
        $db = $this->conectar();
        $sql = "SELECT * FROM exposiciones WHERE id_exposicion = $id";
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editarExposicion($id, $array){
        $db = $this->conectar();
        $descripcio = $array['descripcio'];
        $lloc = $array['lloc'];
        $tipus = $array['tipus'];
        $inici = $array['inici'];
        $final = $array['final'];

        $sql = "UPDATE exposiciones SET texto_exposicion = '$descripcio', tipo_exposicion = '$tipus', lugar_exposicion = '$lloc', 
        fecha_inicio_exposicion = '$inici', fecha_fin_exposicion = '$final' WHERE id_exposicion = $id";

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    public function crearExposicion($array){
        $db = $this->conectar();
        $descripcio = $array['descripcio'];
        $lloc = $array['lloc'];
        $tipus = $array['tipus'];
        $inici = $array['inici'];
        $final = $array['final'];

        $sql = "INSERT INTO exposiciones (texto_exposicion, lugar_exposicion, tipo_exposicion, fecha_inicio_exposicion, fecha_fin_exposicion) VALUES('$descripcio', '$lloc', '$tipus', '$inici', '$final')";

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    public function seleccionarTipo(){
        $db = $this->conectar();
        $sql = "SELECT * FROM campos WHERE fk_vocabulario = 11";  //ID especifico, se considera que no se puede borrar
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $campos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $campos;
    }

    public function obrasRelacionadas($id){
        $db = $this->conectar();
        $sql = "SELECT * FROM obras o INNER JOIN obras_exposiciones oe ON o.numero_registro = oe.fk_obra
        INNER JOIN exposiciones e ON e.id_exposicion = oe.fk_exposicion WHERE e.id_exposicion = $id";

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function NumRegistroObrasRelacionadas($id){  //CONSULTA PARECIDA A LA ANTERIOR PERO MAS LIVIANA
        $db = $this->conectar();
        $sql = "SELECT fk_obra FROM obras_exposiciones WHERE fk_exposicion = $id";

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    
    public function eliminarRelaciones($obrasEnviadas, $obrasRelacionadas, $idExposicion){  //SE HARA ELIMINAR Y AÑADIR POR SEPARADO (SI NO HAY OBRAS RELACIONADAS NO RECORRE EL PRIMER FOREACH)
        
        $consulta = "DELETE FROM obras_exposiciones WHERE fk_obra IN (";
        $array = [];

        foreach($obrasRelacionadas as $indice => $obraRelacionada){
            $id = $obraRelacionada['fk_obra'];  //ID DE LA OBRA RELACIONADA QUE ESTA RECORRIENDO
            if(!in_array($id, $obrasEnviadas)){
                array_push($array, "'$id'"); //añade elementos al final del array
            }
        }
        if(!empty($array)){
            $array = implode(", ", $array); //crea el string separado por comas
            $consulta = $consulta.$array.")"." and fk_exposicion LIKE '$idExposicion'";

            $this->consultaEliminarRelaciones($consulta);
        }
    }

    public function consultaEliminarRelaciones($sql){
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    public function agregarRelaciones($obras, $idExposicion){
        $array = [];
        $consulta = "INSERT INTO obras_exposiciones (fk_obra, fk_exposicion) VALUES ";
        foreach($obras as $indice => $idObra){
            if(!$this->comprobarRelacionExiste($idObra, $idExposicion)){
                array_push($array, "('$idObra', '$idExposicion')");
            }
        }
        if(!empty($array)){
            $array = implode(", ", $array); //crea el string separado por comas
            $consulta = $consulta.$array;
            $this->consultaAgregarRelacion($consulta);
        }

    }

    public function consultaAgregarRelacion($sql){
        $db = $this->conectar();

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    public function comprobarRelacionExiste($idObra, $idExposicion){

        $existe = false;
        $db = $this->conectar();
        $sql = "SELECT * FROM obras_exposiciones WHERE fk_obra = '$idObra' and fk_exposicion = '$idExposicion'";

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($datos)){
            $existe = true;
        }
        return $existe;
    }

    public function consultaEliminarRelacionesFicha($idObra, $idExposicion){
        $db = $this->conectar();
        $sql = "DELETE FROM obras_exposiciones WHERE fk_obra = '$idObra' and fk_exposicion = '$idExposicion'";
        try{
            $query = $db->prepare($sql);
            $query->execute();
            $filas = $query->rowCount();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        return $filas;
    }

    public function busquedaExposiciones($pagina, $input, $filtro){
        $sql = "SELECT * FROM $pagina WHERE texto_exposicion LIKE '%$input%'";
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


}
?>