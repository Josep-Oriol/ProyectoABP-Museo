<?php
require_once("Database.php");
class Usuarios extends Database {
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    private $rol;

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    
    public function verificarLogin($user, $password){
        $sql = "SELECT * FROM usuarios WHERE Nombre = '$user' AND contrasenya = '$password'";
        $db = $this->conectar();
        $query = $db->prepare($sql);
        $query->execute();
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function mostrarUsuarios(){
        $sql ="SELECT * FROM usuarios";
        $db = $this->conectar();
        $rows = $db->query($sql);
        return $rows;
    }

    public function mostrarUsuario($id) {
        $sql ="SELECT * FROM usuarios WHERE ID_usuario = $id";
        $db = $this->conectar();
        $query = $db->query($sql);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function crearUsuario($nombre, $apellidos, $contrasenya, $correoElectronico ,$telefono, $rol, $estado, $foto) {
        $sql = "INSERT INTO usuarios VALUES ('$foto', '$nombre', '$apellidos', '$contrasenya', '$correoElectronico', '$telefono', '$rol', '$estado')";
        $db = $this->conectar();
        $query = $db->prepare($sql);
        $query->execute();
    }

    public function editarUsuario($id, $foto, $nombre, $apellidos, $contrasenya, $correoElectronico ,$telefono, $rol, $estado) {
        $sql = "UPDATE usuarios SET Foto_usuario = '$foto', Nombre = '$nombre', Apellidos = '$apellidos', Contrasenya = '$contrasenya', Correo_electronico = '$correoElectronico', Telefono = '$telefono', Rol = '$rol', Estado = '$estado' WHERE ID_usuario = $id";
        $db = $this->conectar();
        $query = $db->prepare($sql);
        $query->execute();
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE ID_usuario = $id";
        $db = $this->conectar();
        $query = $db->prepare($sql);
        $query->execute();
    }
    
}
?>