<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="fichaUsuario">
        <div>
            <img src="images/login_icon.png" alt="Icono usuario">
            <form action="index.php?controller=Usuarios&action=crear" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="nombre">Nom</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div>
                    <label for="apellidos">Cognoms</label>
                    <input type="text" name="apellidos" id="apellidos" required>
                </div>
                <div>
                    <label for="contrasenya">Contrasenya</label>
                    <input type="password" name="contrasenya" id="contrasenya" required>
                </div>
                <div>
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol">
                        <option value="Lector">Lector</option>
                        <option value="Tècnic">Tècnic</option>
                        <option value="Administració">Administració</option>
                    </select>
                </div>
                <div>
                    <label for="correo_electronico">Correu electrònic</label>
                    <input type="email" name="correo_electronico" id="correo_electronico" required>
                </div>
                <div>
                    <label for="telefono">Telèfon</label>
                    <input type="tel" name="telefono" id="telefono" required>
                </div>
                <div>
                    <label for="estado">Estat</label>
                    <select name="estado" id="estado">
                        <option value="Actiu">Actiu</option>
                        <option value="Inactiu">Inactiu</option>
                    </select>
                </div>
                <div>
                    <label for="foto">Fotografía</label>
                    <input type="file" name="foto" id="foto">
                </div>
                <input type="submit" value="Crear Usuari">
            </form>
        </div>
    </div>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>