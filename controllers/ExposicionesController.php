<?php

class ExposicionesController{

    public function mostrarExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->datosExposiciones();

        
        require_once "views/general/components/header.php";
        require_once "views/general/exposiciones/tablaExposiciones.php";
        require_once "views/general/components/footer.html";
    }

    public function fichaExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $datos = $modelo->datosExposicion($_GET['id']);

        require_once "views/general/components/header.php";
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
        require_once "views/general/exposiciones/editarExposicion.php";
        require_once "views/general/components/footer.html";
    }

    public function editar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        

        $modelo->editarExposicion($_GET['id'], $_POST);
    }

    public function pantallaCrear(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $campos = $modelo->seleccionarTipo();

        require_once "views/general/components/header.php";
        require_once "views/general/exposiciones/crearExposicion.php";
        require_once "views/general/components/footer.html";
    }
    public function crear(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $datos = $modelo->crearExposicion($_POST);
    }


}

?>