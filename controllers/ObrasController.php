<?php 

class ObrasController{

    public function mostrarObras() {
        require_once "models/Obras.php";
        $modelobras = new Obras();
        $obras = $modelobras->mostrarObras();
        require_once "views/general/components/header.php";
        require_once "views/general/obras/gestionObras.php";
        require_once "views/general/components/footer.html";
    }

    public function mostrarFicha() {
        require_once "views/general/components/header.php";
        if ($_GET['id']) {
            require_once "models/Obras.php";
            $modelobras = new Obras();
            $id = $_GET['id'];
            $obra = $modelobras->mostrarObra($id);

            require_once "views/general/obras/fichaObra.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function crear() {
        require_once "views/general/components/header.php";
        if ($_POST) {
            require_once "models/Obras.php";
            $modelobras = new Obras();
            $modelobras->crearObra($_POST['num_registre'], $_POST['nom_objecte'], $_FILES['fotografia']['name'], $_POST['nom_obra'], $_POST['autor'], $_POST['datacio'], $_POST['any_inicial'], $_POST['any_final'], $_POST['data_registre'], $_POST['material'], $_POST['tecnica'], $_POST['classificacio'], $_POST['coleccio'], $_POST['mides_alcada'], $_POST['mides_amplada'], $_POST['mides_profunditat'], $_POST['nom_museu'], $_POST['ubicacio'], $_POST['exposicio'], $_POST['estat_conservacio'], $_POST['descripcio'], $_POST['historia_objecte'], $_POST['lloc_execucio'], $_POST['lloc_procedencia'], $_POST['num_tiratge'], $_POST['altres_numeros_id'], $_POST['nombre_exemplars'], $_POST['forma_ingres'], $_POST['data_ingres'], $_POST['font_ingres'], $_POST['valoracio_economica'], $_POST['bibliografia']); 
        }
        else {
            require_once "views/general/obras/fichaCrearObra.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function editar() {
        require_once "views/general/components/header.php";
        if ($_GET['id']) {
            require_once "models/Obras.php";
            $id = $_GET['id'];
            $modelobras = new Obras();
            if ($_POST) {
                $modelobras->editarObra($_POST['num_registre'], $_POST['nom_objecte'], $_FILES['fotografia']['name'], $_POST['nom_obra'], $_POST['autor'], $_POST['datacio'], $_POST['any_inicial'], $_POST['any_final'], $_POST['data_registre'], $_POST['material'], $_POST['tecnica'], $_POST['classificacio'], $_POST['coleccio'], $_POST['mides_alçada'], $_POST['mides_amplada'], $_POST['mides_profunditat'], $_POST['nom_museu'], $_POST['ubicacio'], $_POST['exposicio'], $_POST['estat_conservacio'], $_POST['descripcio'], $_POST['historia_objecte'], $_POST['lloc_execucio'], $_POST['lloc_procedencia'], $_POST['num_tiratge'], $_POST['altres_numeros_id'], $_POST['nombre_exemplars'], $_POST['forma_ingres'], $_POST['data_ingres'], $_POST['font_ingres'], $_POST['valoracio_economica'], $_POST['bibliografia']);
            }
            else {
                $obra = $modelobras->mostrarObra($id);
                print_r($obra);
                require_once "views/general/obras/fichaEditarObra.php";
            }           
            
        }
        
        require_once "views/general/components/footer.html";
    }

    /*$camposAutores = $modelobras->obtenerCampoLista("Autories");
                $camposMaterial = $modelobras->obtenerCampoLista("Material");
                $camposTecnica = $modelobras->obtenerCampoLista("Tècnica");
                $camposClasificacionGenerica = $modelobras->obtenerCampoLista("Classificació genèrica");
                $camposColeccionProcedencia = $modelobras->obtenerCampoLista("Colecció de procedència");
                $camposEstadoConservacion = $modelobras->obtenerCampoLista("Estat de conservació");*/

    public function eliminar() {
        require_once "views/general/components/header.php";
        //si hay una id pasada por la URL procedemos a eliminar la obra, si no, mostramos un mensaje.
        if ($_GET['id']) {
            require_once "models/Obras.php";
            $modelobras = new Obras();
            $modelobras->eliminarObra($_GET['id']);
        }
        else {
            echo "<h3>Ninguna obra seleccionada.</h3>";
        }
        require_once "views/general/components/footer.html";
    }
}

?>