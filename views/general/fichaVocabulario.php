<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaVocabulario">
        <div>
            <h2><?php echo $nombre; ?></h2>
        </div>
        <div>
            <form action="index.php?controller=Vocabularios&action=editarCampos&id=<?php echo $id; ?>" method="POST">
                <?php
                foreach ($campos as $indice => $campo) {
                    echo "<input type='text' name='{$campo['Nombre_campo']}' id='{$campo['Nombre_campo']}' value='{$campo['Nombre_campo']}'/>\n";
                }
                ?>
                <input type="submit" value="Guardar">
            </form>
        </div>
        <form action="index.php?controller=Vocabularios&action=crearCampo&id=<?php echo $id; ?>" method="POST">
            <input type="text" name="crear" id="crear" placeholder="+ Crear nou camp" required>
            <input type="submit" value="Crear">
        </form>
        <div>
            <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=<?php echo $id; ?>"><button>Descartar cambios</button></a>
        </div>
        
    </div>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>