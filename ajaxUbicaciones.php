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

/*if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'] . "Controller";

    if (class_exists($nombreController)) {
        $controlador = new $nombreController();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            $controlador->$action();
            }else {
                // Manejo de otras acciones puede ir aquí
                echo json_encode(['error' => 'Acción no válida']);
                
            }
    } else {
        echo json_encode(['error' => 'No se especificó ninguna acción']);
        exit;
    }
} else {
    echo json_encode(['error' => 'No se especificó el controlador']);
    
} */
?>
