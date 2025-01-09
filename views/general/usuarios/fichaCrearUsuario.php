<?php
    if (isset($_SESSION['Rol'])) {
?>
    <section id="fichaCrearUsuario">
        <div>
            <h2>Datos del Usuario</h2>
            <div>
                <!-- Imagen -->
                <div class="ss">
                    <img src="images/IconDefaultUser.png" alt="Icono usuario">
                </div>

                <!-- Formulario -->
                <form id="formCrearUsuario" action="index.php?controller=Usuarios&action=crear" enctype="multipart/form-data" method="POST">
                    <!-- Div de los inputs -->
                    <div>
                        <div>
                            <div>
                                <label for="usuario">Usuari</label>
                                <input class='userForm' type="text" name="usuario" id="usuario" required>
                                <p id="errorUsuario"></p>
                            </div>
                            <div>
                                <label for="nombre">Nom</label>
                                <input class='userForm' type="text" name="nombre" id="nombre" required>
                                <p id="errorNombre"></p>
                            </div>
                            <div>
                                <label for="apellidos">Cognoms</label>
                                <input type="text" name="apellidos" id="apellidos">
                                <p id="errorApellidos"></p>
                            </div>
                            <div>
                                <label for="contrasenya">Contrasenya</label>
                                <input class='userForm' type="password" name="contrasenya" id="contrasenya" required>
                            </div>
                            <div>
                                <label for="rol">Rol</label>
                                <select class='userForm' name="rol" id="rol" required>
                                    <option value="Lector">Lector</option>
                                    <option value="Tècnic">Tècnic</option>
                                    <option value="Administració">Administració</option>
                                </select>
                            </div>
                            <div>
                                <label for="correo_electronico">Correu electrònic</label>
                                <input type="email" name="correo_electronico" id="correo_electronico">
                            </div>
                            <div>
                                <label for="telefono">Telèfon</label>
                                <input type="tel" name="telefono" id="telefono">
                                <p id="errorTelefono"></p>
                            </div>
                            <div>
                                <label for="estado">Estat</label>
                                <select class='userForm' name="estado" id="estado" required>
                                    <option value="Actiu">Actiu</option>
                                    <option value="Inactiu">Inactiu</option>
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
                            <input type="submit" value="Crear Usuari">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="views/js/validacionesFormularios/usuarios/validacionCrear.js"></script>
<?php
    } else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>
