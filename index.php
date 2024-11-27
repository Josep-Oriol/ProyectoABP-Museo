<?php
session_start();
?>
<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió Museu Apel·les Fenosa</title>
    <link rel="stylesheet" href="views/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="views/js/logIn.js"></script>
    <script src="views/js/header.js"></script>
    <script src="views/js/verImagen.js"></script>
    <script src="views/js/ubicaciones.js"></script>
    <script src="views/js/eliminar.js"></script>
    <script src="views/js/busqueda.js"></script>
    <script src="views/js/up.js"></script>
    <script src="views/js/filtros.js"></script>
    <script src="views/js/popup.js"></script>
    <script src="views/js/cambiarInputFile.js"></script>
    <script src="views/js/validarFichaObra.js"></script>
    <script src="views/js/generarNumeroRegistro.js"></script>
    <script src="views/js/gestionarCampos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="views/js/validacionesFormularios/validacionCrearUsuario.js"></script>
</head>
<body>
   
    <?php 
    require_once "autoload.php";
    require_once "vendor/autoload.php";
    
    if (isset($_GET['controller'])){
        $nombreController = $_GET['controller']."Controller";
        
    }
    else{
        //Controlador per dedecte
        $nombreController = "UsuariosController";
    }
    if (class_exists($nombreController)){

        $controlador = new $nombreController(); 
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        else{
            $action ="ValidarUser";
        }

        $controlador->$action();

    }else{

        echo "No existe el controlador";
    }

    ?>
    
    <div id="fondoPopUp"></div>

    <div id="popUpUbicaciones">
        <img src="images/alertIcon.png" alt="">
        <p>Hi han obres a aquesta ubicació actualment!</p>
    </div>

    <div id="popUpEliminar">
        <img src="images/alertIcon.png" alt="">
        <p>Confirmar elimininació</p>
        <button id="btnConfirmar" class="confirmar">Confirmar</button>
        <button id="btnCancelar" class="cancelar">Cancelar</button>
    </div>

    <div id="up">
        <img src="images/upIcon.png" alt="">
    </div>


</body>
</html>


