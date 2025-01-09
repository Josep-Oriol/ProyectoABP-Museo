<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <section id="fichaEditarUsuario">
        <div>
            <div>
                <h2>Dades Principals</h2>
                <div>
                    <form action="index.php?controller=Usuarios&action=editar&id=<?php echo $datos['id_usuario'];?>" method="POST" enctype="multipart/form-data" id="formEditarUsuario">
                        <div>
                            <div>
                                <label for="fotografia">Fotografia</label>
                                <img src="<?php echo $datos['foto_usuario'] ?>" alt="foto usuario" id="fotografia">
                            </div>
                        </div>
                        <div>
                            <div>
                                <div>
                                    <label for="usuario">Usuari</label>
                                    <input type="text" id="usuario" name="usuario" value="<?php echo $datos['usuario'];?>">
                                    <p id="errorUsuario"></p>
                                </div>
                                <div>
                                    <label for="nombre">Nom</label>
                                    <input type="text" id="nombre" name="nombre" value="<?php echo $datos['nombre'];?>">
                                    <p id="errorNombre"></p>
                                </div>
                                <div>
                                    <label for="apellidos">Cognoms</label>
                                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $datos['apellidos'];?>">
                                    <p id="errorApellidos"></p>
                                </div>
                                <div>
                                    <label for="correo">Correu electrònic</label>
                                    <input type="text" id="correo" name="correo_electronico" value="<?php echo $datos['correo_electronico'];?>">
                                </div>
                                <div>
                                    <label for="telefono">Telèfon</label>
                                    <input type="text" id="telefono" name="telefono" value="<?php echo $datos['telefono'];?>">
                                    <p id="errorTelefono"></p>
                                </div>
                                <div>
                                    <label for="rol">Rol</label>
                                    <select name="rol" id="rol">
                                        <?php
                                            switch($datos['rol']){
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
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado">
                                        <?php 
                                            if($datos['estado'] == "Actiu"){
                                                echo "<option value='Actiu' selected>Actiu</option>";
                                                echo "<option value='Inactiu'>Inactiu</option>";
                                            }
                                            else{
                                                echo "<option value='Actiu'>Actiu</option>";
                                                echo "<option value='Inactiu' selected>Inactiu</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <span>Fotografía</span>
                                <div id="subirImagen">
                                    <img src="images/subirArchivo.png" alt="subir archivo" title="Subir archivo">
                                    <span>PNG/JPG/JPEG/WEBP</span>
                                    <p id="nombreArchivo"></p>
                                    <input type="file" name="fotografia" id="inputFotografia">
                                </div>
                            </div>
                            <div>
                                <input type="submit" value="Guardar">
                                <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $datos['id_usuario'];?>"><button type="button">Descartar canvis</button></a>
                            </div>
                        </div>  
                    </form>             
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }