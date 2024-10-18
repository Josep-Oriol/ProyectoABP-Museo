<?php
    class VocabulariosController {
        //Mostramos todos los nombres de los vocabularios.
        public function enviarAVocabularios(){
            require_once "views/general/header.php";
            require_once "views/general/VocabulariosMenu.php";
            require_once "views/general/footer.html";
        }

        public function campsLlista(){
            require_once "views/general/header.php";
            require_once "views/general/campsLlista.php";
            require_once "views/general/footer.html";
        }

        public function mostrarVocabularios() {
            require_once "views/general/header.php";
            require_once "models/Vocabularios.php";
            $vocabularios = new Vocabularios();
            $nombresVocabularios = $vocabularios->mostrarVocabularios();

            require_once "views/general/campsLlista.php";
            require_once "views/general/footer.html";
        }

        //Mostramos el nombre del vocabulario y sus campos.
        public function mostrarCamposVocabulario() {
            require_once "views/general/header.php";
            //Controlamos que se haya pasado un identificador por la URL. 
            if (isset($_GET['id'])) {
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

        public function crearCampo() {
            if ($_POST) {
                require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();
                $vocabulario->crearCampo($_GET['id'], $_POST['crear']);
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id={$_GET['id']}'/>";
            }
        }

        /*public function editarCampos() {
            if (isset($_GET['idCampo']) && isset($_GET['nombreCampo'])) {
                $idCampo = $_GET['idCampo'];
                $nombreCampo = $_GET['nombreCampo'];
                require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();
                
                $vocabulario->editarCampo($idCampo, $nombreCampo);
            }
        }
        */


    }
?>