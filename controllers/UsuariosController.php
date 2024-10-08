<?php

class UsuariosController{
    
    private $modeloUsuario;

  /*  public function loginForm() {
        require_once "models/Usuarios.php";
        $this->modeloUsuario = new Usuarios();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = $_POST['username'];
            $password = $_POST['password'];

            $verificacion = $this->modeloUsuario->verificarLogin($user, $password);
          

            if($verificacion){
                //require_once "views/general/general.php";
                echo "cccccc";
                echo "<meta http-equiv='refresh' content=0; URL=index.php?controller=Obras&action=mostrarObras'/>";
                
            }
            else{
                //require_once "views/general/login.php";
            }
    
        }
        else{
            require_once "views/general/login.php";
        }

    }*/
    

    public function validarUser() {
        require_once "models/Usuarios.php";
        $this->modeloUsuario = new Usuarios();
        
        if(isset($_POST['username'])){
            
            $user = $_POST['username'];
            $password = $_POST['password'];
            $verificacion = $this->modeloUsuario->verificarLogin($user, $password);
          
            if($verificacion){
                //require_once "views/general/general.php";
                
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
    

    

    
}

?>