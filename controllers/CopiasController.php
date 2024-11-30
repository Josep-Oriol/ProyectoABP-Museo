<?php

class CopiasController{
    function mostrarCopias(){
        require_once 'models/Copias.php';
        $modelo = new Copias();
        $copias = $modelo -> obtenerCopias();

        require_once "views/general/components/header.php";
        require_once "views/general/copias/tablaCopias.php";
        require_once "views/general/components/footer.html";
    }

    function crear(){
        require_once "views/general/components/header.php";
        require_once 'models/Copias.php';
        $modelo = new Copias();
        $id = $_SESSION['ID_usuario'];

        if ($_POST) {
            $exitoso = $modelo->crearCopia($_POST, $id);
            if ($exitoso) {
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Copias&action=mostrarCopias'/>";
            }
        }
        else {
            require_once "views/general/copias/fichaCrearCopia.php";
        }
        require_once "views/general/components/footer.html";
    }
}