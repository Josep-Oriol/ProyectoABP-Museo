<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaVerUsuario">
        <div>
            <?php
                if ($datos['Foto_usuario'] != NULL) {
                    echo "<img src='{$datos['Foto_usuario']}' alt='foto usuario'>";
                }
                else {
                    echo "<img src='images/login_icon.png' alt='logo usuario'>";
                }
            ?>
            <div>
                <div>
                    <label for="nombre">Nom</label>
                    <span id="nombre"><?php echo $datos['Nombre']; ?></span>
                </div>
                <div>
                    <label for="apellidos">Cognoms</label>
                    <span id="apellidos"><?php echo $datos['Apellidos']; ?></span>
                </div>
                <div>
                    <label for="rol">Rol</label>
                    <span id="rol"><?php echo $datos['Rol']; ?></span>
                </div>
                <div>
                    <label for="correo_electronico">Correu electrònic</label>
                    <span id="correo_electronico"><?php echo $datos['Correo_electronico']; ?></span>
                </div>
                <div>
                    <label for="telefono">Telèfon</label>
                    <span id="telefono"><?php echo $datos['Telefono']; ?></span>
                </div>
                <div>
                    <label for="estado">Estat</label>
                    <span id="estado"><?php echo $datos['Estado']; ?></span>
                </div>
                <div>
                    <label for="foto">Fotografía</label>
                    <span id="foto"><?php echo $datos['Foto_usuario']; ?></span>
                </div>
            </div>
        </div>
    </div>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

