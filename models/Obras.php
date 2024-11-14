<?php
require_once "Database.php";
class Obras extends Database {
    private $numeroRegistro;
	private $nombreMuseo;
	private $fotografia;
	private $clasificacionGenerica;
	private $nombreDelObjeto;
	private $coleccionDeProcedencia;
	private $medidasMaximaAlturaCm;
	private $medidasAnchuraAlturaCm;
	private $medidasProfundidadAlturaCm;
	private $material;
	private $tecnica;
	private $autor;
	private $titulo;
	private $anyoInicial;
	private $anyoFinal;
	private $datacion;
	private $ubicacion;
	private $fechaInicioUbicacion;
	private $fechaFinUbicacion;
	private $comentarioUbicacion;
	private $comentarioDeRegistro;
	private $numeroDeEjemplares;
	private $formaDeIngreso;
	private $fechaDeIngreso;
	private $fuenteDeIngreso;
	private $estadoDeConservacion;
	private $lugarDeEjecucion;
	private $lugarDeProcedencia;
	private $numTiraje;
	private $otrosNumerosDeIdentificacion;
	private $valoracionEconomica;
	private $bibliografia;
	private $descripcion;
	private $historiaDelObjeto;
	private $idExposicion;
	private $idUbicacion;


	//Getters y Setters
	public function getNumeroRegistro(){
		return $this->numeroRegistro;
	}

	public function setNumeroRegistro($numeroRegistro){
		$this->numeroRegistro = $numeroRegistro;
	}

	public function getNombreMuseo(){
		return $this->nombreMuseo;
	}

	public function setNombreMuseo($nombreMuseo){
		$this->nombreMuseo = $nombreMuseo;
	}

	public function getFotografia(){
		return $this->fotografia;
	}

	public function setFotografia($fotografia){
		$this->fotografia = $fotografia;
	}

	public function getClasificacionGenerica(){
		return $this->clasificacionGenerica;
	}

	public function setClasificacionGenerica($clasificacionGenerica){
		$this->clasificacionGenerica = $clasificacionGenerica;
	}

	public function getNombreDelObjeto(){
		return $this->nombreDelObjeto;
	}

	public function setNombreDelObjeto($nombreDelObjeto){
		$this->nombreDelObjeto = $nombreDelObjeto;
	}

	public function getColeccionDeProcedencia(){
		return $this->coleccionDeProcedencia;
	}

	public function setColeccionDeProcedencia($coleccionDeProcedencia){
		$this->coleccionDeProcedencia = $coleccionDeProcedencia;
	}

	public function getMedidasMaximaAlturaCm(){
		return $this->medidasMaximaAlturaCm;
	}

	public function setMedidasMaximaAlturaCm($medidasMaximaAlturaCm){
		$this->medidasMaximaAlturaCm = $medidasMaximaAlturaCm;
	}

	public function getMedidasAnchuraAlturaCm(){
		return $this->medidasAnchuraAlturaCm;
	}

	public function setMedidasAnchuraAlturaCm($medidasAnchuraAlturaCm){
		$this->medidasAnchuraAlturaCm = $medidasAnchuraAlturaCm;
	}

	public function getMedidasProfundidadAlturaCm(){
		return $this->medidasProfundidadAlturaCm;
	}

	public function setMedidasProfundidadAlturaCm($medidasProfundidadAlturaCm){
		$this->medidasProfundidadAlturaCm = $medidasProfundidadAlturaCm;
	}

	public function getMaterial(){
		return $this->material;
	}

	public function setMaterial($material){
		$this->material = $material;
	}

	public function getTecnica(){
		return $this->tecnica;
	}

	public function setTecnica($tecnica){
		$this->tecnica = $tecnica;
	}

	public function getAutor(){
		return $this->autor;
	}

	public function setAutor($autor){
		$this->autor = $autor;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getAnyoInicial(){
		return $this->anyoInicial;
	}

	public function setAnyoInicial($anyoInicial){
		$this->anyoInicial = $anyoInicial;
	}

	public function getAnyoFinal(){
		return $this->anyoFinal;
	}

	public function setAnyoFinal($anyoFinal){
		$this->anyoFinal = $anyoFinal;
	}

	public function getDatacion(){
		return $this->datacion;
	}

	public function setDatacion($datacion){
		$this->datacion = $datacion;
	}

	public function getUbicacion(){
		return $this->ubicacion;
	}

	public function setUbicacion($ubicacion){
		$this->ubicacion = $ubicacion;
	}

	public function getFechaInicioUbicacion(){
		return $this->fechaInicioUbicacion;
	}

	public function setFechaInicioUbicacion($fechaInicioUbicacion){
		$this->fechaInicioUbicacion = $fechaInicioUbicacion;
	}

	public function getFechaFinUbicacion(){
		return $this->fechaFinUbicacion;
	}

	public function setFechaFinUbicacion($fechaFinUbicacion){
		$this->fechaFinUbicacion = $fechaFinUbicacion;
	}

	public function getComentarioUbicacion(){
		return $this->comentarioUbicacion;
	}

	public function setComentarioUbicacion($comentarioUbicacion){
		$this->comentarioUbicacion = $comentarioUbicacion;
	}

	public function getComentarioDeRegistro(){
		return $this->comentarioDeRegistro;
	}

	public function setComentarioDeRegistro($comentarioDeRegistro){
		$this->comentarioDeRegistro = $comentarioDeRegistro;
	}

	public function getNumeroDeEjemplares(){
		return $this->numeroDeEjemplares;
	}

	public function setNumeroDeEjemplares($numeroDeEjemplares){
		$this->numeroDeEjemplares = $numeroDeEjemplares;
	}

	public function getFormaDeIngreso(){
		return $this->formaDeIngreso;
	}

	public function setFormaDeIngreso($formaDeIngreso){
		$this->formaDeIngreso = $formaDeIngreso;
	}

	public function getFechaDeIngreso(){
		return $this->fechaDeIngreso;
	}

	public function setFechaDeIngreso($fechaDeIngreso){
		$this->fechaDeIngreso = $fechaDeIngreso;
	}

	public function getFuenteDeIngreso(){
		return $this->fuenteDeIngreso;
	}

	public function setFuenteDeIngreso($fuenteDeIngreso){
		$this->fuenteDeIngreso = $fuenteDeIngreso;
	}

	public function getEstadoDeConservacion(){
		return $this->estadoDeConservacion;
	}

	public function setEstadoDeConservacion($estadoDeConservacion){
		$this->estadoDeConservacion = $estadoDeConservacion;
	}

	public function getLugarDeEjecucion(){
		return $this->lugarDeEjecucion;
	}

	public function setLugarDeEjecucion($lugarDeEjecucion){
		$this->lugarDeEjecucion = $lugarDeEjecucion;
	}

	public function getLugarDeProcedencia(){
		return $this->lugarDeProcedencia;
	}

	public function setLugarDeProcedencia($lugarDeProcedencia){
		$this->lugarDeProcedencia = $lugarDeProcedencia;
	}

	public function getNumTiraje(){
		return $this->numTiraje;
	}

	public function setNumTiraje($numTiraje){
		$this->numTiraje = $numTiraje;
	}

	public function getOtrosNumerosDeIdentificacion(){
		return $this->otrosNumerosDeIdentificacion;
	}

	public function setOtrosNumerosDeIdentificacion($otrosNumerosDeIdentificacion){
		$this->otrosNumerosDeIdentificacion = $otrosNumerosDeIdentificacion;
	}

	public function getValoracionEconomica(){
		return $this->valoracionEconomica;
	}

	public function setValoracionEconomica($valoracionEconomica){
		$this->valoracionEconomica = $valoracionEconomica;
	}

	public function getBibliografia(){
		return $this->bibliografia;
	}

	public function setBibliografia($bibliografia){
		$this->bibliografia = $bibliografia;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getHistoriaDelObjeto(){
		return $this->historiaDelObjeto;
	}

	public function setHistoriaDelObjeto($historiaDelObjeto){
		$this->historiaDelObjeto = $historiaDelObjeto;
	}

	public function getIdExposicion(){
		return $this->idExposicion;
	}

	public function setIdExposicion($idExposicion){
		$this->idExposicion = $idExposicion;
	}

	public function getIdUbicacion(){
		return $this->idUbicacion;
	}

	public function setIdUbicacion($idUbicacion){
		$this->idUbicacion = $idUbicacion;
	}

	public function mostrarObras(){
		//Obtenemos todos los datos de obras y la descripción de la ubicación mediante la unión de la tabla de obras y ubicaciones.
        $sql ="SELECT * FROM obras o INNER JOIN obras_ubicaciones ou ON ou.fk_obra = o.numero_registro
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
			LEFT JOIN restauraciones r ON r.fk_obra = o.numero_registro 
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
	
	public function crearObra($array) { 
		if (isset($array['id_ubicacion'])) {
			$sql2 = "INSERT INTO obras_ubicaciones VALUES ('{$array['numero_registro']}', {$array['id_ubicacion']}, '{$array['fecha_inicio_ubicacion']}', '{$array['fecha_fin_ubicacion']}')";
		}
		if (isset($array['id_exposicion'])) {
			$sql3 = "INSERT INTO obras_exposiciones VALUES ('{$array['numero_registro']}', {$array['id_exposicion']})";
		}

		//Campos que llegan por POST pero que no son de la tabla de obras
		$camposQuitarArray = ['id_ubicacion', 'fecha_inicio_ubicacion', 'fecha_fin_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion'];

		foreach ($camposQuitarArray as $indice => $campo) {
			unset($array[$campo]); //Eliminamos las claves del $_POST que esten dentro del array anterior
		}

		if (isset($array['fotografia'])) {
			$orden = ['numero_registro', 'nombre_objeto', 'fotografia', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		else {
			$orden = ['numero_registro', 'nombre_objeto', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		//Como por defecto se desordenan, los ordenamos en el orden que estan en la base de datos.
		$camposOrdenados = array_replace(array_flip($orden), $array);

		foreach ($camposOrdenados as $indice => $campo) {
			if (!empty($campo)) {
				if (!is_numeric($campo)) {
					$camposOrdenados[$indice] = "'$campo'";
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

		return $exitoso;
	}		

	public function editarObra($array, $numeroRegistro) {
		$camposQuitarArray = ['id_ubicacion', 'fecha_inicio_ubicacion', 'fecha_fin_ubicacion', 'id_exposicion', 'fecha_inicio_exposicion', 'fecha_fin_exposicion', 'baja', 'causa_baja', 'fecha_baja', 'persona_autorizada', 'id_restauracion', 'fecha_inicio_restauracion', 'fecha_fin_restauracion', 'x', 'y'];

		foreach ($camposQuitarArray as $indice => $campo) {
			unset($array[$campo]); //Eliminamos las claves del $_POST que esten dentro del array anterior
		}

		if (isset($array['fotografia'])) {
			$orden = ['numero_registro', 'nombre_objeto', 'fotografia', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		else {
			$orden = ['numero_registro', 'nombre_objeto', 'titulo', 'autor', 'datacion', 'anyo_inicial', 'anyo_final', 'descripcion_obra', 'fecha_registro', 'material', 'tecnica', 'clasificacion_generica', 'coleccion_procedencia', 'maxima_altura_cm', 'maxima_anchura_cm', 'maxima_profundidad_cm', 'nombre_museo', 'estado_conservacion', 'lugar_ejecucion', 'lugar_procedencia', 'numero_tiraje', 'otros_numeros_identificacion', 'numero_ejemplares', 'forma_ingreso', 'fecha_ingreso', 'fuente_ingreso', 'valoracion_economica', 'historia_objeto', 'bibliografia'];
		}
		$camposOrdenados = array_replace(array_flip($orden), $array);
		
		foreach ($camposOrdenados as $indice => $campo) {
			if ($campo != "") {
				if (!is_numeric($campo)) {
					$camposOrdenados[$indice] = "$indice = '$campo'"; //Indice guarda el nombre del campo y campo el valor
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
		
		return $exitoso;
	}

	public function subirFotografiaServidor($nombreCampo, $idFotografia) {
		$directorio = "images/obras/";
		$path = pathinfo($_FILES[$nombreCampo]['name']); //Obtenemos el path de la foto subida
        $extension = $path['extension'];

		$nombreFichero = $idFotografia . "." . $extension;
		move_uploaded_file($_FILES[$nombreCampo]['tmp_name'], $directorio . $nombreFichero); //Movemos el fichero de la carpeta temporal a la carpeta destino

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
			unlink($resultado['fotografia']);
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