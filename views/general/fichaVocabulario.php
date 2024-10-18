<?php
    if(isset($_SESSION['Rol'])){
?>
    <div id="fichaVocabulario">
        <div>
            <h2><?php echo $nombre; ?></h2>
        </div>
        <div>
            <?php
            foreach ($campos as $indice => $campo) {
                echo "<input type='text' name='campo_{$campo['Nombre_campo']}' id='{$campo['Nombre_campo']}' value='{$campo['Nombre_campo']}'/>\n";
            }
            ?>
        </div>
        <form action="index.php?controller=Vocabularios&action=crearCampo&id=<?php echo $id; ?>" method="POST">
            <input type="text" name="crear" id="crear" placeholder="+ Crear nou camp">
            <input type="submit" value="Crear">
        </form>
        <div>
            <button>Guardar</button>
            <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=<?php echo $id; ?>"><button>Descartar cambios</button></a>
        </div>
        
    </div>
<?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>