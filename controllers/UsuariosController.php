<?php

class UsuariosController{

    public function validarUser() {
        require_once "models/Usuarios.php";
        $modeloUsuario = new Usuarios();
        
        if(isset($_POST['username'])){
            
            $user = $_POST['username'];
            $password = $_POST['password'];
            $verificacion = $modeloUsuario->verificarLogin($user, $password);
          
            if($verificacion and $verificacion['Estado'] == "Actiu"){

                $_SESSION['Rol'] = $verificacion['Rol'];
                
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Obras&action=mostrarObras'/>";
                
            }
            else{
                require_once "views/general/login.php";
            }
        }
        else{
            require_once "views/general/login.php";
        }
    
    }

    public function cerrarSesion() {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }

    public function mostrarUsuarios(){
        require_once "models/Usuarios.php";
        $modeloUsuario = new Usuarios();

        $usuarios = $modeloUsuario->mostrarUsuarios();

        require_once "views/general/header.php";
        require_once "views/general/gestionUsuarios.php";
        require_once "views/general/footer.html";
    }

    public function crear() {
        require_once "views/general/header.php";
        require_once "views/general/fichaCrearUsuario.php";
        require_once "views/general/footer.html";
        if ($_POST) {
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            if ($_FILES['foto']['size']!=0) {
                $directorioFoto = $modeloUsuario->subirFotoServidor('foto');
            }
            else{
                $directorioFoto = "images/IconDefaultUser.png";
            }
            $modeloUsuario->crearUsuario($directorioFoto, $_POST['usuario'], $_POST['nombre'],$_POST['apellidos'],$_POST['contrasenya'],$_POST['correo_electronico'],$_POST['telefono'],$_POST['rol'],$_POST['estado']);
        }
    }

    public function mostrarFicha(){
        require_once "views/general/header.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            $datos = $modeloUsuario->mostrarUsuario($id);
            require_once "views/general/fichaVerUsuario.php";
        }
        else {
            echo "<h3>Ningún usuario seleccionado.</h3>";
        }
        require_once "views/general/footer.html";
    }

    public function editar() {
        require_once "views/general/header.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            $datos = $modeloUsuario->mostrarUsuario($id);
            require_once "views/general/fichaEditarUsuario.php";
            if ($_POST) {
                if ($_FILES['foto']['size']!=0) {
                    $fotoExist = true;
                    $directorioFoto = $modeloUsuario->subirFotoServidor('foto');                  
                }
                else {
                    $fotoExist = false;
                    $directorioFoto = "";
                }
                $modeloUsuario->editarUsuario($fotoExist, $id, $directorioFoto, $_POST['usuario'], $_POST['nombre'],$_POST['apellidos'],$_POST['correo_electronico'],$_POST['telefono'],$_POST['rol'],$_POST['estado']);
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Usuarios&action=mostrarUsuarios'/>";
            }
        }
        else {
            echo "<h3>Ningún usuario seleccionado.</h3>";
        }
        require_once "views/general/footer.html";
    }

    public function eliminar() {
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            $modeloUsuario->eliminarUsuario($id);
        }
        else {
            echo "<h3>Ningún usuario seleccionado.</h3>";
        }
        echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Usuarios&action=mostrarUsuarios'/>";
        
        
    }
    
}

?>