<?php
    if(isset($_SESSION['Rol'])){
    ?>

<div id="fichaCrearUbicaciones">
    <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
        <label for="name">Nom de l'ubicació:</label>
        <input type="text" id="name" name="nombreUbicacion" required>
        <label for="name">Comentari de l'ubicació:</label>
        <textarea type="date" id="comentario_ubicacion" name="comentario_ubicacion"></textarea>
        <input type="submit" value="Crear Ubicació">
    </form>
</div>

<?php
        }
        else {
            echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
        }
        ?>