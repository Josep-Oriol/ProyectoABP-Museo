<?php
    class Vocabularios extends Database {

        public function mostrarVocabularios() {
            $sql = "SELECT * FROM vocabularios";
            $db = $this->conectar();
            $query = $db->query($sql);
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function mostrarVocabulario($idVocabulario) {
            $sql = "SELECT * FROM campos WHERE FK_vocabulario = $idVocabulario";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function crearVocabulario($nombre) {
            $sql = "INSERT INTO vocabularios VALUES ('$nombre')";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->execute();
        }

        public function crearCampo($idVocabulario, $nombreCampo) {
            $sql = "INSERT INTO campos VALUES ('$nombreCampo', $idVocabulario)";
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
    }
?>