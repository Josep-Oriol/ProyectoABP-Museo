<?php
require_once("Database.php");
class Usuarios extends Database {
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    private $rol;

    public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

	public function getRol(){
		return $this->rol;
	}

	public function setRol($rol){
		$this->rol = $rol;
	}

    
    public function verificarLogin($user, $password){
        //Seleccionamos el registro que coincida con el usuario introducido y la contraseña introducida.
        $sql = "SELECT * FROM usuarios WHERE Usuario = '$user' AND contrasenya = '$password'";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function mostrarUsuarios(){
        $sql ="SELECT * FROM usuarios";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function mostrarUsuario($id) {
        $sql ="SELECT * FROM usuarios WHERE ID_usuario = $id";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function crearUsuario($foto, $usuario, $nombre, $apellidos, $contrasenya, $correoElectronico ,$telefono, $rol, $estado) {
        $sql = "INSERT INTO usuarios (Foto_usuario, Usuario, Nombre, Apellidos, Contrasenya, Correo_electronico, Telefono, Rol, Estado) VALUES ('$foto', '$usuario', '$nombre', '$apellidos', '$contrasenya', '$correoElectronico', '$telefono', '$rol', '$estado')";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function eliminarFoto($id) {
        $sql = "SELECT Foto_usuario FROM usuarios WHERE ID_usuario = $id";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        $foto = $resultado['Foto_usuario'];
        //Si la foto del usuario es la predeterminada nos aseguramos de que no se elimine del directorio.
        if ($foto != 'images/IconDefaultUser.png') {
            unlink($foto);
        }
    }

    public function editarUsuario($fotoExist, $id, $foto, $usuario, $nombre, $apellidos, $correoElectronico ,$telefono, $rol, $estado) {
        //Si se ha subido una nueva foto, eliminamos la anterior y hacemos la actualización de los campos.
        if ($fotoExist) {
            $this->eliminarFoto($id);
            $sql = "UPDATE usuarios SET Foto_usuario = '$foto', Usuario = '$usuario', Nombre = '$nombre', Apellidos = '$apellidos', Correo_electronico = '$correoElectronico', Telefono = '$telefono', Rol = '$rol', Estado = '$estado' WHERE ID_usuario = $id";
        }
        else {
            //Si no se ha subido una foto actualizamos todos los campos menos el de foto.
            $sql = "UPDATE usuarios SET Usuario = '$usuario', Nombre = '$nombre', Apellidos = '$apellidos', Correo_electronico = '$correoElectronico', Telefono = '$telefono', Rol = '$rol', Estado = '$estado' WHERE ID_usuario = $id";
        }
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function eliminarUsuario($id) {
        $this->eliminarFoto($id);
        $sql = "DELETE FROM usuarios WHERE ID_usuario = $id";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function subirFotoServidor($nombreCampo) {
        $directorio = "images/Usuarios/"; //Directorio destino para guardar las imágenes de los usuarios.
        $idFoto = time(); //Usamos el tiempo actual como identificador de la foto.
        $path = pathinfo($_FILES[$nombreCampo]['name']); //Obtenemos el path de la foto subida.
        $extension = $path['extension']; //Obtenemos la extensión de la misma.

        $extensionesPosibles = ['png', 'jpg', 'jpeg'];
        if (in_array($extension, $extensionesPosibles)) { //Comprobamos que la extensión del fichero esté dentro de las posibles.
            $nombreFichero = $idFoto . "." . $extension;
            move_uploaded_file($_FILES[$nombreCampo]['tmp_name'], $directorio . $nombreFichero); //Movemos el fichero del directorio temporal al nuevo concatenado con el nuevo nombre del fichero.
            $destino = $directorio . $nombreFichero;
        }
        else {
            echo "<h2>No se ha podido subir la imagen. La extensión no es válida.</h2>";
            $destino = "images/IconDefaultUser.png"; //Si no está dentro de las extensiones posibles, mostramos el mensaje y establecemos la imagen predeterminada como la foto que tendrá el usuario.
        }
        return $destino;
    }
    
}
?>