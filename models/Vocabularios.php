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

        public function crearCampo($idVocabulario, $nombreCampo) {
            $sql = "INSERT INTO campos (nombre_campo, fk_vocabulario) VALUES ('$nombreCampo', $idVocabulario)";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
        }

        public function editarCampo($antiguoValor, $nuevoValor) {
            $antiguoValor = str_replace('_', " ", $antiguoValor); //por defecto el indice tiene una _ en vez de un espacio, por eso lo reemplaza
            if($antiguoValor != $nuevoValor){
                $sql = "UPDATE campos SET nombre_campo = '$nuevoValor' WHERE nombre_campo = '$antiguoValor'";
                $db = $this->conectar();
                try {
                    $query = $db->prepare($sql);
                    $query->execute();
                } catch (PDOException $error) {
                    echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                }
            }
        }

        public function eliminarCampo($idCampo) {
            $sql = "DELETE FROM campos WHERE id_campo = $idCampo";
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->execute();
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }
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
            foreach ($resultado as $item) { //guardamos la ubicación en la variable $item
                $tree[$item['id_padre']][] = $item; //agrupamos los elementos por id_padre de $item
            }

            return $tree;
        }

        public function obtenerHijos($id_padre) { //ID_ubicación del padre que queremos ver sus hijos
            $sql = "SELECT id_ubicacion, descripcion_ubicacion, id_padre FROM ubicaciones WHERE id_padre = :id_padre"; //solo las ubicacion que sean hijas del padre
            $db = $this->conectar();
            $query = $db->prepare($sql);
            $query->bindParam(':id_padre', $id_padre); // asigna el valor de $id_padre al :id_padre que hemos puesto en la consulta
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); //devuelve los hijos del padre que queremos
        }

        public function crearUbicacion($nombreUbicacion, $fecha_inicio_ubicacion, $fecha_fin_ubicacion, $comentari) {
            $formato_mysql_fi = date("Y-m-d H:i:s",strtotime($fecha_inicio_ubicacion)); //convertir las fechas al formato correcto en mysql
            $formato_mysql_ff = date("Y-m-d H:i:s",strtotime($fecha_fin_ubicacion));
            $sql = "INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, fecha_inicio_ubicacion, fecha_fin_ubicacion, comentario_ubicacion) VALUES ('$nombreUbicacion', 0, '$formato_mysql_fi', '$formato_mysql_ff', '$comentari')";
            $db = $this->conectar();
            $query = $db -> prepare($sql);
            $query->execute();
        }

        public function crearUbicacionHija($nombreUbicacion, $id_padre, $fecha_inicio_ubicacion, $fecha_fin_ubicacion, $comentari) {
            $formato_mysql_fi = date("Y-m-d H:i:s",strtotime($fecha_inicio_ubicacion));
            $formato_mysql_ff = date("Y-m-d H:i:s",strtotime($fecha_fin_ubicacion));
            $sql = "INSERT INTO ubicaciones (descripcion_ubicacion, id_padre, fecha_inicio_ubicacion, fecha_fin_ubicacion, comentario_ubicacion) VALUES ('$nombreUbicacion', $id_padre, '$formato_mysql_fi', '$formato_mysql_ff', '$comentari')";
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