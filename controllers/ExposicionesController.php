<?php

class ExposicionesController{

    public function mostrarExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->generarTablas();

        
        require_once "views/general/header.php";
        require_once "views/general/tablaExposiciones.php";
        require_once "views/general/footer.html";
    }

    public function fichaExposiciones(){
        require_once "views/general/header.php";
        require_once "views/general/fichaExposiciones.php";
        require_once "views/general/footer.html";
    }

    public function eliminar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->eliminarExposicion($_GET['id']);
    }

}

?>