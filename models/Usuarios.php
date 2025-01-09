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
        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasenya = '$password'";
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
        $sql ="SELECT * FROM usuarios WHERE id_usuario = $id";
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

    public function comprobarUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $existe = false;
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        if ($query->rowCount() > 0) {
            $existe = true;
        }
        return $existe;
    }

    public function crearUsuario($foto, $usuario, $nombre, $apellidos, $contrasenya, $correoElectronico ,$telefono, $rol, $estado) {
        $sql = "INSERT INTO usuarios (foto_usuario, usuario, nombre, apellidos, contrasenya, correo_electronico, telefono, rol, estado) VALUES ('$foto', '$usuario', '$nombre', '$apellidos', '$contrasenya', '$correoElectronico', '$telefono', '$rol', '$estado')";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function eliminarFoto($id) {
        $sql = "SELECT foto_usuario FROM usuarios WHERE id_usuario = $id";
        $db = $this->conectar();
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        $foto = $resultado['foto_usuario'];
        //Si la foto del usuario es la predeterminada nos aseguramos de que no se elimine del directorio.
        if ($foto != 'images/IconDefaultUser.png') {
            unlink($foto);
        }
    }

    public function editarUsuario($fotoExist, $id, $foto, $usuario, $nombre, $apellidos, $correoElectronico ,$telefono, $rol, $estado) {
        //Si se ha subido una nueva foto, eliminamos la anterior y hacemos la actualización de los campos.
        if ($fotoExist) {
            $this->eliminarFoto($id);
            $sql = "UPDATE usuarios SET foto_usuario = '$foto', usuario = '$usuario', nombre = '$nombre', apellidos = '$apellidos', correo_electronico = '$correoElectronico', telefono = '$telefono', rol = '$rol', estado = '$estado' WHERE id_usuario = $id";
        }
        else {
            //Si no se ha subido una foto actualizamos todos los campos menos el de foto.
            $sql = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', apellidos = '$apellidos', correo_electronico = '$correoElectronico', telefono = '$telefono', rol = '$rol', estado = '$estado' WHERE id_usuario = $id";
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
        $sql2 = "UPDATE copias_seguridad SET fk_creador = NULL";
        $sql3 = "UPDATE logs_obras SET persona_autorizada = NULL";
        $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
        $db = $this->conectar();
        try {
            $query2 = $db->prepare($sql2);
            $query2->execute();
            $query3 = $db->prepare($sql3);
            $query3->execute();
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $error) {
            echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
        }
    }

    public function subirFotoServidor($nombreCampo) {
        $directorio = "images/usuarios/"; //Directorio destino para guardar las imágenes de los usuarios.
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