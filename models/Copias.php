<?php

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


}