<?php
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        require_once "../Usuarios.php";
        $modeloUsuarios = new Usuarios();

        if (isset($data['usuario'])) {
            $nombreUsuario = $data['usuario'];
            $usuarioExiste = $modeloUsuarios->comprobarUsuario($nombreUsuario);
            echo json_encode(["usuarioExiste" => $usuarioExiste]);
        }
    }
?>