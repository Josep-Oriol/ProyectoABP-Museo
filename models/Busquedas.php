<?php
require_once "Database.php";

class Busquedas extends Database{
    public function busquedaExposiciones($pagina, $input, $filtro, $paginar){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, e.fecha_inicio_exposicion, e.fecha_fin_exposicion
        FROM $pagina e WHERE e.texto_exposicion LIKE '%$input%' $filtro $paginar";
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

    public function busquedaObras($pagina, $input, $filtro, $paginar){
        $sql = "SELECT o.fotografia, o.numero_registro, o.nombre_objeto, o.titulo, o.autor, o.anyo_final, u.descripcion_ubicacion FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion WHERE o.numero_registro LIKE '%$input%' $filtro $paginar";
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
    public function busquedaUsuarios($pagina, $input, $filtro, $paginar){
        $sql = "SELECT id_usuario, foto_usuario, usuario, nombre, apellidos, correo_electronico, telefono, rol, estado FROM $pagina u WHERE u.usuario LIKE '%$input%' $filtro $paginar";
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

    function busquedaCopias($pagina, $input, $filtro, $paginar){
        $sql = "SELECT cs.id_copia, cs.nombre_copia, cs.descripcion_copia, cs.fecha_copia, u.nombre FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario
        WHERE cs.nombre_copia LIKE '%$input%' $filtro $paginar";
        $db = $this->conectar();

        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    public function exportarObras($pagina, $input, $filtro, $paginar){
        $sql = "SELECT o.numero_registro, o.nombre_objeto, o.titulo, o.autor, o.anyo_final, u.descripcion_ubicacion FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion WHERE o.numero_registro LIKE '%$input%' $filtro $paginar";
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

    public function exportarExposiciones($pagina, $input, $filtro, $paginar){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, e.fecha_inicio_exposicion, e.fecha_fin_exposicion
        FROM $pagina e WHERE e.texto_exposicion LIKE '%$input%' $filtro $paginar";
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

    public function exportarUsuarios($pagina, $input, $filtro, $paginar){
        $sql = "SELECT id_usuario, usuario, nombre, apellidos, correo_electronico, telefono, rol, estado FROM $pagina u WHERE u.usuario LIKE '%$input%' $filtro $paginar";
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