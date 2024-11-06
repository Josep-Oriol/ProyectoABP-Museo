<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaCrearUbicaciones">
        <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
            <input type="text" name="nombreUbicacion">
            <input type="submit" value="Crear Ubicació">
        </form>
    </div>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
    ?>