<?php
    require_once "Database.php";
    class Vocabularios extends Database {

        public function mostrarVocabularios() {
            $sql = "SELECT * FROM vocabularios";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function mostrarVocabulario($idVocabulario) {
            $sql = "SELECT Nombre_vocabulario FROM vocabularios WHERE ID_vocabulario = $idVocabulario";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
            $nombreVocabulario = $query->fetch(PDO::FETCH_ASSOC);
            $sql = "SELECT ID_campo, Nombre_campo FROM campos WHERE FK_vocabulario = $idVocabulario";
            $query = $db->prepare($sql);
            $query->execute();
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);
            $datos = [$nombreVocabulario, $campos];
            return $datos;
        }

        public function crearVocabulario($nombre) {
            $sql = "INSERT INTO vocabularios VALUES ('$nombre')";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function crearCampo($idVocabulario, $nombreCampo) {
            $sql = "INSERT INTO campos (Nombre_campo, FK_vocabulario) VALUES ('$nombreCampo', $idVocabulario)";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function editarCampo($idCampo, $nombreCampo) {
            $sql = "UPDATE campos SET Campo = '$nombreCampo' WHERE ID_campo = $idCampo";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function eliminarCampo($idCampo) {
            $sql = "DELETE FROM campos WHERE ID_campo = $idCampo";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function mostrarAutories() {
            $sql = "SELECT Nombre_campo FROM campos c INNER JOIN vocabularios v ON v.ID_vocabulario = c.FK_vocabulario WHERE Nombre_vocabulario LIKE 'Autories'";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql =  "SELECT ID_vocabulario FROM vocabularios WHERE Nombre_vocabulario LIKE 'Autories'";
            $query = $db->prepare($sql);
            $query->execute();
            $id = $query->fetchAll(PDO::FETCH_ASSOC);

            $datos = [$id, $campos];
            return $datos;
        }
    }
?>