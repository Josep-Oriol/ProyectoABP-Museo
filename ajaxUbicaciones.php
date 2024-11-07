<?php
session_start(); // Iniciar la sesión si es necesario

// Incluir el autoload para cargar las clases automáticamente
require_once "autoload.php"; // Asegúrate de que la ruta sea correcta

if (isset($_GET['controller'])) {
    $nombreController = $_GET['controller'] . "Controller";

    if (class_exists($nombreController)) {
        $controlador = new $nombreController();

        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            // Solo manejar acciones específicas que devuelvan JSON
            if ($action === 'cargarHijos') {
                // Llamar a la acción correspondiente
                $controlador->$action(); // Se espera que esta función maneje la salida
                
            } else {
                // Manejo de otras acciones puede ir aquí
                echo json_encode(['error' => 'Acción no válida']);
                
            }
        } else {
            echo json_encode(['error' => 'No se especificó ninguna acción']);
            
        }
    } else {
        echo json_encode(['error' => 'No existe el controlador']);
        
    }
} else {
    echo json_encode(['error' => 'No se especificó el controlador']);
    
}
