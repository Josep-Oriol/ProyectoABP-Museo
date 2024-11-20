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
            $sql = "SELECT nombre_vocabulario FROM vocabularios WHERE id_vocabulario = $idVocabulario";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $nombreVocabulario = $query->fetch(PDO::FETCH_ASSOC);
            
            //Obtenemos cada campo del vocabulario en cuestión mediante la ID del vocabulario pasado como argumento.
            $sql = "SELECT id_campo, nombre_campo FROM campos WHERE fk_vocabulario = $idVocabulario";
            try {
                $query = $db->prepare($sql);
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
            $sql = "INSERT INTO vocabularios VALUES ('$nombre')";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
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
            $sql = "INSERT INTO campos (nombre_campo, fk_vocabulario) VALUES ('$nombreCampo', $idVocabulario)";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
                $filas = $query->rowCount();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
            $create = $filas > 0 ? true : false;
            return $create;
        }

        public function editarCampo($antiguoValor, $nuevoValor) {
             //$antiguoValor = str_replace('_', " ", $antiguoValor); //por defecto el indice tiene una _ en vez de un espacio, por eso lo reemplaza
            if($antiguoValor != $nuevoValor){
                $sql = "UPDATE campos SET nombre_campo = '$nuevoValor' WHERE nombre_campo = '$antiguoValor'";
                $db = $this->conectar();
                try {
                    $query = $db->prepare($sql);
                    $query->execute();
                    return true;
                } catch (PDOException $error) {
                    echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                    return false;
                }
            }else{
                return false;
            }
        }

        public function eliminarCampo($idCampo) {
            $sql = "DELETE FROM campos WHERE nombre_campo = '$idCampo'";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
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

        public function eliminarUbicacion($id_ubicacion) {
            $sql = "DELETE FROM ubicaciones WHERE id_ubicacion = $id_ubicacion";
            $db = $this->conectar();
            $query = $db->prepare($sql);
            return $query->execute();
        }
    }
?>