<?php
    class RestauracionesController{
        public function mostrarRestauraciones(){
            require_once "views/general/components/header.php";
            require_once "views/general/components/navegacion.php";
            require_once "views/general/restauraciones/tablaRestauraciones.php";
            require_once "views/general/components/footer.html";
        }

        public function crearRestauracionPantalla(){
            require "models/Restauraciones.php";
            $modelo = new Restauraciones();
            $obras = $modelo->obtenerObras();
            
            require_once "views/general/components/header.php";
            require_once "views/general/components/navegacion.php";
            require_once "views/general/restauraciones/crearRestauracion.php";
            require_once "views/general/components/footer.html";
        }

        public function mostrarRestauracion(){
            require_once "models/Restauraciones.php";
            $modelo = new Restauraciones();
            $datos = $modelo->obtenerDatos($_GET['id']);
            $obras = $modelo->obtenerObras();
            
            require_once "views/general/components/header.php";
            require_once "views/general/components/navegacion.php";
            require_once "views/general/restauraciones/verRestauracion.php";
            require_once "views/general/components/footer.html";
        }

        public function editarRestauracion(){
            require "models/Restauraciones.php";
            $modelo = new Restauraciones();
            $datos = $modelo->obtenerDatos($_GET['id']);
            $obras = $modelo->obtenerObras();

            require_once "views/general/components/header.php";
            require_once "views/general/components/navegacion.php";
            require_once "views/general/restauraciones/editarRestauracion.php";
            require_once "views/general/components/footer.html";        
        }

        public function crear(){
            require "models/Restauraciones.php";
            $modelo = new Restauraciones;
            $idGenerado = $modelo->crear($_POST);
            $modelo->crearRelacion($_POST['obra'], $idGenerado);
            echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Restauraciones&action=mostrarRestauraciones'/>";
        }

        public function editar(){
            require "models/Restauraciones.php";
            $modelo = new Restauraciones;
            $modelo->editar($_GET['id'], $_POST);
            $existe = $modelo->existeRelacion($_POST['obra'], $_GET['id']);
            if($existe){
                $modelo->editarRelacion($_POST['obra'], $_GET['id']);
            }
            else{
                $modelo->crearRelacion($_POST['obra'], $_GET['id']);
            }
            echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Restauraciones&action=mostrarRestauraciones'/>";
        }



    }

?>