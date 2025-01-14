<?php 

class ObrasController{

    public function mostrarObras() {
        require_once "models/Obras.php";
        $modelobras = new Obras();
        $obras = $modelobras->mostrarObras();
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/obras/gestionObras.php";
        require_once "views/general/components/footer.html";
    }

    public function mostrarFicha() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        if ($_GET['id']) {
            require_once "models/Obras.php";
            $modelobras = new Obras();
            $id = $_GET['id'];
            $obra = $modelobras->mostrarObra($id);
            $historialUbicaciones = $modelobras->obtenerHistorialObras($id);

            require_once "views/general/obras/fichaObra.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function crear() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "models/Obras.php";
        $modelobras = new Obras();
        if ($_POST) {
            if (isset($_FILES['fotografia']['name']) && $_FILES['fotografia']['error'] == 0) {
                $idFotografia = $_POST['letra'] . $_POST['numero_registro'];
                if (!empty($_POST['decimales'])) {
                    $idFotografia . "." . $_POST['decimales'];
                }
                $fotografia = $modelobras->subirFotografiaServidor('fotografia', $idFotografia);
                $_POST['fotografia'] = $fotografia;
            }
            else {
                $_POST['fotografia'] = 'images/iconDefaultObra.png';
            }
            $exitoso = $modelobras->crearObra($_POST);
            if ($exitoso) {
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Obras&action=mostrarObras'/>";
            }
        }
        else {
            require_once "models/Vocabularios.php";
            $modeloVocabularios = new Vocabularios();
            $camposLista = $modeloVocabularios->obtenerCamposLista();
            $ubicaciones = $modeloVocabularios->obtenerUbicaciones();
            require_once "models/Exposiciones.php";
            $modeloExposiciones = new Exposiciones();
            $exposiciones = $modeloExposiciones->datosExposiciones();
            require_once "views/general/obras/fichaCrearObra.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function editar() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        if ($_GET['id']) {
            $id = $_GET['id'];
            require_once "models/Obras.php";
            $modelobras = new Obras();
            if ($_POST) {
                if (isset($_FILES['fotografia']['name']) && $_FILES['fotografia']['error'] == 0) {
                    $fotografia = $modelobras->subirFotografiaServidor('fotografia', $id);
                    $_POST['fotografia'] = $fotografia;
                }
                $exitoso = $modelobras->editarObra($_POST, $id);
                if ($exitoso) {
                    echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Obras&action=mostrarObras'/>";
                }
            }
            else {
                $obra = $modelobras->mostrarObra($id);
                require_once "models/Vocabularios.php";
                $modeloVocabularios = new Vocabularios();
                $camposLista = $modeloVocabularios->obtenerCamposLista();
                $ubicaciones = $modeloVocabularios->obtenerUbicaciones();
                require_once "models/Exposiciones.php";
                $modeloExposiciones = new Exposiciones();
                $exposiciones = $modeloExposiciones->datosExposiciones();
                require_once "views/general/obras/fichaEditarObra.php";
            }           
            
        }
        
        require_once "views/general/components/footer.html";
    }

    public function eliminar() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        
        //si hay una id pasada por la URL procedemos a eliminar la obra, si no, mostramos un mensaje.
        if ($_GET['id']) {
            require_once "models/Obras.php";
            $modelobras = new Obras();
            $exitoso = $modelobras->eliminarObra($_GET['id']);
            if ($exitoso) {
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Obras&action=mostrarObras'/>";
            }
        }
        else {
            echo "<h3>Ninguna obra seleccionada.</h3>";
        }
        require_once "views/general/components/footer.html";
    }

    public function generarPDF(){
        require "models/Obras.php";
        $modeloObras = new Obras;
        $id = $_GET['id'];
        $obra = $modeloObras->mostrarObra($id);
        require_once "views/general/pdfs/obrasPDF.php";
    }

    public function generarPdfBasica(){
        require "models/Obras.php";
        $modeloObras = new Obras;
        $id = $_GET['id'];
        $obra = $modeloObras->mostrarObra($id);
        require_once "views/general/pdfs/obrasBasicaPDF.php";
    }

    public function generarLibro() {
        require_once "views/general/pdfs/libro.php";
    }

    public function generarWord(){
        require "models/Obras.php";
        $modeloObras = new Obras;
        $id = $_GET['id'];
        $obra = $modeloObras->mostrarObra($id);
        require_once "views/general/pdfs/word.php";
        
    }
}

?>