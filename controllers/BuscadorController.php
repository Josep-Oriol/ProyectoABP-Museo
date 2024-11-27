<?php
    class BuscadorController{
        public function buscar(){
            require_once "models/Busquedas.php";
            $modelo = new Busquedas();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];
            $pagina = $data['pagina'];
            $filters = isset($data['filters']) ? $data['filters'] : [];
            //Seleccionar pagina segun la url
            $url = [];

            if($data['pagina'] == "exposiciones"){
                $datos = $modelo->busquedaExposiciones($pagina, $input, $filters);
                $url = ['index.php?controller=Exposiciones&action=Pantallaeditar&id=', 'index.php?controller=Exposiciones&action=fichaExposiciones&id=', 'index.php?controller=Exposiciones&action=eliminar&id='];
            }
            else if($data['pagina'] == "obras"){
                $datos = $modelo->busquedaObras($pagina, $input, $filters);
                $url = ['index.php?controller=Obras&action=editar&id=', 'index.php?controller=Obras&action=mostrarFicha&id=', 'index.php?controller=Obras&action=eliminar&id='];
            }
            else if($data['pagina'] == "usuarios"){
                $datos = $modelo->busquedaUsuarios($pagina, $input, $filters);
                $url = ['index.php?controller=Usuarios&action=editar&id=', 'index.php?controller=Usuarios&action=mostrarFicha&id=', 'index.php?controller=Usuarios&action=eliminar&id='];
            }

            $response = ["texto" => $datos, "rol" => $_SESSION['Rol'], "url" => $url];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

?>