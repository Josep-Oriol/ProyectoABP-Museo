<?php
session_start(); 
// Incluir el autoload para cargar las clases automáticamente
require_once "autoload.php"; 

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
if ($isAjax) {
    // Si es una solicitud AJAX, solo se ejecuta el controlador para devolver JSON
    if (isset($_GET['controller'])) {
        $nombreController = $_GET['controller']."Controller";
    } else {
        $nombreController = "UsuariosController";
    }

    if (class_exists($nombreController)) {
        $controlador = new $nombreController();
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = "validarUser"; // Llama la acción que deseas para la API
        }
        $controlador->$action();
    }
    exit; 
}
?>
