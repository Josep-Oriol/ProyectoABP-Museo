<?php
require_once "Database.php";

class Busquedas extends Database{
    public function busquedaExposiciones($pagina, $input, $filtro, $paginar){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, 
                e.fecha_inicio_exposicion, e.fecha_fin_exposicion
                FROM $pagina e 
                WHERE (e.texto_exposicion LIKE '%$input%'
                OR e.lugar_exposicion LIKE '%$input%'
                OR e.fecha_inicio_exposicion LIKE '%$input%'
                OR e.fecha_fin_exposicion LIKE '%$input%'
                OR e.tipo_exposicion LIKE '%$input%')
                $filtro $paginar";
        
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
        $sql = "SELECT o.fotografia, o.numero_registro, o.nombre_objeto, o.titulo, o.autor, 
                o.anyo_final, u.descripcion_ubicacion 
                FROM obras o 
                INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
                INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion 
                WHERE (o.numero_registro LIKE :input
                OR o.nombre_objeto LIKE :input
                OR o.titulo LIKE :input
                OR o.autor LIKE :input
                OR o.anyo_final LIKE :input
                OR u.descripcion_ubicacion LIKE :input)
                $filtro $paginar";
                
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $inputParam = "%$input%";
            $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

public function busquedaUsuarios($pagina, $input, $filtro, $paginar){
    $sql = "SELECT id_usuario, foto_usuario, usuario, nombre, apellidos, correo_electronico, 
            telefono, rol, estado 
            FROM $pagina u 
            WHERE (u.id_usuario LIKE :input
            OR u.usuario LIKE :input
            OR u.nombre LIKE :input
            OR u.apellidos LIKE :input
            OR u.correo_electronico LIKE :input
            OR u.telefono LIKE :input
            OR u.rol LIKE :input
            OR u.estado LIKE :input)
            $filtro $paginar";
            
    $db = $this->conectar();
    try{
        $query = $db->prepare($sql);
        $inputParam = "%$input%";
        $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
        $query->execute();
    }
    catch(PDOException $error){
        echo $error->getMessage();
    }
    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

    function busquedaCopias($pagina, $input, $filtro, $paginar){

        $filtro = str_replace("fecha", "fecha_copia", $filtro);
        $filtro = str_replace("nombre", "nombre_copia", $filtro);
        $filtro = str_replace("descripcion", "descripcion_copia", $filtro);
        $filtro = str_replace("cs.creador", "u.nombre", $filtro);

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

    function busquedaRestauraciones($pagina, $input, $filtro, $paginar){
        $filtro = str_replace("numero_registre", "id_restauracion", $filtro);
        $filtro = str_replace("nom_restaurador", "nombre_restaurador", $filtro);
        $filtro = str_replace("data_fi", "fecha_fin_restauracion", $filtro);
        $filtro = str_replace("data_inici", "fecha_inicio_restauracion", $filtro);
        $filtro = str_replace("comentari", "comentario_restauracion", $filtro);
        $filtro = str_replace("r.obra", "o.titulo", $filtro);
    
        $sql = "SELECT r.id_restauracion, r.comentario_restauracion, r.nombre_restaurador, 
                r.fecha_inicio_restauracion, r.fecha_fin_restauracion
                FROM restauraciones r 
                INNER JOIN obras_restauraciones ro ON ro.fk_restauracion = r.id_restauracion
                INNER JOIN obras o ON ro.fk_obra = o.numero_registro 
                WHERE (r.id_restauracion LIKE :input
                OR r.comentario_restauracion LIKE :input
                OR r.nombre_restaurador LIKE :input
                OR r.fecha_inicio_restauracion LIKE :input
                OR r.fecha_fin_restauracion LIKE :input)
                $filtro $paginar";
        
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $inputParam = "%$input%";
            $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    public function exportarObras($pagina, $input, $filtro, $paginar){
        $sql = "SELECT o.fotografia, o.numero_registro, o.nombre_objeto, o.titulo, o.autor, 
                o.anyo_final, u.descripcion_ubicacion 
                FROM obras o 
                INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
                INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion 
                WHERE (o.numero_registro LIKE :input
                OR o.nombre_objeto LIKE :input
                OR o.titulo LIKE :input
                OR o.autor LIKE :input
                OR o.anyo_final LIKE :input
                OR u.descripcion_ubicacion LIKE :input)
                $filtro $paginar";
                
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $inputParam = "%$input%";
            $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function exportarExposiciones($pagina, $input, $filtro, $paginar){
        $sql = "SELECT e.id_exposicion, e.texto_exposicion, e.lugar_exposicion, e.tipo_exposicion, 
                e.fecha_inicio_exposicion, e.fecha_fin_exposicion
                FROM $pagina e 
                WHERE (e.texto_exposicion LIKE '%$input%'
                OR e.lugar_exposicion LIKE '%$input%'
                OR e.fecha_inicio_exposicion LIKE '%$input%'
                OR e.fecha_fin_exposicion LIKE '%$input%'
                OR e.tipo_exposicion LIKE '%$input%')
                $filtro $paginar";
        
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
        $sql = "SELECT id_usuario, foto_usuario, usuario, nombre, apellidos, correo_electronico, 
        telefono, rol, estado 
        FROM $pagina u 
        WHERE (u.id_usuario LIKE :input
        OR u.usuario LIKE :input
        OR u.nombre LIKE :input
        OR u.apellidos LIKE :input
        OR u.correo_electronico LIKE :input
        OR u.telefono LIKE :input
        OR u.rol LIKE :input
        OR u.estado LIKE :input)
        $filtro $paginar";
                
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $inputParam = "%$input%";
            $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function exportarRestauraciones($pagina, $input, $filtro, $paginar){
        $sql = "SELECT r.id_restauracion, r.comentario_restauracion, r.nombre_restaurador, 
                r.fecha_inicio_restauracion, r.fecha_fin_restauracion
                FROM restauraciones r 
                INNER JOIN obras_restauraciones ro ON ro.fk_restauracion = r.id_restauracion
                INNER JOIN obras o ON ro.fk_obra = o.numero_registro 
                WHERE (r.id_restauracion LIKE :input
                OR r.comentario_restauracion LIKE :input
                OR r.nombre_restaurador LIKE :input
                OR r.fecha_inicio_restauracion LIKE :input
                OR r.fecha_fin_restauracion LIKE :input)
                $filtro $paginar";
        
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $inputParam = "%$input%";
            $query->bindParam(':input', $inputParam, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}

?>