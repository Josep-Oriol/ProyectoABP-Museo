<?php
    class EliminarController {
        public function eliminarRegistro(){
            $data = json_decode(file_get_contents('php://input'), true);

            $idRegistro = $data['id'];
            $apartado = $data['apartado'];
            $columna = $data['columna'];

            require_once "models/Eliminar.php";
            $eliminar = new Eliminar();

            $eliminar->eliminarRegistro($idRegistro, $apartado, $columna);

            if ($eliminar){
                $response = ['status' => 'success'];
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
?>