<?php
require_once("database.php");
class Usuarios extends Database {
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    private $rol;

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function getFecha() {
        return $this->fecha;
    }
    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    
    function verificarLogin($user, $password){

        $sql = "SELECT * FROM usuarios WHERE nombre = '$user' AND contrasenya = '$password'";
        $db = $this->conectar();
        $rows = $db->query($sql);
        
        $resultado = $rows->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }

    
}




?>