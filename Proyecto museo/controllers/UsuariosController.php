<?php

class UsuariosController{
    
    private $modeloUsuario;

    public function loginForm() {
        require_once "models/Usuarios.php";
        $this->modeloUsuario = new Usuarios();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = $_POST['username'];
            $password = $_POST['password'];

            $verificacion = $this->modeloUsuario->verificarLogin($user, $password);

            if($verificacion){
                require_once "views/general/general.php";
            }
            else{
                require_once "views/general/login.php";
            }
    
        }
        else{
            require_once "views/general/login.php";
        }

    }
    



    
}

?>