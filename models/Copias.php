<?php

require_once 'Database.php';

class Copias extends Database{

    function obtenerCopias(){
        $sql = 'SELECT * FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario';
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

    function crearCopia($array, $id) {
        $nombre = $array['nombre'];
        $descripcion = $array['descripcion'];
        $fecha = $array['fecha'];
        $creador = $id;

        $sql = 'INSERT INTO copias_seguridad (nombre_copia, descripcion_copia, fecha_copia, fk_creador)
        VALUE ($nombre, $descripcion, $fecha, $creador)';

        $db = $this->conectar();
        
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }
}