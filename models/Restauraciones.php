<?php
    require_once "Database.php";
    class Restauraciones extends Database{
        public function crear($datos){
            $comentario = $datos['comentario'];
            $nombre = $datos['nombre_res'];
            $fecha_ini = $datos['fecha_inicio'];
            $fecha_fin = $datos['fecha_fin'];
            $obra = $datos['obra'];

            $sql = "INSERT INTO restauraciones (comentario_restauracion, nombre_restaurador, fecha_inicio_restauracion, fecha_fin_restauracion) 
            VALUES ('$comentario', '$nombre', '$fecha_ini', '$fecha_fin')";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
                
                $ultimoId = $db->lastInsertId();

            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            return $ultimoId;
        }

        public function crearRelacion($idObra, $idRestauracion){
            $sql = "INSERT INTO obras_restauraciones (fk_obra, fk_restauracion) VALUES ('$idObra', '$idRestauracion')";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }

        public function editar($id, $datos){
            $comentario = $datos['comentario'];
            $nombre = $datos['nombre_res'];
            $fecha_ini = $datos['fecha_inicio'];
            $fecha_fin = $datos['fecha_fin'];

            $sql = "UPDATE restauraciones SET comentario_restauracion = '$comentario', nombre_restaurador = '$nombre', 
            fecha_inicio_restauracion = '$fecha_ini', fecha_fin_restauracion = '$fecha_fin' WHERE id_restauracion = $id";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }

        }

        public function obtenerDatos($id){
            $sql = "SELECT * FROM restauraciones r 
            LEFT JOIN obras_restauraciones ro ON r.id_restauracion = ro.fk_restauracion
            LEFT JOIN obras o ON ro.fk_obra = o.numero_registro 
            WHERE r.id_restauracion = $id";
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

        public function obtenerObras(){
            $sql = "SELECT numero_registro, titulo FROM obras";
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

        public function existeRelacion($idObra, $idRestauracion){
            $existe = false;
            $sql = "SELECT * FROM obras_restauraciones WHERE fk_restauracion = '$idRestauracion'";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($resultado)){
                $existe = true;
            }
            return $resultado;
        }

        public function editarRelacion($idObra, $idRestauracion){
            $sql = "UPDATE obras_restauraciones SET fk_obra = '$idObra'
            WHERE fk_restauracion = '$idRestauracion'";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }
        
    }

?>