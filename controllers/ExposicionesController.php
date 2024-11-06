<?php

class ExposicionesController{

    public function mostrarExposiciones(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->generarTablas();

        
        require_once "views/general/components/header.php";
        require_once "views/general/exposiciones/tablaExposiciones.php";
        require_once "views/general/components/footer.html";
    }

    public function fichaExposiciones(){
        require_once "views/general/components/header.php";
        require_once "views/general/exposiciones/fichaExposiciones.php";
        require_once "views/general/components/footer.html";
    }

    public function eliminar(){
        require_once "models/Exposiciones.php";
        $modelo = new Exposiciones();
        $exposiciones = $modelo->eliminarExposicion($_GET['id']);
    }

}

?>