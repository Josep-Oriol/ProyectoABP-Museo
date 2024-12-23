<?php

class ExposicionesController{

    public function mostrarExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->datosExposiciones();

        
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/exposiciones/tablaExposiciones.php";
        require_once "views/general/components/footer.html";
    }

    public function fichaExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $datos = $modelo->datosExposicion($_GET['id']);
        $datosObras = $modelo->obrasRelacionadas($_GET['id']);

        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/exposiciones/fichaExposiciones.php";
        require_once "views/general/components/footer.html";
    }

    public function eliminar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->eliminarExposicion($_GET['id']);
    }

    public function Pantallaeditar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $campos = $modelo->seleccionarTipo();

        $datos = $modelo->datosExposicion($_GET['id']);
        
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/exposiciones/editarExposicion.php";
        require_once "views/general/components/footer.html";
    }

    public function editar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $modelo->editarExposicion($_GET['id'], $_POST);
        echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Exposiciones&action=mostrarExposiciones'/>";
    }

    public function pantallaCrear(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $campos = $modelo->seleccionarTipo();

        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/exposiciones/crearExposicion.php";
        require_once "views/general/components/footer.html";
    }
    public function crear(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $datos = $modelo->crearExposicion($_POST);
        echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Exposiciones&action=mostrarExposiciones'/>";
    }

    
    public function relacionarObras(){
        require_once "models/Exposiciones.php";
        require_once "models/Obras.php";
        $modeloExposiciones = new Exposiciones();
        $modeloObras = new Obras();

        $obras = $modeloObras->mostrarObras();  //Recogemos todas las obras
        $obrasRelacionadas = $modeloExposiciones->obrasRelacionadas($_GET['id']);  //Recogemos unicamente las obras relacionadas


        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/exposiciones/relacionarObras.php";
        require_once "views/general/components/footer.html";
    }
    
    public function relacionar(){
        require_once "models/Exposiciones.php";
        require_once "models/Obras.php";
        $modeloExposiciones = new Exposiciones();
        $modeloObras = new Obras();

        $obrasRelacionadas = $modeloExposiciones->NumRegistroObrasRelacionadas($_GET['id']);

        $modeloExposiciones->agregarRelaciones($_POST, $_GET['id']);
        $modeloExposiciones->eliminarRelaciones($_POST, $obrasRelacionadas, $_GET['id']);

        echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Exposiciones&action=fichaExposiciones&id=" . $_GET['id'] . "'/>";
    }

    public function eliminarRelacionesFicha(){
        require_once "models/Exposiciones.php";
        $modeloExposiciones = new Exposiciones();

        $data = json_decode(file_get_contents('php://input'), true);
        $idObra = $data['idObra'];
        $idExposicion = $data['idExposicion'];

        if($idExposicion and $idObra){
            $filas = $modeloExposiciones->consultaEliminarRelacionesFicha($idObra, $idExposicion);
            $response = ['status' => 'success', 'obra' => $idObra, 'exposicion' => $idExposicion, 'filas' => $filas]; //ENVIAR LOS DATOS NECESARIOS
        }
        else{
            $response = ['status' => 'error'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
        
    }

}

?>