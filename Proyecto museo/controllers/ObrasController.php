<?php 

class ObrasController{
    private $modelobras;

    function mostrarObras(){
        require_once "models/Obras.php";

        $modelobras = new Obras();

        $obras = $modelobras->mostrarObras();

        require_once "views/general/header.html";
        require_once "views/general/general.php";
        require_once "views/general/footer.html";
    }

    function mostrarFicha(){
        require_once "views/general/fichaObra.php";
    }
}

?>