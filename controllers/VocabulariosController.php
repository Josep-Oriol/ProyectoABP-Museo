<?php
    class VocabulariosController {
        //Mostramos todos los nombres de los vocabularios.
        public function enviarAVocabularios(){
            require_once "views/general/header.php";
            require_once "views/general/Vocabularios.php";
            require_once "views/general/footer.html";
        }

        public function mostrarVocabularios() {
            require_once "views/general/header.php";
            require_once "models/Vocabularios.php";
            $vocabularios = new Vocabularios();
            $nombresVocabularios = $vocabulario->mostrarVocabularios();
            require_once "views/general/campsLlista.php";
            require_once "views/general/footer.html";
        }

        //Mostramos el nombre del vocabulario y sus campos.
        public function mostrarVocabulario() {
            require_once "views/general/header.php";
            //Controlamos que se haya pasado un identificador por la URL. 
            if ($_GET['id']) {
                $id = $_GET['id'];
                //Llamamos al modelo para recoger los datos del vocabulario pasado por URL.
                require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();
                $datos = $vocabulario->mostrarVocabulario($id);
                $nombre = $datos[0]['Nombre_vocabulario'];
                $campos = $datos[1];
                require_once "views/general/fichaVocabulario.php";
            }
            else {
                echo "<h3>Ningún vocabulario seleccionado.</h3>";
            }
            require_once "views/general/footer.html";
        }
    }
?>