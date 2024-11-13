<?php

class UsuariosController{

    // VERSION PRINCIPAL

    /*public function validarUser() {
        require_once "models/Usuarios.php";
        $modeloUsuario = new Usuarios();
        
        if(isset($_POST['username'])){
            
            $user = $_POST['username'];
            $password = $_POST['password'];
            $verificacion = $modeloUsuario->verificarLogin($user, $password);
          
            if($verificacion and $verificacion['estado'] == "Actiu"){

                $_SESSION['Rol'] = $verificacion['rol'];
                $_SESSION['ID_usuario'] = $verificacion['id_usuario'];
                $_SESSION['Usuario'] = $verificacion['usuario'];
                
                echo "<meta http-equiv='refresh' content='0; URL=index.php?controller=Obras&action=mostrarObras'/>";
                
            }
            else{
                require_once "views/general/login.php";
            }
        }
        else{
            require_once "views/general/login.php";
        }
    
    }*/

    //VERSION QUE FUNCIONA Y VERIFICA QUE EL USUARIO Y LA CONTRASEÑA SEAN CORRECTOS

    public function validarUser() {
    
        // Obtén los datos JSON de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Verifica si los datos se recibieron correctamente
        if (is_null($data)) {
            require_once "views/general/login.php";
            exit;
        }else {
            $username = $data['username'];
            $password = $data['password'];
        
            // Cargar el modelo de Usuario
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
        
            // Verificar las credenciales de usuario
            $verificacion = $modeloUsuario->verificarLogin($username, $password);
        
            // Si la verificación es exitosa y el estado es "Actiu"
            if ($verificacion && $verificacion['estado'] == "Actiu") {
                // Establecer las variables de sesión
                $_SESSION['Rol'] = $verificacion['rol'];
                $_SESSION['ID_usuario'] = $verificacion['id_usuario'];
                $_SESSION['Usuario'] = $verificacion['usuario'];
        
                // Responder con éxito
                $response = ['status' => 'success'];
            } else {
                // Si las credenciales son incorrectas o el estado no es "Actiu"
                $response = ['status' => 'error'];
            }
            
            // Establece el encabezado JSON para que el navegador sepa que la respuesta es JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
    

    // VERSION QUE QUE FUNCIONA PERO NO SIRVE PARA NADA

    /*public function validarUser() {
        // Obtén los datos JSON de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (is_null($data)) {
            require_once "views/general/login.php";
            return;
        }
    
        if (!isset($data['username']) || !isset($data['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros: username o password']);
            return;
        }
    
        // Lógica de validación
        $username = $data['username'];
        $password = $data['password'];
    
        if ($username === 'd') {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error'];
        }
    
        // Devuelve la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }*/




    public function cerrarSesion() {
        session_destroy();
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }

    public function mostrarUsuarios(){
        require_once "models/Usuarios.php";
        $modeloUsuario = new Usuarios();

        $usuarios = $modeloUsuario->mostrarUsuarios();

        require_once "views/general/components/header.php";
        require_once "views/general/usuarios/gestionUsuarios.php";
        require_once "views/general/components/footer.html";
    }

    public function crear() {
        require_once "views/general/components/header.php";
        require_once "views/general/usuarios/fichaCrearUsuario.php";
        require_once "views/general/components/footer.html";
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
        require_once "views/general/components/header.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            $datos = $modeloUsuario->mostrarUsuario($id);
            require_once "views/general/usuarios/fichaVerUsuario.php";
        }
        else {
            echo "<h3>Ningún usuario seleccionado.</h3>";
        }
        require_once "views/general/components/footer.html";
    }

    public function editar() {
        require_once "views/general/components/header.php";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "models/Usuarios.php";
            $modeloUsuario = new Usuarios();
            $datos = $modeloUsuario->mostrarUsuario($id);
            require_once "views/general/usuarios/fichaEditarUsuario.php";
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
        require_once "views/general/components/footer.html";
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