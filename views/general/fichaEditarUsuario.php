<?php
    if(isset($_SESSION['Rol'])){
        echo "Editando el usuario: " . $_GET['id'];
    ?>
        <form action="index.php?controller=Usuarios&action=editar&id=<?php echo $_GET['id'];?>" method="POST">
            <label for="nombre">Nom</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $datos['Nombre']; ?>">
            <label for="apellidos">Cognoms</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $datos['Apellidos']; ?>">
            <label for="contrasenya">Contrasenya</label>
            <input type="password" name="contrasenya" id="contrasenya" value="<?php echo $datos['Contrasenya']; ?>">
            <label for="rol">Rol</label>
            <select name="rol" id="rol">
                <option value=""></option>
                <?php
                switch ($datos['Rol']) {
                    case 'Administració':
                        echo "<option value='Lector'>Lector</option>";
                        echo "<option value='Tècnic'>Tècnic</option>";
                        echo "<option selected value='Administració'>Administració</option>";
                        break;
                    case 'Tècnic':
                        echo "<option value='Lector'>Lector</option>";
                        echo "<option selected value='Tècnic'>Tècnic</option>";
                        echo "<option selected value='Administració'>Administració</option>";
                        break;
                    case 'Lector':
                        echo "<option selected value='Lector'>Lector</option>";
                        echo "<option value='Tècnic'>Tècnic</option>";
                        echo "<option value='Administració'>Administració</option>";
                        break;
                }
                ?>
            </select>
            <label for="correo_electronico">Correu electrònic</label>
            <input type="email" name="correo_electronico" id="correo_electronico" value="<?php echo $datos['Correo_electronico']; ?>">
            <label for="telefono">Telèfon</label>
            <input type="tel" name="telefono" id="telefono" value="<?php echo $datos['Telefono']; ?>">
            <label for="estado">Estat</label>
            <select name="estado" id="estado">
                <option value=""></option>
                <?php
                if ($datos['Estado'] == 'Actiu') {
                    echo "<option selected value='Actiu'>Actiu</option>";
                    echo "<option value='Inactiu'>Inactiu</option>";
                }
                else {
                    echo "<option value='Actiu'>Actiu</option>";
                    echo "<option selected value='Inactiu'>Inactiu</option>";
                }
                ?>
            </select>
            <label for="foto">Fotografía</label>
            <input type="file" name="foto" id="foto">
            <input type="submit" value="Guardar">
        </form>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>