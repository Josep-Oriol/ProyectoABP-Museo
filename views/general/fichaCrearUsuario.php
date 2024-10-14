<?php
    if(isset($_SESSION['Rol'])){
    ?>
        <form action="index.php?controller=Usuarios&action=crear" method="POST">
            <label for="nombre">Nom</label>
            <input type="text" name="nombre" id="nombre">
            <label for="apellidos">Cognoms</label>
            <input type="text" name="apellidos" id="apellidos">
            <label for="contrasenya">Contrasenya</label>
            <input type="password" name="contrasenya" id="contrasenya">
            <label for="rol">Rol</label>
            <select name="rol" id="rol">
                <option value=""></option>
                <option value="Lector">Lector</option>
                <option value="Tècnic">Tècnic</option>
                <option value="Administració">Administració</option>
            </select>
            <label for="correo_electronico">Correu electrònic</label>
            <input type="email" name="correo_electronico" id="correo_electronico">
            <label for="telefono">Telèfon</label>
            <input type="tel" name="telefono" id="telefono">
            <label for="estado">Estat</label>
            <select name="estado" id="estado">
                <option value=""></option>
                <option value="Actiu">Actiu</option>
                <option value="Inactiu">Inactiu</option>
            </select>
            <label for="foto">Fotografía</label>
            <input type="file" name="foto" id="foto">
            <input type="submit" value="Crear Usuari">
        </form>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>