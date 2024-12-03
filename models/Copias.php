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
        $nombre = $array['nom'];
        $descripcion = $array['desc'];
        $fecha = $array['fecha'];
        $creador = $id;

        $exitoso = false;

        $sql = 'INSERT INTO copias_seguridad (nombre_copia, descripcion_copia, fecha_copia, fk_creador)
        VALUE (?, ? ,? , ?)';

        $db = $this->conectar();
        
        try {
            $query = $db->prepare($sql);
            $exitoso = $query->execute([$nombre, $descripcion, $fecha, $creador]);
        } catch (PDOException $error) {
            $exitoso = false;
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        return $exitoso;
    }

    public function mostrarCopia($numeroRegistro) {
		$sql = "SELECT * FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario WHERE id_copia = $numeroRegistro";
		
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}

		$resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editarCopia($array, $id) {
        $nombre = $array['nombre'];
        $descripcion = $array['descripcion'];
        $exitoso = false;

        $sql = "UPDATE copias_seguridad SET nombre_copia = ?, descripcion_copia = ? WHERE id_copia = ?";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $exitoso = $query->execute([$nombre, $descripcion, $id]);
            
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        return $exitoso;
    }
}