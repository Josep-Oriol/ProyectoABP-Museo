<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaVerUsuario">
        <div>
            <?php
                if ($datos['foto_usuario'] != NULL) {
                    echo "<img src='{$datos['foto_usuario']}' alt='foto usuario'>";
                }
                else {
                    echo "<img src='images/login_icon.png' alt='logo usuario'>";
                }
            ?>
            <div>
                <div>
                    <label for="usuario">Usuari</label>
                    <span id="usuario"><?php echo $datos['usuario']; ?></span>
                </div>
                <div>
                    <label for="nombre">Nom</label>
                    <span id="nombre"><?php echo $datos['nombre']; ?></span>
                </div>
                <div>
                    <label for="apellidos">Cognoms</label>
                    <span id="apellidos"><?php echo $datos['apellidos']; ?></span>
                </div>
                <div>
                    <label for="rol">Rol</label>
                    <span id="rol"><?php echo $datos['rol']; ?></span>
                </div>
                <div>
                    <label for="correo_electronico">Correu electrònic</label>
                    <span id="correo_electronico"><?php echo $datos['correo_electronico']; ?></span>
                </div>
                <div>
                    <label for="telefono">Telèfon</label>
                    <span id="telefono"><?php echo $datos['telefono']; ?></span>
                </div>
                <div>
                    <label for="estado">Estat</label>
                    <span id="estado"><?php echo $datos['estado']; ?></span>
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

