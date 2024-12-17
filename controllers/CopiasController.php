<?php

class CopiasController{
    function mostrarCopias(){
        require_once 'models/Copias.php';
        $modelo = new Copias();
        $copias = $modelo -> obtenerCopias();

        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once "views/general/copias/tablaCopias.php";
        require_once "views/general/components/footer.html";
    }

    function crear(){
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        require_once 'models/Copias.php';
        $modelo = new Copias();
        $id = $_SESSION['ID_usuario'];
        $date = date('Y-m-d_H-i-s');

        if ($_POST) {
            $exitoso = $modelo->crearCopia($_POST, $id, $date);
            if ($exitoso) {
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Copias&action=mostrarCopias'/>";
            }
        }
        else {
            require_once "views/general/copias/fichaCrearCopia.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function mostrarCopia() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        if ($_GET['id']) {
            require_once "models/Copias.php";
            $modelocopia = new Copias();
            $id = $_GET['id'];
            $copia = $modelocopia->mostrarCopia($id);

            require_once "views/general/copias/fichaCopia.php";
        }
        require_once "views/general/components/footer.html";
    }

    public function editar() {
        require_once "views/general/components/header.php";
        require_once "views/general/components/navegacion.php";
        if ($_GET['id']) {
            $id = $_GET['id'];
            require_once "models/Copias.php";
            $modelocopias = new Copias();
            if ($_POST) {
                print_r($_POST);
                $exitoso = $modelocopias->editarCopia($_POST, $id);
                if ($exitoso) {
                    echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Copias&action=mostrarCopias'/>";
                }
            }
            else {
                $copia = $modelocopias->mostrarCopia($id);
                require_once "views/general/copias/fichaEditarCopia.php";
            }
        }
        
        require_once "views/general/components/footer.html";
    }

    public function eliminar(){
        require_once "models/Copias.php";
        $modelocopias = new Copias();
        $id = $_GET['id'];
        $ruta = $modelocopias->rutaBackup($id);
        $modelocopias->eliminarCopia($id, $ruta['ruta']);
        echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Copias&action=mostrarCopias'/>";
    }

    public function descargar(){
        require_once "models/Copias.php";
        $modelocopias = new Copias();
        $id = $_GET['id'];
        $ruta = $modelocopias->rutaBackup($id);
        $ruta = $ruta['ruta'];

        if (file_exists($ruta)) {
            // Limpiar el buffer de salida si ya se ha enviado algo
            if (ob_get_level()) {
                ob_end_clean();
            }
    
            // Configurar las cabeceras para la descarga
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($ruta) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta));
    
            // Leer el archivo y enviarlo al cliente
            readfile($ruta);
    
            // Detener la ejecución para evitar que se envíe HTML adicional
            exit;
        } else {
            // Manejar el caso en que el archivo no exista
            echo "El archivo no existe.";
            exit;
        }
    }
    

    public function importarCopia(){
        require_once "models/Copias.php";
        $modelocopias = new Copias();
        $ruta = $_FILES["fichero_sql"]["tmp_name"];
        $consulta = file_get_contents($ruta);
        $modelocopias->consultaImportar($consulta);
        
    }
}