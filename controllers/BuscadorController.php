<?php
    class BuscadorController{
        public function buscar(){
            require_once "models/Busquedas.php";
            $modelo = new Busquedas();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];
            $pagina = $data['pagina'];
            $filters = $data['filtros'];
            //Seleccionar pagina segun la url
            $url = [];

            $strWhere = "WHERE ";
            
            $arrayAnd = [];
            $strAnd = "";
            $arrayOr = [];
            $strOr = "";

            switch ($pagina) {
                case "obras":
                    $alias = "o.";
                    break;
                case "exposiciones":
                    $alias = "e.";
                    break;
                case "usuarios":
                    $alias = "u.";
                    break;
                default:
                    $alias = null; // O un valor por defecto que tenga sentido
            }


            foreach($filters as $indice => $valor){
                if($indice == "and"){
                    foreach($filters["and"] as $indice2 => $valor2){
                        $arrayTemporal = [];
                        if(is_string($valor2)){
                            $indice2 = substr($indice2, 4);
                            array_push($arrayAnd, $alias.$indice2." LIKE "."'$valor2'");
                        }
                        else{
                            foreach($valor2 as $indice3 => $valor3){
                                array_push($arrayTemporal, "'$valor3'");
                            }
                            $strTemporal = implode(", ", $arrayTemporal);
                            $indice2 = substr($indice2, 4);
                            array_push($arrayAnd, $alias.$indice2." IN (".$strTemporal.")");
                        }
                    }
                    $strAnd = "(".implode(" AND ", $arrayAnd).")";

                }
                else if($indice == "or"){
                    foreach($filters["or"] as $indice2 => $valor2){
                        $arrayTemporal = [];
                        if(is_string($valor2)){
                            $indice2 = substr($indice2, 3);
                            array_push($arrayOr, $alias .$indice2." LIKE "."'$valor2'");
                        }
                        else{
                            foreach($valor2 as $indice3 => $valor3){
                                array_push($arrayTemporal, "'$valor3'");
                            }
                            $strTemporal = implode(", ", $arrayTemporal);
                            $indice2 = substr($indice2, 3);
                            array_push($arrayOr, $alias.$indice2." IN (".$strTemporal.")");
                        }
                    }
                    $strOr = "(".implode(" OR ", $arrayOr).")";
                }
            }

            
            if($strOr == "()" and $strAnd == "()"){
                $strWhere = "";
            }
            elseif($strOr == "()"){
                $strWhere .= $strAnd;
            }
            elseif($strAnd == "()"){
                $strWhere .= $strOr;
            }
            elseif($strOr == "()" and $strAnd == "()"){
                $strWhere .= $strAnd." OR ".$strOr;
            }

            
           // Asegúrate de que la variable de sesión esté inicializada si no hay filtros
    

            if($data['pagina'] == "exposiciones"){
                $datos = $modelo->busquedaExposiciones($pagina, $input, $filters);
                $url = ['index.php?controller=Exposiciones&action=Pantallaeditar&id=', 'index.php?controller=Exposiciones&action=fichaExposiciones&id=', 'index.php?controller=Exposiciones&action=eliminar&id='];
            }
            else if($data['pagina'] == "obras"){
                $datos = $modelo->busquedaObras($pagina, $input, $strWhere);
                $url = ['index.php?controller=Obras&action=editar&id=', 'index.php?controller=Obras&action=mostrarFicha&id=', 'index.php?controller=Obras&action=eliminar&id='];
            }
            else if($data['pagina'] == "usuarios"){
                $datos = $modelo->busquedaUsuarios($pagina, $input, $filters);
                $url = ['index.php?controller=Usuarios&action=editar&id=', 'index.php?controller=Usuarios&action=mostrarFicha&id=', 'index.php?controller=Usuarios&action=eliminar&id='];
            }

            $response = ["texto" => $datos, "rol" => $_SESSION['Rol'], "url" => $url, "condicionales" => $strWhere];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

?>