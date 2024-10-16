<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div id="fichaEditarUsuario">
        <div>
            <?php
                if ($datos['Foto_usuario'] != NULL) {
                    echo "<img src='{$datos['Foto_usuario']}' alt='foto usuario'>";
                }
                else {
                    echo "<img src='images/login_icon.png' alt='logo usuario'>";
                }
            ?>
            <form action="index.php?controller=Usuarios&action=editar&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="nombre">Nom</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $datos['Nombre']; ?>">
                </div>
                <div>
                    <label for="apellidos">Cognoms</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $datos['Apellidos']; ?>">
                </div>
                <div>
                    <label for="contrasenya">Contrasenya</label>
                    <input type="password" name="contrasenya" id="contrasenya" value="<?php echo $datos['Contrasenya']; ?>">
                </div>
                <div>
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
                                echo "<option value='Administració'>Administració</option>";
                                break;
                            case 'Lector':
                                echo "<option selected value='Lector'>Lector</option>";
                                echo "<option value='Tècnic'>Tècnic</option>";
                                echo "<option value='Administració'>Administració</option>";
                                break;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="correo_electronico">Correu electrònic</label>
                    <input type="email" name="correo_electronico" id="correo_electronico" value="<?php echo $datos['Correo_electronico']; ?>">
                </div>
                <div>
                    <label for="telefono">Telèfon</label>
                    <input type="tel" name="telefono" id="telefono" value="<?php echo $datos['Telefono']; ?>">
                </div>
                <div>
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
                </div>
                <div>
                    <label for="foto">Fotografía</label>
                    <input type="file" name="foto" id="foto">
                    <span>PNG/JPG/JPEG</span>
                </div>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>
    
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>