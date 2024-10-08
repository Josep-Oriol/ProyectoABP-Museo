<?php

class Obras extends Database{
    private $numero_registro;
    private $nombre_museo;
    private $fotografia;
    private $clasificacion_generica;
    private $nombre_del_objeto;
    private $coleccion_de_procedencia;
    private $medidas_maxima_altura_cm;
    private $medidas_anchura_altura_cm;
    private $medidas_profundidad_altura_cm;
    private $material;
    private $tecnica;
    private $autor;
    private $titulo;
    private $anyo_inicial;
    private $anyo_final;
    private $datacion;
    private $id_ubicacion;
    private $comentario_de_registro;
    private $numero_de_ejemplares;
    private $forma_de_ingreso;
    private $fecha_de_ingreso;
    private $fuente_de_ingreso;
    private $estado_de_conservacion;
    private $lugar_de_ejecucion;
    private $lugar_de_procedencia;
    private $num_tiraje;
    private $otros_numeros_de_identificacion;
    private $valoracion_economica;
    private $bibliografia;
    private $descripcion;
    private $historia_del_objeto;
    private $id_exposicion;

	public function __construct() {
		$this->conectar();
	}

	//Getters y setters

	public function getNumero_registro(){
		return $this->numero_registro;
	}

	public function setNumero_registro($numero_registro){
		$this->numero_registro = $numero_registro;
	}

	public function getNombre_museo(){
		return $this->nombre_museo;
	}

	public function setNombre_museo($nombre_museo){
		$this->nombre_museo = $nombre_museo;
	}

	public function getFotografia(){
		return $this->fotografia;
	}

	public function setFotografia($fotografia){
		$this->fotografia = $fotografia;
	}

	public function getClasificacion_generica(){
		return $this->clasificacion_generica;
	}

	public function setClasificacion_generica($clasificacion_generica){
		$this->clasificacion_generica = $clasificacion_generica;
	}

	public function getNombre_del_objeto(){
		return $this->nombre_del_objeto;
	}

	public function setNombre_del_objeto($nombre_del_objeto){
		$this->nombre_del_objeto = $nombre_del_objeto;
	}

	public function getColeccion_de_procedencia(){
		return $this->coleccion_de_procedencia;
	}

	public function setColeccion_de_procedencia($coleccion_de_procedencia){
		$this->coleccion_de_procedencia = $coleccion_de_procedencia;
	}

	public function getMedidas_maxima_altura_cm(){
		return $this->medidas_maxima_altura_cm;
	}

	public function setMedidas_maxima_altura_cm($medidas_maxima_altura_cm){
		$this->medidas_maxima_altura_cm = $medidas_maxima_altura_cm;
	}

	public function getMedidas_anchura_altura_cm(){
		return $this->medidas_anchura_altura_cm;
	}

	public function setMedidas_anchura_altura_cm($medidas_anchura_altura_cm){
		$this->medidas_anchura_altura_cm = $medidas_anchura_altura_cm;
	}

	public function getMedidas_profundidad_altura_cm(){
		return $this->medidas_profundidad_altura_cm;
	}

	public function setMedidas_profundidad_altura_cm($medidas_profundidad_altura_cm){
		$this->medidas_profundidad_altura_cm = $medidas_profundidad_altura_cm;
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

	public function getAnyo_inicial(){
		return $this->anyo_inicial;
	}

	public function setAnyo_inicial($anyo_inicial){
		$this->anyo_inicial = $anyo_inicial;
	}

	public function getAnyo_final(){
		return $this->anyo_final;
	}

	public function setAnyo_final($anyo_final){
		$this->anyo_final = $anyo_final;
	}

	public function getDatacion(){
		return $this->datacion;
	}

	public function setDatacion($datacion){
		$this->datacion = $datacion;
	}

	public function getId_ubicacion(){
		return $this->id_ubicacion;
	}

	public function setId_ubicacion($id_ubicacion){
		$this->id_ubicacion = $id_ubicacion;
	}

	public function getComentario_de_registro(){
		return $this->comentario_de_registro;
	}

	public function setComentario_de_registro($comentario_de_registro){
		$this->comentario_de_registro = $comentario_de_registro;
	}

	public function getNumero_de_ejemplares(){
		return $this->numero_de_ejemplares;
	}

	public function setNumero_de_ejemplares($numero_de_ejemplares){
		$this->numero_de_ejemplares = $numero_de_ejemplares;
	}

	public function getForma_de_ingreso(){
		return $this->forma_de_ingreso;
	}

	public function setForma_de_ingreso($forma_de_ingreso){
		$this->forma_de_ingreso = $forma_de_ingreso;
	}

	public function getFecha_de_ingreso(){
		return $this->fecha_de_ingreso;
	}

	public function setFecha_de_ingreso($fecha_de_ingreso){
		$this->fecha_de_ingreso = $fecha_de_ingreso;
	}

	public function getFuente_de_ingreso(){
		return $this->fuente_de_ingreso;
	}

	public function setFuente_de_ingreso($fuente_de_ingreso){
		$this->fuente_de_ingreso = $fuente_de_ingreso;
	}

	public function getEstado_de_conservacion(){
		return $this->estado_de_conservacion;
	}

	public function setEstado_de_conservacion($estado_de_conservacion){
		$this->estado_de_conservacion = $estado_de_conservacion;
	}

	public function getLugar_de_ejecucion(){
		return $this->lugar_de_ejecucion;
	}

	public function setLugar_de_ejecucion($lugar_de_ejecucion){
		$this->lugar_de_ejecucion = $lugar_de_ejecucion;
	}

	public function getLugar_de_procedencia(){
		return $this->lugar_de_procedencia;
	}

	public function setLugar_de_procedencia($lugar_de_procedencia){
		$this->lugar_de_procedencia = $lugar_de_procedencia;
	}

	public function getNum_tiraje(){
		return $this->num_tiraje;
	}

	public function setNum_tiraje($num_tiraje){
		$this->num_tiraje = $num_tiraje;
	}

	public function getOtros_numeros_de_identificacion(){
		return $this->otros_numeros_de_identificacion;
	}

	public function setOtros_numeros_de_identificacion($otros_numeros_de_identificacion){
		$this->otros_numeros_de_identificacion = $otros_numeros_de_identificacion;
	}

	public function getValoracion_economica(){
		return $this->valoracion_economica;
	}

	public function setValoracion_economica($valoracion_economica){
		$this->valoracion_economica = $valoracion_economica;
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

	public function getHistoria_del_objeto(){
		return $this->historia_del_objeto;
	}

	public function setHistoria_del_objeto($historia_del_objeto){
		$this->historia_del_objeto = $historia_del_objeto;
	}

	public function getId_exposicion(){
		return $this->id_exposicion;
	}

	public function setId_exposicion($id_exposicion){
		$this->id_exposicion = $id_exposicion;
	}   
    
    public function mostrarObras(){
        $sql ="SELECT * FROM obras INNER JOIN ";
        $rows = $this->db->query($sql);
        return $rows;
    }

	public function insertarObra(
        $numero_registro, $nombre_museo, $fotografia, $clasificacion_generica,
        $nombre_del_objeto, $coleccion_de_procedencia, $medidas_maxima_altura_cm,
        $medidas_maxima_anchura_cm, $medidas_maxima_profundidad_cm, $material,
        $tecnica, $autor, $titulo, $anyo_inicial, $anyo_final, $datacion,
        $id_ubicacion, $fecha_de_registro, $numero_de_ejemplares, $forma_de_ingreso,
        $fecha_de_ingreso, $fuente_de_ingreso, $estado_de_conservacion,
        $lugar_de_ejecucion, $lugar_de_procedencia, $num_tiraje,
        $otros_numeros_de_identificacion, $valoracion_economica, $bibliografia,
        $descripcion, $historia_del_objeto, $id_exposicion) {
        
		$sql = "INSERT INTO obras (
                    Numero_registro, Nombre_museo, Fotografia, Clasificacion_generica,
                    Nombre_del_objeto, Coleccion_de_procedencia, Medidas_maxima_altura_cm,
                    Medidas_maxima_anchura_cm, Medidas_maxima_profundidad_cm, Material, 
                    Tecnica, Autor, Titulo, Año_inicial, Año_final, Datacion, FK_id_ubicacion, 
                    Fecha_de_registro, Numero_de_ejemplares, Forma_de_ingreso, Fecha_de_ingreso, 
                    Fuente_de_ingreso, Estado_de_conservacion, Lugar_de_ejecucion, 
                    Lugar_de_procedencia, Num_Tiraje, Otros_numeros_de_identificacion, 
                    Valoracion_economica, Bibliografia, Descripcion, Historia_del_objeto, FK_id_exposicion) 
					
					VALUES (
                    '$numero_registro', '$nombre_museo', '$fotografia', '$clasificacion_generica',
                    '$nombre_del_objeto', '$coleccion_de_procedencia', $medidas_maxima_altura_cm,
                    $medidas_maxima_anchura_cm, $medidas_maxima_profundidad_cm, '$material',
                    '$tecnica', '$autor', '$titulo', $anyo_inicial, $anyo_final, '$datacion',
                    $id_ubicacion, '$fecha_de_registro', $numero_de_ejemplares, '$forma_de_ingreso',
                    '$fecha_de_ingreso', '$fuente_de_ingreso', '$estado_de_conservacion', 
                    '$lugar_de_ejecucion', '$lugar_de_procedencia', '$num_tiraje', 
                    '$otros_numeros_de_identificacion', $valoracion_economica, '$bibliografia',
                    '$descripcion', '$historia_del_objeto', $id_exposicion)";
		$this->db->query($sql);
	}

	public function modificarObra(
        $numero_registro, $nombre_museo, $fotografia, $clasificacion_generica,
        $nombre_del_objeto, $coleccion_de_procedencia, $medidas_maxima_altura_cm,
        $medidas_maxima_anchura_cm, $medidas_maxima_profundidad_cm, $material,
        $tecnica, $autor, $titulo, $anyo_inicial, $anyo_final, $datacion,
        $id_ubicacion, $fecha_de_registro, $numero_de_ejemplares, $forma_de_ingreso,
        $fecha_de_ingreso, $fuente_de_ingreso, $estado_de_conservacion,
        $lugar_de_ejecucion, $lugar_de_procedencia, $num_tiraje,
        $otros_numeros_de_identificacion, $valoracion_economica, $bibliografia,
        $descripcion, $historia_del_objeto, $id_exposicion) {
        
		$sql = "UPDATE obras SET
                    Nombre_museo = '$nombre_museo', Fotografia = '$fotografia', 
                    Clasificacion_generica = '$clasificacion_generica', 
                    Nombre_del_objeto = '$nombre_del_objeto', Coleccion_de_procedencia = '$coleccion_de_procedencia',
                    Medidas_maxima_altura_cm = $medidas_maxima_altura_cm, 
                    Medidas_maxima_anchura_cm = $medidas_maxima_anchura_cm, 
                    Medidas_maxima_profundidad_cm = $medidas_maxima_profundidad_cm, 
                    Material = '$material', Tecnica = '$tecnica', Autor = '$autor', 
                    Titulo = '$titulo', Año_inicial = $anyo_inicial, Año_final = $anyo_final, 
                    Datacion = '$datacion', FK_id_ubicacion = $id_ubicacion, 
                    Fecha_de_registro = '$fecha_de_registro', Numero_de_ejemplares = $numero_de_ejemplares, 
                    Forma_de_ingreso = '$forma_de_ingreso', Fecha_de_ingreso = '$fecha_de_ingreso', 
                    Fuente_de_ingreso = '$fuente_de_ingreso', Estado_de_conservacion = '$estado_de_conservacion', 
                    Lugar_de_ejecucion = '$lugar_de_ejecucion', Lugar_de_procedencia = '$lugar_de_procedencia', 
                    Num_Tiraje = '$num_tiraje', Otros_numeros_de_identificacion = '$otros_numeros_de_identificacion',
                    Valoracion_economica = $valoracion_economica, Bibliografia = '$bibliografia', 
                    Descripcion = '$descripcion', Historia_del_objeto = '$historia_del_objeto', 
                    FK_id_exposicion = $id_exposicion
				WHERE Numero_registro = '$numero_registro'";
		$this->db->query($sql);
	}

	public function eliminarObra($primary_key) {
		$sql = "DELETE obras WHERE Numero_registro = '$primary_key'";
		$this->db->query($sql);
	}
}

?>