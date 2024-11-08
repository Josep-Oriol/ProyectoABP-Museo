<?php
    if (isset($_SESSION['Rol'])) {
?>
    <div id="fichaCrearUsuario">
        <div>
            <h2>Datos del Usuario</h2>
            <div>
                <!-- Imagen -->
                <div class="ss">
                    <img src="images/IconDefaultUser.png" alt="Icono usuario">
                </div>

                <!-- Formulario -->
                <form action="index.php?controller=Usuarios&action=crear" enctype="multipart/form-data" method="POST">
                    <!-- Div de los inputs -->
                    <div>
                        <div>
                            <label for="usuario">Usuari</label>
                            <input type="text" name="usuario" id="usuario" required>
                        </div>
                        <div>
                            <label for="nombre">Nom</label>
                            <input type="text" name="nombre" id="nombre" required>
                        </div>
                        <div>
                            <label for="apellidos">Cognoms</label>
                            <input type="text" name="apellidos" id="apellidos">
                        </div>
                        <div>
                            <label for="contrasenya">Contrasenya</label>
                            <input type="password" name="contrasenya" id="contrasenya" required>
                        </div>
                        <div>
                            <label for="rol">Rol</label>
                            <select name="rol" id="rol" required>
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
                        </div>
                        <div>
                            <label for="estado">Estat</label>
                            <select name="estado" id="estado" required>
                                <option value="Actiu">Actiu</option>
                                <option value="Inactiu">Inactiu</option>
                            </select>
                        </div>
                        <div>
                            <label for="foto">Fotografía</label>
                            <input type="file" name="foto" id="foto">
                            <span>PNG/JPG/JPEG</span>
                        </div>
                        <div>
                            <input type="submit" value="Crear Usuari">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="views/js/validacionesFormularios/usuarios/validacionCrear.js"></script>
<?php
    } else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>
