<?php
    require_once "Database.php";
    class Vocabularios extends Database {

        public function mostrarVocabularios() {
            $sql = "SELECT * FROM vocabularios";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function mostrarVocabulario($idVocabulario) {
            $sql = "SELECT nombre_vocabulario FROM vocabularios WHERE id_vocabulario = :idVocabulario";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':idVocabulario', $idVocabulario, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $nombreVocabulario = $query->fetch(PDO::FETCH_ASSOC);
            
            //Obtenemos cada campo del vocabulario en cuestión mediante la ID del vocabulario pasado como argumento.
            $sql = "SELECT id_campo, nombre_campo FROM campos WHERE fk_vocabulario = :idVocabulario";
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':idVocabulario', $idVocabulario, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);
            //Devolvemos un array en el que en la primera posición guardamos el array asociativo con el nombre del vocabulario y en la segunda el array asocitaivo con los campos.
            $datos = [$nombreVocabulario, $campos];
            return $datos;
        }

        public function crearVocabulario($nombre) {
            $sql = "INSERT INTO vocabularios (nombre) VALUES (:nombre)";
            $db = $this->conectar();
            
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':nombre', $nombre, PDO::PARAM_STR); // Vinculamos el parámetro
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }
        

        public function obtenerCamposLista() {
            $sql = "SELECT v.nombre_vocabulario, c.nombre_campo FROM vocabularios v INNER JOIN campos c ON v.id_vocabulario = c.fk_vocabulario";
            
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    
            $vocabulariosyCampos = array();
            foreach ($datos as $indice => $dato) {
                $nombreVocabulario = $dato['nombre_vocabulario'];
                $nombreCampo = $dato['nombre_campo'];
                if (!array_key_exists($nombreVocabulario, $vocabulariosyCampos)) { 
                    $vocabulariosyCampos[$nombreVocabulario] = [$nombreCampo]; //Si no existe, creamos una clave dentro del array con un array dentro con el valor del campo
                }
                else {
                    array_push($vocabulariosyCampos[$nombreVocabulario], $nombreCampo); //Si existe la clave del vocabulario, le asignamos el valor del campo
                }
            }
    
            return $vocabulariosyCampos;
        }

        public function crearCampo($idVocabulario, $nombreCampo) {
            $sql = "INSERT INTO campos (nombre_campo, fk_vocabulario) VALUES (:nombreCampo, :idVocabulario)";
            $db = $this->conectar();
            
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':nombreCampo', $nombreCampo, PDO::PARAM_STR); // Vincula el parámetro nombreCampo
                $query->bindParam(':idVocabulario', $idVocabulario, PDO::PARAM_INT); // Vincula el parámetro idVocabulario
                $query->execute();
                $filas = $query->rowCount();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            
            $create = $filas > 0 ? true : false;
            return $create;
        }
        

        public function editarCampo($antiguoValor, $nuevoValor) {
            if ($antiguoValor != $nuevoValor) {
                $sql = "UPDATE campos SET nombre_campo = :nuevoValor WHERE nombre_campo = :antiguoValor";
                $db = $this->conectar();
                
                try {
                    $query = $db->prepare($sql);
                    $query->bindParam(':nuevoValor', $nuevoValor, PDO::PARAM_STR);
                    $query->bindParam(':antiguoValor', $antiguoValor, PDO::PARAM_STR);
                    $query->execute();
                    return true;
                } catch (PDOException $error) {
                    echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                    return false;
                }
            } else {
                return false;
            }
        }

        public function editarUbicaciones($antiguoValor, $nuevoValor) {
            if ($antiguoValor != $nuevoValor) {
                $sql = "UPDATE ubicaciones SET descripcion_ubicacion = :nuevoValor WHERE descripcion_ubicacion = :antiguoValor";
                $db = $this->conectar();
                
                try {
                    $query = $db->prepare($sql);
                    $query->bindParam(':nuevoValor', $nuevoValor, PDO::PARAM_STR);
                    $query->bindParam(':antiguoValor', $antiguoValor, PDO::PARAM_STR);
                    $query->execute();
                    return true;
                } catch (PDOException $error) {
                    echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                    return false;
                }
            } else {
                return false;
            }
        }
        

        public function eliminarCampo($idCampo) {
            $sql = "DELETE FROM campos WHERE nombre_campo = :idCampo";
            $db = $this->conectar();
            
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':idCampo', $idCampo, PDO::PARAM_STR); // Vincula el parámetro
                $query->execute();
                $filas = $query->rowCount();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            
            $delete = $filas > 0 ? true : false;
            return $delete;
        }
        

        public function mostrarAutories() {
            //Obtenemos los campos del vocabulario Autories juntando las tablas de campos y vocabularios para encontrar los campos en los cuales el identificador del vocabulario coincide con el de autories.
            $sql = "SELECT nombre_campo FROM campos c INNER JOIN vocabularios v ON v.id_vocabulario = c.fk_vocabulario WHERE nombre_vocabulario LIKE 'Autories'";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $campos = $query->fetchAll(PDO::FETCH_ASSOC);
            //Obtenemos la id del vocabulario autories.
            $sql =  "SELECT id_vocabulario FROM vocabularios WHERE nombre_vocabulario LIKE 'Autories'";
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $id = $query->fetchAll(PDO::FETCH_ASSOC);

            $datos = [$id, $campos]; //Devolvemos un array donde en el primer campo se guarda el id del vocabulario y en el segundo los campos de autories.
            return $datos;
        }

        public function mostrarUbicaciones() {
            $sql = "SELECT id_ubicacion, descripcion_ubicacion, id_padre FROM ubicaciones";
            $db = $this->conectar();

            try {
                $query = $db->prepare($sql);
                $query->execute();
            }catch (PDOException $error){
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

           
            $tree = []; //array para agrupar la consulta por id_padre
            foreach ($resultado as $item) {
                if($item['id_padre'] == NULL){
                    $tree[0][] = $item;
                }else{
                    $tree[$item['id_padre']][] = $item; //agrupamos los elementos por id_padre de $item
                } //guardamos la ubicación en la variable $item
            }

            return $tree;
        }

        public function obtenerUbicaciones() {
            $sql = "SELECT id_ubicacion, descripcion_ubicacion FROM ubicaciones";

            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            }catch (PDOException $error){
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }

        public function obtenerHijos($id_padre) { //ID_ubicación del padre que queremos ver sus hijos
            $sql = "SELECT id_ubicacion, descripcion_ubicacion, id_padre FROM ubicaciones WHERE id_padre = :id_padre"; //solo las ubicacion que sean hijas del padre
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->bindParam(':id_padre', $id_padre); // asigna el valor de $id_padre al :id_padre que hemos puesto en la consulta
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); //devuelve los hijos del padre que queremos
        }

        public function crearUbicacion($nombreUbicacion, $comentari) {
            $sql = "INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, comentario_ubicacion) VALUES ('$nombreUbicacion', NULL, '$comentari')";
            $db = $this->conectar();
            $query = $db -> prepare($sql);
            $query->execute();
        }

        public function crearUbicacionHija($nombreUbicacion, $id_padre, $comentari) {
            $sql = "INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, comentario_ubicacion) VALUES ('$nombreUbicacion', $id_padre, '$comentari')";
            $db = $this->conectar();
            $query = $db -> prepare($sql);
            $query->execute();
        }

        public function ubicacionesDescendientes($id_ubicacion) {
            $db = $this->conectar(); 
        
            $ubicaciones = [$id_ubicacion]; 
        
            $sql = "SELECT id_ubicacion FROM ubicaciones WHERE id_padre = :id_ubicacion";
            $query = $db->prepare($sql);
            $query->bindParam(':id_ubicacion', $id_ubicacion, PDO::PARAM_INT);
            $query->execute();
        
            $hijos = $query->fetchAll(PDO::FETCH_COLUMN);

            foreach ($hijos as $hijo) {
                $ubicaciones = array_merge($ubicaciones, $this->ubicacionesDescendientes($hijo));
            }
        
            return $ubicaciones;
        }

        public function eliminarUbicacion($id_ubicacion) {
            $relacionesAInsertar = [];
            $respuesta = null;
            $respuesta2 = null;
            $hayObra = null;
            $db = $this->conectar();
            $ubicacionesDescendientes = $this->ubicacionesDescendientes($id_ubicacion);
            foreach ($ubicacionesDescendientes as $ubicacionDescendiente) {
                $sql3 = "SELECT * FROM obras_ubicaciones WHERE fk_ubicacion = :ubicacionDescendiente";
                $query3 = $db->prepare($sql3);
                $query3->bindParam(':ubicacionDescendiente', $ubicacionDescendiente, PDO::PARAM_INT);
                $query3->execute();
                $fechaFinHijo = $query3->fetchAll(PDO::FETCH_ASSOC);
                foreach ($fechaFinHijo as $fila) {
                    $selectNombreObra = "SELECT titulo FROM obras WHERE numero_registro = " . "'" . $fila['fk_obra'] . "'";
                    $querySelect2 = $db->prepare($selectNombreObra);
                    
                    $querySelect2->execute();
                    $nombre_obra = $querySelect2->fetch(PDO::FETCH_ASSOC);
                    $selectNombreUbicacion = "SELECT descripcion_ubicacion FROM ubicaciones WHERE id_ubicacion = " . $fila['fk_ubicacion'];
                    $querySelect = $db->prepare($selectNombreUbicacion);
                    $querySelect->execute();
                    $idUbi = $querySelect->fetch(PDO::FETCH_ASSOC);

                    $relacionesAInsertar[] = [
                        'id_obra' => $fila['fk_obra'],
                        'nombre_obra' => $nombre_obra['titulo'],
                        'nombre_ubicacion' => $idUbi['descripcion_ubicacion'],
                        'fecha_inicio' => $fila['fecha_inicio_ubicacion'],
                        'fecha_fin' => $fila['fecha_fin_ubicacion']
                    ];
                    if ($fila['fecha_fin_ubicacion'] === null){
                        $hayObra = true;
                    }
                }
            }
            if ($hayObra === true){
                $respuesta = "hay obra";
            }else {
                $respuesta = "no hay obra";
            }

            if ($respuesta === "no hay obra"){
                $selectObrasHijas = "SELECT * FROM ubicaciones WHERE ID_padre = " . $id_ubicacion;
                $querySelectObrasHijas = $db->prepare($selectObrasHijas);
                $querySelectObrasHijas->execute();

                if ($querySelectObrasHijas->rowCount() > 0){
                    $respuesta2 = "hay ubicacion";
                }else{
                    foreach($relacionesAInsertar as $relaccion){
                        $insert = "INSERT INTO historial_obras_ubicaciones (id_obra, nombre_obra, nombre_ubicacion, fecha_inicio, fecha_fin) VALUES
                        ('" . $relaccion['id_obra'] . "', '" . $relaccion['nombre_obra'] . "', '" . $relaccion['nombre_ubicacion'] . "', '" . $relaccion['fecha_inicio'] . "', '" .$relaccion['fecha_fin'] . "')";
                        $queryInsert = $db->prepare($insert);
                        $queryInsert->execute();
                    }
    
                    $sql5 = "DELETE FROM ubicaciones WHERE id_ubicacion = $id_ubicacion";
                    $query5 = $db->prepare($sql5);
                    $query5->execute();
                    $respuesta2 = "no hay ubicacion";
                }
            }else if ($respuesta === "hay obra"){
                $respuesta2 = "hay obra";
            }
            return $respuesta2;
        }

        public function mostrarHistorial($id_ubicacion) {
            $db = $this->conectar();
        
            $obrasAntiguas = [];
            $obrasActuales = [];
        
            // Obtener el nombre de la ubicación
            $sql2 = "SELECT descripcion_ubicacion FROM ubicaciones WHERE id_ubicacion = ?";
            try {
                $query2 = $db->prepare($sql2);
                $query2->execute([$id_ubicacion]);
                $nombre_ubi = $query2->fetch(PDO::FETCH_ASSOC);
        
                // Verificar si se encontró la ubicación
                $nombre_ubicacion = $nombre_ubi ? $nombre_ubi['descripcion_ubicacion'] : null;
            } catch (PDOException $error) {
                echo "Error al obtener la ubicación: " . $error->getMessage();
            }
        
            // Obtener obras antiguas si se encontró el nombre de la ubicación
            if ($nombre_ubicacion) {
                $sql = "SELECT id_obra, nombre_obra, fecha_inicio, fecha_fin 
                        FROM historial_obras_ubicaciones 
                        WHERE nombre_ubicacion = ?";
                try {
                    $relaccionesAntiguas = $db->prepare($sql);
                    $relaccionesAntiguas->execute([$nombre_ubicacion]);
                    $obrasAntiguas = $relaccionesAntiguas->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $error) {
                    echo "Error al obtener las obras antiguas: " . $error->getMessage();
                }
            }
        
            // Obtener obras actuales
            $sql3 = "SELECT o.titulo, u.descripcion_ubicacion, ou.fecha_inicio_ubicacion, ou.fecha_fin_ubicacion  
                     FROM obras_ubicaciones ou 
                     INNER JOIN obras o ON o.numero_registro = ou.fk_obra
                     INNER JOIN ubicaciones u ON ou.fk_ubicacion = u.id_ubicacion 
                     WHERE u.id_ubicacion = ?";
            try {
                $relaccionesActuales = $db->prepare($sql3);
                $relaccionesActuales->execute([$id_ubicacion]);
                $obrasActuales = $relaccionesActuales->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $error) {
                echo "Error al obtener las obras actuales: " . $error->getMessage();
            }
        
            // Retorna las obras antiguas y actuales
            return [
                'obrasAntiguas' => $obrasAntiguas,
                'obrasActuales' => $obrasActuales
            ];
        }

        function obtenerNombreCampo($id){
            $db = $this->conectar();
            $sql = "SELECT nombre_vocabulario FROM vocabularios WHERE id_vocabulario LIKE ?";
            $query = $db->prepare($sql);
            $query->execute([$id]);

            if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $res = $row['nombre_vocabulario'];
            }else{
                $res = null;
            }
            return $res;
        }
        
        function obtenerCodigosGetty($nombre){
            $db = $this->conectar();
            $sql = "SELECT * FROM codigos_getty WHERE fk_nombre_campo LIKE ?";
            $query = $db->prepare($sql);
            $query->execute([$nombre]);
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            
            return $res;
        }
    }
?>