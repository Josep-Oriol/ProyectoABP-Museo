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
        $sql ="SELECT * FROM obras o INNER JOIN ubicaciones u ON u.id_ubicacion = o.fk_ubicacion";
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
		//Obtenemos todos los datos de obras, ubicaciones, bajas, exposiciones y restauraciones mediante la unión de todas las tablas mediante la clave primaria de la obra
        $sql ="SELECT * FROM obras o INNER JOIN ubicaciones u ON u.id_ubicacion = o.fk_ubicacion 
				INNER JOIN obras_exposiciones oe ON oe.fk_obra = o.Numero_registro
				INNER JOIN exposiciones e ON e.id_exposicion = oe.fk_exposicion
				INNER JOIN logs_obras l ON o.numero_registro = l.fk_obra 
				INNER JOIN usuarios us ON us.id_usuario = l.persona_autorizada
				INNER JOIN restauraciones r ON r.fk_obra = o.numero_registro 
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

	public function obtenerCamposLista($vocabulario) {
		$sql ="SELECT c.nombre_campo FROM campos c INNER JOIN vocabularios v ON c.fk_vocabulario = v.id_vocabulario WHERE v.nombre_vocabulario = '$vocabulario'";
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
	
	public function crearObra(
		$numeroRegistro, $nombreDelObjeto, $fotografia, $titulo, $autor, $datacion,
		$anyoInicial, $anyoFinal, $descripcion, $fechaDeRegistro, $material, $tecnica, $clasificacionGenerica,
		$coleccionDeProcedencia, $medidasMaximaAlturaCm, $medidasMaximaAnchuraCm, $medidasMaximaProfundidadCm, 
		$nombreMuseo, $idUbicacion, $estadoDeConservacion, $lugarDeEjecucion, $lugarDeProcedencia, 
		$numTiraje, $otrosNumerosDeIdentificacion, $numeroDeEjemplares, $formaDeIngreso, 
		$fechaDeIngreso, $fuenteDeIngreso, $valoracionEconomica, $historiaDelObjeto, $bibliografia) {
	
		$sql = "INSERT INTO obras (
			numero_registro, nombre_objeto, fotografia, titulo, autor, datacion, anyo_inicial, anyo_final,
			descripcion_obra, fecha_registro, material, tecnica, clasificacion_generica, coleccion_procedencia, 
			maxima_altura_cm, maxima_anchura_cm, maxima_profundidad_cm, nombre_museo, fk_ubicacion, 
			estado_conservacion, lugar_ejecucion, lugar_procedencia, numero_tiraje, otros_numeros_identificacion, 
			numero_ejemplares, forma_ingreso, fecha_ingreso, fuente_ingreso, valoracion_economica, historia_objeto, 
			bibliografia
		) VALUES (
			'$numeroRegistro', '$nombreDelObjeto', '$fotografia', '$titulo', '$autor', '$datacion', 
			$anyoInicial, $anyoFinal, '$descripcion', '$fechaDeRegistro', '$material', '$tecnica', 
			'$clasificacionGenerica', '$coleccionDeProcedencia', $medidasMaximaAlturaCm, $medidasMaximaAnchuraCm, 
			$medidasMaximaProfundidadCm, '$nombreMuseo', $idUbicacion, '$estadoDeConservacion', '$lugarDeEjecucion', 
			'$lugarDeProcedencia', '$numTiraje', '$otrosNumerosDeIdentificacion', $numeroDeEjemplares, 
			'$formaDeIngreso', '$fechaDeIngreso', '$fuenteDeIngreso', $valoracionEconomica, '$historiaDelObjeto', 
			'$bibliografia')";
		
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}
	}		

	public function editarObra(
		$numeroRegistro, $nombreDelObjeto, $fotografia, $titulo, $autor, $datacion,
		$anyoInicial, $anyoFinal, $descripcion, $fechaDeRegistro, $material, $tecnica, $clasificacionGenerica,
		$coleccionDeProcedencia, $medidasMaximaAlturaCm, $medidasMaximaAnchuraCm, $medidasMaximaProfundidadCm, 
		$nombreMuseo, $idUbicacion, $estadoDeConservacion, $lugarDeEjecucion, $lugarDeProcedencia, 
		$numTiraje, $otrosNumerosDeIdentificacion, $numeroDeEjemplares, $formaDeIngreso, 
		$fechaDeIngreso, $fuenteDeIngreso, $valoracionEconomica, $historiaDelObjeto, $bibliografia) {
	
		$sql = "UPDATE obras SET
			nombre_objeto = '$nombreDelObjeto', fotografia = '$fotografia', titulo = '$titulo', 
			autor = '$autor', datacion = '$datacion', anyo_inicial = $anyoInicial, anyo_final = $anyoFinal, 
			descripcion_obra = '$descripcion', fecha_registro = '$fechaDeRegistro', material = '$material', 
			tecnica = '$tecnica', clasificacion_generica = '$clasificacionGenerica', 
			coleccion_procedencia = '$coleccionDeProcedencia', maxima_altura_cm = $medidasMaximaAlturaCm, 
			maxima_anchura_cm = $medidasMaximaAnchuraCm, maxima_profundidad_cm = $medidasMaximaProfundidadCm, 
			nombre_museo = '$nombreMuseo', fk_ubicacion = $idUbicacion, estado_conservacion = '$estadoDeConservacion', 
			lugar_ejecucion = '$lugarDeEjecucion', lugar_procedencia = '$lugarDeProcedencia', 
			numero_tiraje = '$numTiraje', otros_numeros_identificacion = '$otrosNumerosDeIdentificacion', 
			numero_ejemplares = $numeroDeEjemplares, forma_ingreso = '$formaDeIngreso', fecha_ingreso = '$fechaDeIngreso', 
			fuente_ingreso = '$fuenteDeIngreso', valoracion_economica = $valoracionEconomica, 
			historia_objeto = '$historiaDelObjeto', bibliografia = '$bibliografia'
		WHERE numero_registro = '$numeroRegistro'";
	
		$db = $this->conectar();
		try {
			$query = $db->prepare($sql);
			$query->execute();
		} catch (PDOException $error) {
			echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
		}
	}	

	public function eliminarObra($id) {
		$sql = "DELETE FROM obras WHERE numero_registro = '$id'";
		$db = $this->conectar();
		try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
	}
    
}

?>