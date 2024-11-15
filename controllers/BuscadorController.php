<?php
    class BuscadorController{
        public function buscar(){
            require_once "models/Exposiciones.php";
            $modeloExposiciones = new Exposiciones();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];
            $pagina = "exposiciones";  //Seleccionar pagina segun la url

            $exposiciones = $modeloExposiciones->busquedaExposiciones($pagina, $input, "futuroFiltro"); //El segundo parametro para avanzar
                
            
            $response = ["texto" => $exposiciones, "rol" => $_SESSION['Rol']];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

?>