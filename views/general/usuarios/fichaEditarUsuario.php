<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div class="fichaUsuario">
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
                    <label for="usuario">Usuari</label>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $datos['Usuario']; ?>" required>
                </div>
                <div>
                    <label for="nombre">Nom</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $datos['Nombre']; ?>" required>
                </div>
                <div>
                    <label for="apellidos">Cognoms</label>
                    <input type="text" name="apellidos" id="apellidos" value="<?php echo $datos['Apellidos']; ?>">
                </div>
                <div>
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol" required>
                        <?php
                        switch ($datos['Rol']) {
                            case 'Administració':
                                echo "<option value='Administració'>Administració</option>";
                                echo "<option value='Lector'>Lector</option>";
                                echo "<option value='Tècnic'>Tècnic</option>";
                                break;
                            case 'Tècnic':
                                echo "<option value='Tècnic'>Tècnic</option>";
                                echo "<option value='Lector'>Lector</option>";
                                break;
                            case 'Lector':
                                echo "<option value='Lector'>Lector</option>";
                                echo "<option value='Tècnic'>Tècnic</option>";
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
                    <select name="estado" id="estado" required>
                        <?php
                        
                        if ($datos['Estado'] == 'Actiu') {
                            echo "<option value='Actiu'>Actiu</option>";
                            echo "<option value='Inactiu'>Inactiu</option>";
                        }
                        else {
                            echo "<option value='Inactiu'>Inactiu</option>";
                            echo "<option value='Actiu'>Actiu</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="foto">Fotografía</label>
                    <input type="file" name="foto" id="foto">
                    <span>PNG/JPG/JPEG</span>
                </div>
                <div>
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>  
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>