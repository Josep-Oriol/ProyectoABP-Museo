<?php
    class BuscadorController{
        public function buscar(){
            require_once "models/Exposiciones.php";
            $modeloExposiciones = new Exposiciones();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];


            $exposiciones = $modeloExposiciones->busquedaExposiciones($input, "futuroFiltro"); //El segundo parametro para avanzar
                
            
            $response = ["texto" => $exposiciones, "rol" => $_SESSION['Rol']];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

?>