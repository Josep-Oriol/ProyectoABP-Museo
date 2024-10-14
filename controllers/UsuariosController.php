<?php

class UsuariosController{
    
    private $modeloUsuario;

    public function mostrarFicha(){
        require_once "views/general/fichaUsuario.php";
    }
    
    public function mostrarUsuarios(){
        require_once "models/Usuarios.php";
        $modeloUsuario = new Usuarios();

        $usuarios = $modeloUsuario->mostrarUsuarios();

        require_once "views/general/header.php";
        require_once "views/general/gestionUsuarios.php";
        require_once "views/general/footer.html";
    }

    public function validarUser() {
        require_once "models/Usuarios.php";
        $this->modeloUsuario = new Usuarios();
        
        if(isset($_POST['username'])){
            
            $user = $_POST['username'];
            $password = $_POST['password'];
            $verificacion = $this->modeloUsuario->verificarLogin($user, $password);
          
            if($verificacion){
 
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
    

    

    
}

?>