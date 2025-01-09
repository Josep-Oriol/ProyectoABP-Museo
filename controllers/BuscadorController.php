<?php
    class BuscadorController{
        public function buscar(){
            require_once "models/Busquedas.php";
            $modelo = new Busquedas();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];
            $pagina = $data['pagina'];
            $filters = $data['filtros'];
            $lim_valores = $data['lim_registros'];
            $paginar = "";

  
            if ($lim_valores !== "tots") {
    
                $lim = explode("-", $lim_valores);
            
                $offset = intval($lim[0]);
                $limit = intval($lim[1]) - $offset; 
            
                $paginar = "LIMIT $limit OFFSET $offset";
            }

            $url = [];

            $strWhere = $this->devolverWhere($pagina, $filters);

           // Asegúrate de que la variable de sesión esté inicializada si no hay filtros
    
            if($pagina == "exposiciones"){
                $datos = $modelo->busquedaExposiciones($pagina, $input, $strWhere, $paginar);
                $url = ['index.php?controller=Exposiciones&action=Pantallaeditar&id=', 'index.php?controller=Exposiciones&action=fichaExposiciones&id=', 'index.php?controller=Exposiciones&action=eliminar&id='];
            }
            else if($pagina == "obras"){
                $datos = $modelo->busquedaObras($pagina, $input, $strWhere, $paginar);
                $url = ['index.php?controller=Obras&action=editar&id=', 'index.php?controller=Obras&action=mostrarFicha&id=', 'index.php?controller=Obras&action=eliminar&id='];
            }
            else if($pagina == "usuarios"){
                $datos = $modelo->busquedaUsuarios($pagina, $input, $strWhere, $paginar);
                $url = ['index.php?controller=Usuarios&action=editar&id=', 'index.php?controller=Usuarios&action=mostrarFicha&id=', 'index.php?controller=Usuarios&action=eliminar&id='];
            }
            else if($pagina == "copias"){
                $datos = $modelo->busquedaCopias($pagina, $input, $strWhere, $paginar);
                $url = ['index.php?controller=Copias&action=editar&id=', 'index.php?controller=Copias&action=mostrarCopia&id=', 'index.php?controller=Copias&action=mostrarCopia&id='];
            }
            else if($pagina == "restauraciones"){
                $datos = $modelo->busquedaRestauraciones($pagina, $input, $strWhere, $paginar);
                $url = ['index.php?controller=Restauraciones&action=editarRestauracion&id=', 'index.php?controller=Restauraciones&action=mostrarRestauracion&id=', 'index.php?controller=Restauraciones&action=mostrarCopia&id='];
            }

            $response = ["texto" => $datos, "rol" => $_SESSION['Rol'], "url" => $url];

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function exportarTablas(){
            require_once "models/Busquedas.php";
            $modelo = new Busquedas();

            $data = json_decode(file_get_contents('php://input'), true);
            $input = $data['busqueda'];
            $pagina = $data['pagina'];
            $filters = $data['filtros'];

            $lim_valores = $data['lim_registros'];
            $paginar = "";

  
            if ($lim_valores !== "tots") {
    
                $lim = explode("-", $lim_valores);
            
                $offset = intval($lim[0]);
                $limit = intval($lim[1]) - $offset; 
            
                $paginar = "LIMIT $limit OFFSET $offset";
            }
            //Seleccionar pagina segun la url
            $url = [];

            $strWhere = $this->devolverWhere($pagina, $filters);

           // Asegúrate de que la variable de sesión esté inicializada si no hay filtros
    
            if($pagina == "exposiciones"){
                $datos = $modelo->exportarExposiciones($pagina, $input, $strWhere, $paginar);
            }
            else if($pagina == "obras"){
                $datos = $modelo->exportarObras($pagina, $input, $strWhere, $paginar);            
            }
            else if($pagina == "usuarios"){
                $datos = $modelo->exportarUsuarios($pagina, $input, $strWhere, $paginar);
            }
            else{
                $datos = $modelo->exportarRestauraciones($pagina, $input, $strWhere, $paginar);
            }

            $response = ["texto" => $datos];

            header('Content-Type: application/json');
            echo json_encode($response);
        }

        

        function devolverWhere($pagina, $filters){
            $strWhere = "AND ";
            
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
                            array_push($arrayAnd, $alias.$indice2." = "."'$valor2'");
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
                            array_push($arrayOr, $alias .$indice2." = "."'$valor2'");
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

            
            if($strOr != "()" and $strAnd != "()"){
                $strWhere .= $strAnd." OR ".$strOr;   
            }
            elseif($strOr == "()" and $strAnd != "()"){
                $strWhere .= $strAnd;
            }
            elseif($strAnd == "()" and $strOr != "()"){
                $strWhere .= $strOr;
            }
            elseif($strOr == "()" and $strAnd == "()"){
                $strWhere = "";
            }

            return $strWhere;
        }
        
    }

?>
