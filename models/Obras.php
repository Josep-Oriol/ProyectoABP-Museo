<?php
require_once("database.php");
class Obras extends Database{
    private $nombre_obra;
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
    private $ubicacion;
    private $fecha_inicio_ubicacion;
    private $fecha_fin_ubicacion;
    private $comentario_ubicacion;
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
    private $id_ubicacion;

	//Getters y Setters
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
	public function getUbicacion(){
		return $this->ubicacion;
	}
	public function setUbicacion($ubicacion){
		$this->ubicacion = $ubicacion;
	}
	public function getFecha_inicio_ubicacion(){
		return $this->fecha_inicio_ubicacion;
	}
	public function setFecha_inicio_ubicacion($fecha_inicio_ubicacion){
		$this->fecha_inicio_ubicacion = $fecha_inicio_ubicacion;
	}
	public function getFecha_fin_ubicacion(){
		return $this->fecha_fin_ubicacion;
	}
	public function setFecha_fin_ubicacion($fecha_fin_ubicacion){
		$this->fecha_fin_ubicacion = $fecha_fin_ubicacion;
	}
	public function getComentario_ubicacion(){
		return $this->comentario_ubicacion;
	}
	public function setComentario_ubicacion($comentario_ubicacion){
		$this->comentario_ubicacion = $comentario_ubicacion;
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
	public function setNumero_tiraje($num_tiraje){
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
	public function getId_ubicacion(){
		return $this->id_ubicacion;
	}
	public function setId_ubicacion($id_ubicacion){
		$this->id_ubicacion = $id_ubicacion;
	}
    
    public function mostrarObras(){
        $sql ="SELECT * FROM obras";
        $db = $this->conectar();
        $rows = $db->query($sql);

        return $rows;
        
    }
}

?>