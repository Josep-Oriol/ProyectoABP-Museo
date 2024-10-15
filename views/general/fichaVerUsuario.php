<?php
    if(isset($_SESSION['Rol'])){
        echo "Mostrando el usuario: " . $_GET['id'];
    ?>
        <form action="index.php?controller=Usuarios&action=mostrarUsuario&id=<?php echo $_GET['id'];?>" method="POST">
            <label for="nombre">Nom</label>
            <span id="nombre"><?php echo $datos['Nombre']; ?></span>
            <label for="apellidos">Cognoms</label>
            <span id="apellidos"><?php echo $datos['Apellidos']; ?></span>
            <label for="contrasenya">Contrasenya</label>
            <span id="contrasenya"><?php echo $datos['Contrasenya']; ?></span>
            <label for="rol">Rol</label>
            <span id="rol"><?php echo $datos['Rol']; ?></span>
            <label for="correo_electronico">Correu electrònic</label>
            <span id="correo_electronico"><?php echo $datos['Correo_electronico']; ?></span>
            <label for="telefono">Telèfon</label>
            <span id="telefono"><?php echo $datos['Telefono']; ?></span>
            <label for="estado">Estat</label>
            <span id="estado"><?php echo $datos['Estado']; ?></span>
            <label for="foto">Fotografía</label>
            <span id="foto"><?php echo $datos['Foto']; ?></span>
        </form>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

