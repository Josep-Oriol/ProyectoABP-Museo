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
        $sql = "UPDATE obras SET FK_id_exposicion = NULL";
        $sql2 = "DELETE FROM exposiciones e WHERE ID_exposicion = $id";
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
        $sql = "SELECT * FROM exposiciones WHERE ID_exposicion = $id";
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

        $sql = "UPDATE exposiciones SET Texto_exposicion = '$descripcio', Tipo_exposicion = '$tipus', Lugar_exposicion = '$lloc', 
        Fecha_inicio_exposicion = '$inici', Fecha_fin_exposicion = '$final' WHERE ID_exposicion = $id";

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

        $sql = "INSERT INTO exposiciones (Texto_exposicion, Lugar_exposicion, Tipo_exposicion, Fecha_inicio_exposicion, Fecha_fin_exposicion) VALUES('$descripcio', '$lloc', '$tipus', '$inici', '$final')";

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
        $sql = "SELECT * FROM campos WHERE FK_vocabulario = 11";
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


}
?>