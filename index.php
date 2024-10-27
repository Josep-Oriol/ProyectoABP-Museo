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
    <script src="views/js/busqueda.js"></script>
    <script src="views/js/popup.js"></script>
</head>
<body>
   
    <?php 
    require_once "autoload.php";


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
    
    
    <div id="popupEliminar">
        <div onclick="event.stopPropagation()">
            <img src='images/alertIcon.png' alt='Icono señal advertencia eliminación'>
            <h3>Estàs segur que vols eliminar?</h3>
            <div>
                <button id='confirmar-btn'>Confirmar</button>
                <button id='cancelar-btn'>Cancelar</button>
            </div>
        </div>
    </div>
</body>
</html>


