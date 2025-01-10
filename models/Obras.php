<?php
require_once "Database.php";
class Obras extends Database {

	public function mostrarObras(){
		//Obtenemos todos los datos de obras y la descripción de la ubicación mediante la unión de la tabla de obras y ubicaciones.
        $sql = "SELECT * FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
				INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion";
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

	public function mostrarObra($numeroRegistro) {
		//Obtenemos todos los datos de obras, ubicaciones, bajas, usuarios, exposiciones y restauraciones mediante la unión de todas las tablas mediante la clave primaria de la obra
		$sql = "SELECT * FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
			INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion
			LEFT JOIN obras_exposiciones oe ON oe.fk_obra = o.numero_registro
			LEFT JOIN exposiciones e ON e.id_exposicion = oe.fk_exposicion
			LEFT JOIN logs_obras l ON l.fk_obra = o.numero_registro
			LEFT JOIN usuarios us ON us.id_usuario = l.persona_autorizada
			LEFT JOIN obras_restauraciones ores ON ores.fk_obra = o.numero_registro
			LEFT JOIN restauraciones r ON r.id_restauracion = ores.fk_restauracion 
			WHERE o.numero_registro = '$numeroRegistro'";
		
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

	public function obtenerUltimoNumeroRegistro($letra) {
		if (empty($letra)) { //Si no hay letra obtenemos el numero de registro más alto y que empiece por numeros. Con CAST lo convertimos a numero para que los ordene bien
			$sql = "SELECT numero_registro FROM obras WHERE numero_registro REGEXP '^[0-9]' ORDER BY CAST(numero_registro AS FLOAT) DESC LIMIT 1";
		}
		else {
			$sql = "SELECT numero_registro FROM obras WHERE numero_registro LIKE '$letra%' ORDER BY numero_registro DESC LIMIT 1";
		}

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

	public function consultarNumeroRegistro($numeroRegistro) {
		$sql = "SELECT numero_registro FROM obras WHERE numero_registro = '$numeroRegistro'";
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}
		$existe = false;
		if ($query->rowCount() > 0) {
			$existe = true;
		}
		return $existe;
	}
	
	public function crearObra($array) {
		if (!empty($array['decimales'])) {
			$array['numero_registro'] = $array['letra'] . $array['numero_registro'] . "." . $array['decimales'];
		}
		else {
			$array['numero_registro'] = $array['letra'] . $array['numero_registro'];
		}

		if (!empty($array['id_ubicacion'])) {
			$sql2 = "INSERT INTO obras_ubicaciones (fk_obra, fk_ubicacion, fecha_inicio_ubicacion) VALUES ('{$array['numero_registro']}', {$array['id_ubicacion']}, '{$array['fecha_inicio_ubicacion']}')";
		}
		if (!empty($array['id_exposicion'])) {
			$sql3 = "INSERT INTO obras_exposiciones (fk_obra, fk_exposicion) VALUES ('{$array['numero_registro']}', {$array['id_exposicion']})";
		}

		//Campos que llegan por POST pero que no son de la tabla de obras
		$camposQuitarArray = ['id_ubicacion', 'fecha_inicio_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion', 'letra', 'decimales'];

		foreach ($camposQuitarArray as $indice => $campo) {
			unset($array[$campo]); //Eliminamos las claves del $_POST que esten dentro del array anterior
		}

		$orden = ['numero_registro', 'nombre_objeto', 'fotografia', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		
		//Como por defecto se desordenan, los ordenamos en el orden que estan en la base de datos.
		$camposOrdenados = array_replace(array_flip($orden), $array);

		foreach ($camposOrdenados as $indice => $campo) {
			if ($indice == 'numero_registro') {
				$camposOrdenados[$indice] = "'$campo'"; //Agregamos comillas al campo numero_registro porque si no tiene letra se detecta como numerico
			}
			else if (!empty($campo)) {
				if (!is_numeric($campo)) {
					$camposOrdenados[$indice] = '"' . $campo . '"';
				}
			}
			else {
				$camposOrdenados[$indice] = "NULL";
			}
		}

		$valores = implode(", ", $camposOrdenados); //Obtenemos los valores del array separados por comas.
		$sql = "INSERT INTO obras VALUES (" . $valores . ")";
		
		$db = $this->conectar();
		$exitoso = false;
		try {
			$query = $db->prepare($sql);
			if ($query->execute()) {
				$exitoso = true;
			}
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}

		if ($exitoso) {
			if (isset($sql2)) {
				try {
					$query = $db->prepare($sql2);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
			if (isset($sql3)) {
				try {
					$query = $db->prepare($sql3);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
		}

		return $exitoso;
	}		

	public function editarObra($array, $numeroRegistro) {
		//Comprobar que se ha cambiado la ubicación
		$sql = "SELECT * FROM obras_ubicaciones WHERE fk_obra = '$numeroRegistro' AND fk_ubicacion = '{$array['id_ubicacion']}'";
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}

		if ($query->rowCount() == 0) { //Se ha cambiado la ubicación
			$sql = "SELECT id_ubicacion, descripcion_ubicacion, fecha_inicio_ubicacion FROM obras_ubicaciones ou INNER JOIN ubicaciones u ON u.id_ubicacion = ou.fk_ubicacion WHERE fk_obra = '$numeroRegistro'"; //Seleccionamos la ubicacion antigua
			try {
				$query = $db->prepare($sql);
				$query->execute();
			} catch (PDOException $error) {
				echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
			}
			$datosUbicacion = $query->fetch(PDO::FETCH_ASSOC);
			$idUbicacion = $datosUbicacion['id_ubicacion'];
			$nombreUbicacion = $datosUbicacion['descripcion_ubicacion'];
			$fechaInicio = $datosUbicacion['fecha_inicio_ubicacion'];

			$sql1 = "DELETE FROM obras_ubicaciones WHERE fk_obra = '$numeroRegistro'"; //Borramos el registro con la ubicación antigua
			$sql2 = "INSERT INTO historial_obras_ubicaciones (id_obra, nombre_obra, nombre_ubicacion, fecha_inicio, fecha_fin) VALUES ('$numeroRegistro', '{$array['titulo']}', '$nombreUbicacion', '$fechaInicio', CURDATE())"; //Insertamos el registro de la antigua ubicación en el historial
			$sql3 = "INSERT INTO obras_ubicaciones (fk_obra, fk_ubicacion, fecha_inicio_ubicacion) VALUES ('$numeroRegistro', {$array['id_ubicacion']}, '{$array['fecha_inicio_ubicacion']}')"; //Insertamos el nuevo registro con la nueva ubicación activa
		}

		$camposQuitarArray = ['numero_registro', 'id_ubicacion', 'fecha_inicio_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion', 'x', 'y'];

		foreach ($camposQuitarArray as $indice => $campo) {
			unset($array[$campo]); //Eliminamos las claves del $_POST que esten dentro del array anterior
		}

		if (isset($array['fotografia'])) {
			$orden = ['nombre_objeto', 'fotografia', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		else {
			$orden = ['nombre_objeto', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		$camposOrdenados = array_replace(array_flip($orden), $array);
		
		foreach ($camposOrdenados as $indice => $campo) {
			if ($campo != "") {
				if (!is_numeric($campo)) {
					$valor = '"' . $campo . '"';
					$camposOrdenados[$indice] = $indice . " = " . $valor; //Indice guarda el nombre del campo y campo el valor
				}
				else {
					$camposOrdenados[$indice] = "$indice = $campo";
				}
			}
			else {
				$camposOrdenados[$indice] = "$indice = NULL";
			}
		}

		$valores = implode(", ", $camposOrdenados); //Obtenemos un string del array con los valores separados por comas
		$sql = "UPDATE obras SET " . $valores . " WHERE numero_registro = '$numeroRegistro'";
	
		$exitoso = false;
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			if ($query->execute()) {
				$exitoso = true;
			}
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}

		if ($exitoso) {
			if (isset($sql1)) {
				$db = $this->conectar();
				try {
					$query = $db->prepare($sql1);
					$query->execute();
					$query = $db->prepare($sql2);
					$query->execute();
					$query = $db->prepare($sql3);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
		}
		return $exitoso;
	}

	public function subirFotografiaServidor($nombreInput, $idFotografia) {
		$directorio = "images/obras/";
		$path = pathinfo($_FILES[$nombreInput]['name']); //Obtenemos el path de la foto subida
        $extension = $path['extension'];

		$nombreFichero = $idFotografia . "." . $extension;
		move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $directorio . $nombreFichero); //Movemos el fichero de la carpeta temporal a la carpeta destino

		return $directorio . $nombreFichero;
	}

	public function eliminarFotografia($numeroRegistro) {
		$sql = "SELECT fotografia FROM obras WHERE numero_registro = '$numeroRegistro'";

		$db = $this->conectar();
		try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }

		if ($query->rowCount() > 0) { //Si la consulta devuelve 1 registro, la eliminamos.
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			if ($resultado['fotografia'] != 'images/iconDefaultObra.png') {
				unlink($resultado['fotografia']);
			}
		}
	}

	public function eliminarObra($numeroRegistro) {
		$this->eliminarFotografia($numeroRegistro);
		$sql = "DELETE FROM obras WHERE numero_registro = '$numeroRegistro'";

		$exitoso = false;
		$db = $this->conectar();
		try {
            $query = $db->prepare($sql);
            if ($query->execute()) {
				$exitoso = true;
			}
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }

		return $exitoso;
	}
    
}

?>