<?php
require_once "Database.php";

class Busquedas extends Database{
    public function busquedaExposiciones($pagina, $input, $filtro){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, e.fecha_inicio_exposicion, e.fecha_fin_exposicion
        FROM $pagina e WHERE e.texto_exposicion LIKE '%$input%' $filtro";
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
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion WHERE o.numero_registro LIKE '%$input%' $filtro";
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
        $sql = "SELECT id_usuario, foto_usuario, usuario, nombre, apellidos, correo_electronico, telefono, rol, estado FROM $pagina u WHERE u.usuario LIKE '%$input%' $filtro";
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


    public function exportarObras($pagina, $input, $filtro){
        $sql = "SELECT o.numero_registro, o.nombre_objeto, o.titulo, o.autor, o.anyo_final, u.descripcion_ubicacion FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion WHERE o.numero_registro LIKE '%$input%' $filtro";
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

    public function exportarExposiciones($pagina, $input, $filtro){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, e.fecha_inicio_exposicion, e.fecha_fin_exposicion
        FROM $pagina e WHERE e.texto_exposicion LIKE '%$input%' $filtro";
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

    public function exportarUsuarios($pagina, $input, $filtro){
        $sql = "SELECT id_usuario, usuario, nombre, apellidos, correo_electronico, telefono, rol, estado FROM $pagina u WHERE u.usuario LIKE '%$input%' $filtro";
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