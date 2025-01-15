<?php
require_once "Database.php";
class Obras extends Database {

	private static $extensionesImagenes = ['jpg', 'jpeg', 'png', 'webp', 'tiff'];
	private static $extensionesMultimedia = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'webm', 'mp3', 'wav'];
	private static $extensionesDocumentos = ['pdf', 'docx', 'doc', 'odt', 'ods', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'odp', 'txt'];

	public static function getExtensionesImagenes() {
        return self::$extensionesImagenes;
    }

	public static function getExtensionesMultimedia() {
        return self::$extensionesMultimedia;
    }

	public static function getExtensionesDocumentos() {
        return self::$extensionesDocumentos;
    }

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

	public function obtenerArchivosAdicionales($numeroRegistro) {
		$sql = "SELECT * FROM archivos_obras WHERE fk_obra = '$numeroRegistro'";

		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

		$arrayOrdenado = array();
		$arrayOrdenado["imagenes"] = array();
		$arrayOrdenado["documentos"] = array();
		$arrayOrdenado["multimedia"] = array();
		$arrayOrdenado["enlaces"] = array();
		foreach ($resultado as $indice => $registro) {
			switch ($registro["tipo_archivo"]) {
				case "imagen":
					array_push($arrayOrdenado["imagenes"], $registro);
					break;
				case "documento":
					array_push($arrayOrdenado["documentos"], $registro);
					break;
				case "multimedia":
					array_push($arrayOrdenado["multimedia"], $registro);
					break;
				case "enlace":
					array_push($arrayOrdenado["enlaces"], $registro);
					break;
			}
		}
		return $arrayOrdenado;
	}

	public function obtenerHistorialObras($numeroRegistro) {
		$sql = "SELECT nombre_ubicacion, fecha_inicio, fecha_fin FROM historial_obras_ubicaciones WHERE id_obra = '$numeroRegistro'";
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
		
		if (isset($array['archivos']) || isset($array['enlaces'])) {
			$sql4 = "INSERT INTO archivos_obras (fk_obra, nombre_archivo, tipo_archivo, enlace_ruta) VALUES ";
			if (isset($array['archivos'])) {
				$archivosAdicionales = $array['archivos'];
				
				foreach ($archivosAdicionales as $archivo) {
					$path = pathinfo($archivo);
					$nombreArchivo = $path['basename'];
					$extension = $path['extension'];
					$esImagen = in_array($extension, self::$extensionesImagenes);
					$esDocumento = in_array($extension, self::$extensionesDocumentos);

					$tipoArchivo = '';
					if ($esImagen) {
						$tipoArchivo = "imagen";
					}
					else if ($esDocumento) {
						$tipoArchivo = "documento";
					}
					else {
						$tipoArchivo = "multimedia";
					}
					$sql4 .= '("' . $array['numero_registro'] . '", "' . $nombreArchivo . '", "' . $tipoArchivo . '", "' . $archivo . '"),';
				}
			}
			if (isset($array['enlaces'])) {
				$nombres = $array['nombres_enlaces'];
				$enlaces = $array['enlaces'];

				foreach($enlaces as $indice => $enlace) {
					$nombreEnlace = $nombres[$indice];
					$sql4 .= '(' . '"' . $array['numero_registro'] . '", "' . $nombreEnlace . '", "enlace", "' . $enlace . '"),';
				}
			}
			$sql4 = substr_replace($sql4, ";", -1, 1); //Sustituimos el último carácter que es la coma, por un punto y coma
		}

		//Campos que llegan por POST pero que no son de la tabla de obras
		$camposQuitarArray = ['id_ubicacion', 'fecha_inicio_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion', 'letra', 'decimales', 'archivos', 'nombres_enlaces', 'enlaces'];

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
			if (isset($sql4)) {
				try {
					$query = $db->prepare($sql4);
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

		if (isset($array['archivos']) || isset($array['enlaces'])) {
			$sql4 = "INSERT INTO archivos_obras (fk_obra, nombre_archivo, tipo_archivo, enlace_ruta) VALUES ";
			if (isset($array['archivos'])) {
				$archivosAdicionales = $array['archivos'];
				
				foreach ($archivosAdicionales as $archivo) {
					$path = pathinfo($archivo);
					$nombreArchivo = $path['basename'];
					$extension = $path['extension'];
					$esImagen = in_array($extension, self::$extensionesImagenes);
					$esDocumento = in_array($extension, self::$extensionesDocumentos);

					$tipoArchivo = '';
					if ($esImagen) {
						$tipoArchivo = "imagen";
					}
					else if ($esDocumento) {
						$tipoArchivo = "documento";
					}
					else {
						$tipoArchivo = "multimedia";
					}
					$sql4 .= '("' . $numeroRegistro . '", "' . $nombreArchivo . '", "' . $tipoArchivo . '", "' . $archivo . '"),';
				}
			}
			if (isset($array['enlaces'])) {
				$nombres = $array['nombres_enlaces'];
				$enlaces = $array['enlaces'];

				foreach($enlaces as $indice => $enlace) {
					$nombreEnlace = $nombres[$indice];
					$sql4 .= '(' . '"' . $numeroRegistro . '", "' . $nombreEnlace . '", "enlace", "' . $enlace . '"),';
				}
			}
			$sql4 = substr_replace($sql4, ";", -1, 1); //Sustituimos el último carácter que es la coma, por un punto y coma
		}

		if (isset($array['nombres_enlaces_editados'])) {
			$nombresEditados = $array['nombres_enlaces_editados'];
			foreach($nombresEditados as $indice => $nombre) {
				$sql5 = "UPDATE archivos_obras SET nombre_archivo = '$nombre' WHERE id_archivo = $indice";
				try {
					$query = $db->prepare($sql5);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
		}

		if (isset($array['enlaces_editados'])) {
			$enlacesEditados = $array['enlaces_editados'];
			foreach($enlacesEditados as $indice => $enlace) {
				$sql6 = "UPDATE archivos_obras SET enlace_ruta = '$enlace' WHERE id_archivo = $indice";
				try {
					$query = $db->prepare($sql6);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
		}

		if (isset($array['borrar_enlaces'])) {
			$enlacesBorrar = $array['borrar_enlaces'];
			$sql7 = "DELETE FROM archivos_obras WHERE id_archivo IN (" . implode(',', $enlacesBorrar) . ")";
		}

		if (isset($array['borrar_archivos'])) {
			$archivosBorrar = $array['borrar_archivos'];
			$sql8 = "SELECT enlace_ruta FROM archivos_obras WHERE id_archivo IN (" . implode(',', $archivosBorrar) . ")";
			try {
				$query = $db->prepare($sql8);
				$query->execute();
			} catch (PDOException $error) {
				echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
			}
			$registros = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($registros as $registro) {
				unlink($registro['enlace_ruta']);
			}
			$sql9 = "DELETE FROM archivos_obras WHERE id_archivo IN (" . implode(',', $archivosBorrar) . ")";
		}

		$camposQuitarArray = ['numero_registro', 'id_ubicacion', 'fecha_inicio_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion', 'x', 'y', 'archivos', 'borrar_archivos', 'nombres_enlaces', 'enlaces', 'nombres_enlaces_editados', 'enlaces_editados', 'borrar_enlaces'];

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

			if (isset($sql4)) {
				$db = $this->conectar();
				try {
					$query = $db->prepare($sql4);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}

			if (isset($sql7)) {
				$db = $this->conectar();
				try {
					$query = $db->prepare($sql7);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}

			if (isset($sql9)) {
				$db = $this->conectar();
				try {
					$query = $db->prepare($sql9);
					$query->execute();
				} catch (PDOException $error) {
					echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
				}
			}
		}
		return $exitoso;
	}

	public function subirArchivoServidor($archivo, $idArchivo, $rutaTemporal, $rutaDestino) {
		$path = pathinfo($archivo); //Obtenemos el path del archivo subido
        $extension = $path['extension'];

		$nombreArchivo = $idArchivo . "." . $extension;
		move_uploaded_file($rutaTemporal, $rutaDestino . $nombreArchivo); //Movemos el fichero de la carpeta temporal a la carpeta destino

		return $rutaDestino . $nombreArchivo;
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