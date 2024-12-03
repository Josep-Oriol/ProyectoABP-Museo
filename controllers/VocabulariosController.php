<?php
    class VocabulariosController {
        //Mostramos todos los nombres de los vocabularios.
        public function enviarAVocabularios(){
            require_once "views/general/components/header.php";
            require_once "views/general/vocabularios/vocabulariosMenu.php";
            require_once "views/general/components/footer.html";
        }
        
        public function mostrarUbicaciones() {
            require_once "views/general/components/header.php";
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $datos = $vocabulario->mostrarUbicaciones();
            $campos = $datos;
            require_once "views/general/ubicaciones/fichaUbicaciones.php";
            require_once "views/general/components/footer.html";
        }

        public function crearUbicacionHija() {
            require_once "models/Vocabularios.php";
            
            // Si el primer formulario envía `ID_ubicacion`
            if (isset($_POST['id_ubicacion'])) {
                // Guardamos el ID_ubicacion en la sesión
                $_SESSION['id_ubicacion'] = $_POST['id_ubicacion'];
            }
            
            // Incluye la vista para cargar el formulario de `fichaCrearUbicacion.php`
            require_once "views/general/components/header.php";
            require_once "views/general/ubicaciones/fichaCrearUbicacion.php";
            require_once "views/general/components/footer.html";
            
            // Si el segundo formulario envía `nombreUbicacion`
            if (isset($_POST['nombreUbicacion']) && isset($_SESSION['id_ubicacion'])) {
                $id_ubicacion = $_SESSION['id_ubicacion'];
                $nombreUbicacion = $_POST['nombreUbicacion'];
                $comentari = $_POST['comentario_ubicacion'];
        
                // Llama a la función del modelo para crear la ubicación
                $vocabulario = new Vocabularios();
                $vocabulario->crearUbicacionHija($nombreUbicacion, $id_ubicacion, $comentari);
        
                // Limpia los datos de la sesión después de usarlos
                unset($_SESSION['id_ubicacion']);
                
                // Redirige a otra página después de crear la ubicación
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarUbicaciones'/>";
            }else if (isset($_POST['nombreUbicacion'])) {
                $nombreUbicacion = $_POST['nombreUbicacion'];
                $comentari = $_POST['comentario_ubicacion'];

                $vocabulario = new Vocabularios();
                $vocabulario->crearUbicacion($nombreUbicacion, $comentari);

                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarUbicaciones'/>";
            }
        }

        public function eliminarUbicacion() {
            require_once "models/Vocabularios.php";
            $id_ubicacion = $_POST['id_ubicacion'];
            $vocabulario = new Vocabularios();
            $vocabulario->eliminarUbicacion($id_ubicacion);
            echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Vocabularios&action=mostrarUbicaciones'/>";
        }

        public function eliminarUbicacionHija() {
            $data = json_decode(file_get_contents('php://input'), true);
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $id_ubicacion = $data['id_ubicacion'];
    
            // Aquí ejecutas la lógica de eliminación en la base de datos.
            $resultado = $vocabulario->eliminarUbicacion($id_ubicacion);

            if ($resultado) {
                $response = ['status' => 'success'];
            }else {
                $response = ['status' => 'false'];
            }
            // Devuelve una respuesta JSON indicando si fue exitoso
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        

        public function cargarHijos() {
            require_once "models/Vocabularios.php"; 
            $vocabulario = new Vocabularios();
            $ID_padre = isset($_GET['id_padre']) ? intval($_GET['id_padre']) : 0; //verificamos si esta presente ID_padre en la URL y lo convertimos a int, si no esta presente lo ponemos en 0
            $hijos = $vocabulario->obtenerHijos($ID_padre); //guardamos en $hijos el array con los hijos de ese padre 
            header('Content-Type: application/json'); //indicamos al navegador que la respuesta sera en formato JSON
            echo json_encode($hijos); //convierte el array $hijos a formato json, y es lo que envia esta funcion, el array de los hijos de ese padre en formato json
        }
        

        public function mostrarAutories() {
            require_once "views/general/components/header.php";
            require_once "models/Vocabularios.php";
            $vocabulario = new Vocabularios();
            $datos = $vocabulario->mostrarAutories();
            $nombre = "Autories";
            $id = $datos[0][0]['id_vocabulario'];
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
                $nombre = $datos[0]['nombre_vocabulario'];
                $campos = $datos[1];
                require_once "views/general/vocabularios/fichaVocabulario.php";
            }
            else {
                echo "<h3>Ningún vocabulario seleccionado.</h3>";
            }
            require_once "views/general/components/footer.html";
        }

        public function crearCampo() {
            $data = json_decode(file_get_contents('php://input'), true);

            $id = $data['id'];
            $nombre = $data['nombre'];

            require_once "models/Vocabularios.php";
                $vocabulario = new Vocabularios();

            if(isset($nombre)){
                $vocabulario->crearCampo($id, $nombre);

                if($vocabulario) {
                    $response = ['status' => 'success'];
                }else{
                    $response = ['status' => 'false'];
                }
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        public function editarCampos() {
            $data = json_decode(file_get_contents('php://input'), true);

            $antiguoValor = $data['antiguoValor'];
            $nuevoValor = $data['nuevoValor'];
            
            require_once "models/Vocabularios.php";    
            $vocabulario = new Vocabularios();

            $cambios = false;
            
            foreach ($nuevoValor as $index => $valorNuevo) {
                foreach ($nuevoValor as $subIndex => $otroValor) {
                    if ($index !== $subIndex && $valorNuevo === $otroValor) {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'repetidos',  'duplicado' => $valorNuevo]);
                        exit;
                    }
                }
            }

            foreach ($nuevoValor as $index => $valorNuevo){
                if (trim($valorNuevo) === ""){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'vacio']);
                    exit;
                }
            }

            foreach ($antiguoValor as $index => $valorAntiguo) {
                $valorNuevo = $nuevoValor[$index];         
                $resultado = $vocabulario->editarCampo($valorAntiguo, $valorNuevo);
                
                if ($resultado) {
                    $cambios = true;
                }
            }

            $respuesta = $cambios ? ['status' => 'success'] : ['status' => 'sinCambios'];
            header('Content-Type: application/json');
            echo json_encode($respuesta);
            exit;
        }

        public function eliminarCampos() {
            $data = json_decode(file_get_contents('php://input'), true);

            $idCamposEliminar = $data['idsSeleccionados']; 
            
            require_once "models/Vocabularios.php";    
            $vocabulario = new Vocabularios();

            $response = ['status' => 'false'];

            foreach($idCamposEliminar as $idCampo) {
                $vocabulario->eliminarCampo($idCampo);
                if ($vocabulario) {
                    $response = ['status' => 'success'];
                }else {
                    $response = ['status' => 'error', 'message' => 'Error al eliminar campo con ID: ' . $idCampo];
                    exit;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        public function mostrarHistorial(){
            $data = json_decode(file_get_contents('php://input'), true);

            $id_ubicacion = $data['id_ubicacion'];
            require_once "models/Vocabularios.php";    
            $vocabulario = new Vocabularios();

            $historial = $vocabulario->mostrarHistorial($id_ubicacion);
            $response = ['datos' => $historial];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
?>