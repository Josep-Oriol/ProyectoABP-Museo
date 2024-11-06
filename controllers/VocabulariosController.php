<?php
    class VocabulariosController {
        //Mostramos todos los nombres de los vocabularios.
        public function enviarAVocabularios(){
            require_once "views/general/header.php";
            require_once "views/general/VocabulariosMenu.php";
            require_once "views/general/footer.html";
        }
        
        public function mostrarUbicaciones() {
            require_once "views/general/header.php";
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $datos = $vocabulario->mostrarUbicaciones();
            $campos = $datos;
            require_once "views/general/fichaUbicaciones.php";
            require_once "views/general/footer.html";
        }

        public function crearUbicacionHija() {
            require_once "models/Vocabularios.php";
            
            // Si el primer formulario envía `ID_ubicacion`
            if (isset($_POST['ID_ubicacion'])) {
                // Guardamos el ID_ubicacion en la sesión
                $_SESSION['ID_ubicacion'] = $_POST['ID_ubicacion'];
            }
            
            // Incluye la vista para cargar el formulario de `fichaCrearUbicacion.php`
            require_once "views/general/header.php";
            require_once "views/general/fichaCrearUbicacion.php";
            require_once "views/general/footer.html";
            
            // Si el segundo formulario envía `nombreUbicacion`
            if (isset($_POST['nombreUbicacion']) && isset($_SESSION['ID_ubicacion'])) {
                $id_ubicacion = $_SESSION['ID_ubicacion'];
                $nombreUbicacion = $_POST['nombreUbicacion'];
        
                // Llama a la función del modelo para crear la ubicación
                $vocabulario = new Vocabularios();
                $vocabulario->crearUbicacionHija($nombreUbicacion, $id_ubicacion);
        
                // Limpia los datos de la sesión después de usarlos
                unset($_SESSION['ID_ubicacion']);
                
                // Redirige a otra página después de crear la ubicación
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarUbicaciones'/>";
            }
        }
        

        public function cargarHijos() {
            require_once "models/Vocabularios.php"; 
            $vocabulario = new Vocabularios();
            $ID_padre = isset($_GET['ID_padre']) ? intval($_GET['ID_padre']) : 0; //verificamos si esta presente ID_padre en la URL y lo convertimos a int, si no esta presente lo ponemos en 0
            $hijos = $vocabulario->obtenerHijos($ID_padre); //guardamos en $hijos el array con los hijos de ese padre 
            header('Content-Type: application/json'); //indicamos al navegador que la respuesta sera en formato JSON
            echo json_encode($hijos); //convierte el array $hijos a formato json, y es lo que envia esta funcion, el array de los hijos de ese padre en formato json
        }
        

        public function mostrarAutories() {
            require_once "views/general/header.php";
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $datos = $vocabulario->mostrarAutories();
            $nombre = "Autories";
            $id = $datos[0][0]['ID_vocabulario'];
            $campos = $datos[1];
            require_once "views/general/fichaVocabulario.php";
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

        public function editarCampos() {
            require_once "models/Vocabularios.php";      
            $vocabulario = new Vocabularios();
            
            foreach($_POST as $nombreCampo => $nuevoValor){         //recorre foreach, el indice contiene el antiguo nombre y su valor el nuevo
                $vocabulario->editarCampo($nombreCampo, $nuevoValor);
            }
            echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id={$_GET['id']}'/>";
        }

    }
?>