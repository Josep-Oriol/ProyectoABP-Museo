<?php
require_once "Database.php";

class Busquedas extends Database{
    public function busquedaExposiciones($pagina, $input, $filtro){
        $sql = "SELECT * FROM $pagina e WHERE $filtro LIKE '%$input%'";
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

    public function busquedaObras($pagina, $input, $filtro){
        $sql = "SELECT o.fotografia, o.numero_registro, o.nombre_objeto, o.titulo, o.autor, o.anyo_final, u.descripcion_ubicacion FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion $filtro AND o.numero_registro LIKE '%$input%'";
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
    public function busquedaUsuarios($pagina, $input, $filtro){
        $sql = "SELECT id_usuario, foto_usuario, usuario, nombre, apellidos, correo_electronico, telefono, rol, estado FROM $pagina u WHERE $filtro LIKE '%$input%'";
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