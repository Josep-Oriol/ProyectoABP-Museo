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
    <title>Document</title>
    <link rel="stylesheet" href="views/css/main.css">
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
        $action ="loginForm";
    }

    $controlador->$action();   
}else{

    echo "No existe el controlador";
}

?>
</body>
</html>


