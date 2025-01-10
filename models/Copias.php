
<?php
/*
require_once 'Database.php';

class Copias extends Database{

    function obtenerCopias(){
        $sql = 'SELECT * FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario';
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

    function crearCopia($array, $id, $date) {
        $nombre = $array['nom'];
        $descripcion = $array['desc'];
        $fecha = $array['fecha'];
        $creador = $id;

        $exitoso = false;

        $selectId = "SELECT id_copia FROM copias_seguridad WHERE nombre_copia = ?";
        $sql = 'INSERT INTO copias_seguridad (nombre_copia, descripcion_copia, fecha_copia, fk_creador, ruta)
        VALUE (?, ? ,? , ?, ?)';

        $db = $this->conectar();
        
        try {
            $query = $db->prepare($sql);
            $ruta = "backups/".'copia_de_seguretat'."_" . $date . '.sql';
            $exitoso = $query->execute([$nombre, $descripcion, $fecha, $creador, $ruta]);
        } catch (PDOException $error) {
            $exitoso = false;
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }

        if ($exitoso){
            $db = $this->conectar();

            try {
                $query2 = $db->prepare($selectId);
                $exitoso2 = $query2->execute([$nombre]);
                $resultado = $query2->fetch(PDO::FETCH_ASSOC);
                $idCopia = $resultado['id_copia'];
            } catch (PDOException $error) {
                $exitoso2 = false;
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
            }

            if($exitoso2){
                require_once __DIR__ . "/../config.php";
                $this->copiaSeguridad($idCopia, $date);
            }
        }

        return $exitoso;
    }

    public function copiaSeguridad($idCopia, $date){ // FUNCION PARA CREAR EL BACKCUP Y EN DESCARGAS Y EN EL
        $servername = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USER;
        $password = DB_PASSWORD;

        $usuario = getenv('USERNAME');

        $archivoCopia = 'C:\Users\\' . $usuario . '\Downloads\copia_de_seguretat'. "_" . $date . '.sql';

        $comandoCopia = "mysqldump --no-tablespaces --ignore-table={$dbname}.copias_seguridad -u{$username} -h{$servername} -p{$password} {$dbname}  > {$archivoCopia}";
        
        $resultado = null;
        $salida = [];
        exec($comandoCopia, $salida, $resultado);

        $destino = "backups/".'copia_de_seguretat'. "_" . $date . '.sql';
        copy($archivoCopia, $destino);

        if($resultado === 0){
            echo "copia de seguridad hecha con exito";
        }

    }

    public function mostrarCopia($numeroRegistro) {
		$sql = "SELECT * FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario WHERE id_copia = $numeroRegistro";
		
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}

		$resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function editarCopia($array, $id) {
        $nombre = $array['nom'];
        $descripcion = $array['desc'];
        $exitoso = false;

        $sql = "UPDATE copias_seguridad SET nombre_copia = ?, descripcion_copia = ? WHERE id_copia = ?";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $exitoso = $query->execute([$nombre, $descripcion, $id]);
            
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        return $exitoso;
    }

    public function eliminarCopia($id, $ruta){
        $sql = "DELETE FROM copias_seguridad WHERE id_copia = $id";
        $db = $this->conectar();
        try {
            unlink($ruta);
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function rutaBackup($id){
        $sql = "SELECT ruta FROM copias_seguridad WHERE id_copia = $id";
        $db = $this->conectar();

        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){

        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function consultaImportar($consulta){

        $db = $this->conectar();
        try {
            $query = $db->prepare($consulta);
            $query->execute();
            
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }


} */


require_once 'Database.php';

class Copias extends Database {
    
    function obtenerCopias() {
        $sql = 'SELECT * FROM copias_seguridad cs INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario';
        $db = $this->conectar();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            error_log("Error in obtenerCopias: " . $error->getMessage());
            throw new Exception("Error al obtener copias de seguridad");
        }
    }

    function crearCopia($array, $id, $date) {
        if (!$this->validarDatosCopia($array)) {
            throw new Exception("Datos de copia inválidos");
        }

        $nombre = trim($array['nom']);
        $descripcion = trim($array['desc']);
        $fecha = trim($array['fecha']);
        $creador = (int)$id;
        
        $db = $this->conectar();
        $db->beginTransaction();

        try {
            // Primero verificamos si ya existe una copia con ese nombre
            $checkSql = "SELECT COUNT(*) FROM copias_seguridad WHERE nombre_copia = ?";
            $checkStmt = $db->prepare($checkSql);
            $checkStmt->execute([$nombre]);
            
            if ($checkStmt->fetchColumn() > 0) {
                throw new Exception("Ya existe una copia con ese nombre");
            }

            // Insertar nueva copia
            $sql = 'INSERT INTO copias_seguridad (nombre_copia, descripcion_copia, fecha_copia, fk_creador, ruta) 
                    VALUES (?, ?, ?, ?, ?)';
            
            $ruta = "backups/copia_de_seguretat_" . htmlspecialchars($date) . '.sql';
            
            $stmt = $db->prepare($sql);
            $stmt->execute([$nombre, $descripcion, $fecha, $creador, $ruta]);
            
            $idCopia = $db->lastInsertId();
            
            if ($idCopia) {
                require_once __DIR__ . "/../config.php";
                $this->copiaSeguridad($idCopia, $date);
                $db->commit();
                return true;
            }
            
            $db->rollBack();
            return false;

        } catch (PDOException $error) {
            $db->rollBack();
            error_log("Error in crearCopia: " . $error->getMessage());
            throw new Exception("Error al crear la copia de seguridad");
        }
    }

    protected function validarDatosCopia($array) {
        return isset($array['nom']) && 
               isset($array['desc']) && 
               isset($array['fecha']) &&
               !empty(trim($array['nom'])) &&
               strlen($array['nom']) <= 255 &&
               strlen($array['desc']) <= 1000;
    }

    public function copiaSeguridad($idCopia, $date) {
        if (!is_numeric($idCopia) || empty($date)) {
            throw new Exception("Parámetros inválidos");
        }

        require_once __DIR__ . "/../config.php";
        
        $servername = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USER;
        $password = DB_PASSWORD;

        // Sanitizar el nombre de usuario y la fecha para la ruta
        $usuario = preg_replace('/[^a-zA-Z0-9]/', '', getenv('USERNAME'));
        $date = preg_replace('/[^0-9_-]/', '', $date);
        
        if(strtoupper(substr(PHP_OS, 0, 3)) == "WIN"){
            $archivoCopia = 'C:\Users\\' . $usuario . '\Downloads\copia_de_seguretat_' . $date . '.sql';
        }else if (strtoupper(substr(PHP_OS, 0, 3)) == "LIN"){
            $archivoCopia = '~/copia_de_seguretat_' . $date . '.sql';
        }
        
        
        // Escapar los argumentos del comando
        $comandoCopia = sprintf(
            'mysqldump --no-tablespaces --ignore-table=%s.copias_seguridad -u%s -h%s -p%s %s > %s',
            escapeshellarg($dbname),
            escapeshellarg($username),
            escapeshellarg($servername),
            escapeshellarg($password),
            escapeshellarg($dbname),
            escapeshellarg($archivoCopia)
        );
        
        $resultado = null;
        $salida = [];
        exec($comandoCopia, $salida, $resultado);

        if ($resultado === 0) {
            $destino = "backups/copia_de_seguretat_" . $date . '.sql';
            if (!copy($archivoCopia, $destino)) {
                throw new Exception("Error al copiar el archivo de respaldo");
            }
            return true;
        }
        
        throw new Exception("Error al crear la copia de seguridad");
    }

    public function mostrarCopia($numeroRegistro) {
        if (!is_numeric($numeroRegistro)) {
            throw new Exception("ID de copia inválido");
        }

        $sql = "SELECT * FROM copias_seguridad cs 
                INNER JOIN usuarios u ON cs.fk_creador = u.id_usuario 
                WHERE id_copia = ?";
        
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute([$numeroRegistro]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            error_log("Error in mostrarCopia: " . $error->getMessage());
            throw new Exception("Error al mostrar la copia");
        }
    }

    public function editarCopia($array, $id) {
        if (!$this->validarDatosCopia($array) || !is_numeric($id)) {
            throw new Exception("Datos inválidos para editar copia");
        }

        $nombre = trim($array['nom']);
        $descripcion = trim($array['desc']);

        $sql = "UPDATE copias_seguridad SET nombre_copia = ?, descripcion_copia = ? WHERE id_copia = ?";
        $db = $this->conectar();
        
        try {
            $query = $db->prepare($sql);
            return $query->execute([$nombre, $descripcion, $id]);
        } catch (PDOException $error) {
            error_log("Error in editarCopia: " . $error->getMessage());
            throw new Exception("Error al editar la copia");
        }
    }

    public function eliminarCopia($id, $ruta) {
        if (!is_numeric($id) || empty($ruta)) {
            throw new Exception("Parámetros inválidos para eliminar copia");
        }

        $sql = "DELETE FROM copias_seguridad WHERE id_copia = ?";
        $db = $this->conectar();
        
        try {
            if (file_exists($ruta) && !unlink($ruta)) {
                throw new Exception("Error al eliminar el archivo físico");
            }
            
            $query = $db->prepare($sql);
            return $query->execute([$id]);
        } catch (PDOException $error) {
            error_log("Error in eliminarCopia: " . $error->getMessage());
            throw new Exception("Error al eliminar la copia");
        }
    }

    public function rutaBackup($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID de copia inválido");
        }

        $sql = "SELECT ruta FROM copias_seguridad WHERE id_copia = ?";
        $db = $this->conectar();

        try {
            $query = $db->prepare($sql);
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            error_log("Error in rutaBackup: " . $error->getMessage());
            throw new Exception("Error al obtener la ruta del backup");
        }
    }

    public function consultaImportar($consulta) {
        // IMPORTANTE: Esta función podría ser peligrosa si acepta consultas arbitrarias
        // Se recomienda implementar validaciones específicas según el tipo de importación
        if (empty($consulta)) {
            throw new Exception("Consulta vacía");
        }

        $db = $this->conectar();
        try {
            $query = $db->prepare($consulta);
            return $query->execute();
        } catch (PDOException $error) {
            error_log("Error in consultaImportar: " . $error->getMessage());
            throw new Exception("Error al importar la consulta");
        }
    }
}