<?php
    require_once "Database.php";
    class Vocabularios extends Database {

        public function mostrarVocabularios() {
            $sql = "SELECT * FROM vocabularios";
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

        public function mostrarVocabulario($idVocabulario) {
            $sql = "SELECT Nombre_vocabulario FROM vocabularios WHERE ID_vocabulario = $idVocabulario";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $nombreVocabulario = $query->fetch(PDO::FETCH_ASSOC);
            
            //Obtenemos cada campo del vocabulario en cuestión mediante la ID del vocabulario pasado como argumento.
            $sql = "SELECT ID_campo, Nombre_campo FROM campos WHERE FK_vocabulario = $idVocabulario";
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);
            //Devolvemos un array en el que en la primera posición guardamos el array asociativo con el nombre del vocabulario y en la segunda el array asocitaivo con los campos.
            $datos = [$nombreVocabulario, $campos];
            return $datos;
        }

        public function crearVocabulario($nombre) {
            $sql = "INSERT INTO vocabularios VALUES ('$nombre')";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }

        public function crearCampo($idVocabulario, $nombreCampo) {
            $sql = "INSERT INTO campos (Nombre_campo, FK_vocabulario) VALUES ('$nombreCampo', $idVocabulario)";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }

        public function editarCampo($antiguoValor, $nuevoValor) {
            $antiguoValor = str_replace('_', " ", $antiguoValor); //por defecto el indice tiene una _ en vez de un espacio, por eso lo reemplaza
            if($antiguoValor != $nuevoValor){
                $sql = "UPDATE campos SET Nombre_campo = '$nuevoValor' WHERE Nombre_campo = '$antiguoValor'";
                $db = $this->conectar();
                try {
                    $query = $db->prepare($sql);
                    $query->execute();
                } catch (PDOException $error) {
                    echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                }
            }
        }

        public function eliminarCampo($idCampo) {
            $sql = "DELETE FROM campos WHERE ID_campo = $idCampo";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }

        public function mostrarAutories() {
            //Obtenemos los campos del vocabulario Autories juntando las tablas de campos y vocabularios para encontrar los campos en los cuales el identificador del vocabulario coincide con el de autories.
            $sql = "SELECT Nombre_campo FROM campos c INNER JOIN vocabularios v ON v.ID_vocabulario = c.FK_vocabulario WHERE Nombre_vocabulario LIKE 'Autories'";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);
            //Obtenemos la id del vocabulario autories.
            $sql =  "SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario LIKE 'Autories'";
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $id = $query->fetchAll(PDO::FETCH_ASSOC);

            $datos = [$id, $campos]; //Devolvemos un array donde en el primer campo se guarda el id del vocabulario y en el segundo los campos de autories.
            return $datos;
        }
    }
?>