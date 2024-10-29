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

}

?>