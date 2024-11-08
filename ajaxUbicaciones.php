<?php
session_start(); 

// Incluir el autoload para cargar las clases automáticamente
require_once "autoload.php"; 

if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'] . "Controller";

    if (class_exists($nombreController)) {
        $controlador = new $nombreController();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            $controlador->$action();
            }else {
                // Manejo de otras acciones puede ir aquí
                echo json_encode(['error' => 'Acción no válida']);
                exit;
            }
    } else {
        echo json_encode(['error' => 'No se especificó ninguna acción']);
        exit;
    }
} else {
    echo json_encode(['error' => 'No se especificó el controlador']);
    exit;
}
?>
