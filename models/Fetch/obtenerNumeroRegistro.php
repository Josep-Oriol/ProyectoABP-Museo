<?php
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        require_once "../Obras.php";
        $obras = new Obras();
        
        if (isset($data['letra'])) {
            $letra = $data['letra'];
            $resultado = $obras->obtenerUltimoNumeroRegistro($letra);
            if (isset($resultado['numero_registro'])) {
                $numeroMaximo = $resultado['numero_registro'];
                echo json_encode(["numMax" => $numeroMaximo]);
            }
            else {
                echo json_encode(["numMax" => ""]);
            }
        }
        else if (isset($data['nuevoNumeroRegistro'])) {
            $nuevoNumeroRegistro = $data['nuevoNumeroRegistro'];
            $numeroExiste = $obras->consultarNumeroRegistro($nuevoNumeroRegistro);
            if ($numeroExiste) {
                echo json_encode(["existe" => true]);
            }
            else {
                echo json_encode(["existe" => false]);
            }
        }
        exit;
    }
?>