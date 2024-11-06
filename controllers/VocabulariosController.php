<?php
    class VocabulariosController {
        //Mostramos todos los nombres de los vocabularios.
        public function enviarAVocabularios(){
            require_once "views/general/components/header.php";
            require_once "views/general/vocabularios/vocabulariosMenu.php";
            require_once "views/general/components/footer.html";
        }

        public function mostrarAutories() {
            require_once "views/general/components/header.php";
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $datos = $vocabulario->mostrarAutories();
            $nombre = "Autories";
            $id = $datos[0][0]['ID_vocabulario'];
            $campos = $datos[1];
            require_once "views/general/vocabularios/fichaVocabulario.php";
            require_once "views/general/components/footer.html";
        }

        public function mostrarVocabularios() {
            require_once "views/general/components/header.php";
            require_once "models/Vocabularios.php";
            $vocabularios = new Vocabularios();
            $nombresVocabularios = $vocabularios->mostrarVocabularios();
            require_once "views/general/vocabularios/campsLlista.php";
            require_once "views/general/components/footer.html";
        }

        //Mostramos el nombre del vocabulario y sus campos.
        public function mostrarCamposVocabulario() {
            require_once "views/general/components/header.php";
            //Controlamos que se haya pasado un identificador por la URL. 
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                //Llamamos al modelo para recoger los datos del vocabulario pasado por URL.
                require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();
                $datos = $vocabulario->mostrarVocabulario($id);
                $nombre = $datos[0]['Nombre_vocabulario'];
                $campos = $datos[1];
                require_once "views/general/vocabularios/fichaVocabulario.php";
            }
            else {
                echo "<h3>Ningún vocabulario seleccionado.</h3>";
            }
            require_once "views/general/components/footer.html";
        }

        public function crearCampo() {
            if ($_POST) {
                require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();
                $vocabulario->crearCampo($_GET['id'], $_POST['crear']);
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id={$_GET['id']}'/>";
            }
        }

        public function editarCampos() {
            require_once "models/Vocabularios.php";      
            $vocabulario = new Vocabularios();
            
            foreach($_POST as $nombreCampo => $nuevoValor){         //recorre foreach, el indice contiene el antiguo nombre y su valor el nuevo
                $vocabulario->editarCampo($nombreCampo, $nuevoValor);
            }
        }

    }
?>