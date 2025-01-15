<?php
if (isset($_SESSION['Rol'])) {
?>
    <div id="fichaVocabulario">
        <div> 
            <h2><?php echo $nombreVocabulario; ?></h2>
        </div>
        <div>
            <form id="campos">
                <?php
                foreach ($campos as $indice => $campo) {
                    echo "
                    <div class='input-group'>
                        <input class='campo' type='text' name='{$campo['nombre_campo']}' id='{$campo['nombre_campo']}' value='{$campo['nombre_campo']}' autocomplete='off'/>
                        <a href='#'><button type='button' class='codigosGetty' id='{$campo['nombre_campo']}'>Relacionar Getty</button></a>
                        <input class='campo-checkbox' type='checkbox' name='{$campo['nombre_campo']}_checkbox' id='{$campo['nombre_campo']}_checkbox'/>
                    </div>
                    "; 
                }
                ?>
            </form>
            <p id="mensajeEditado"></p>
        </div>

        <form>
            <input type="text" name='<?php echo $id; ?>' id="crearCampoInput" placeholder="+ Crear nou camp">
            <button id="crearCampo">Crear</button>
        </form>
        
        <div>
            <button id="editar">Guardar cambios</button>
            <button id="eliminarCampos">Eliminar</button>
            <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=<?php echo $id; ?>">
                <button type="button">Descartar cambios</button>
            </a>
        </div>
    </div>
<?php
} else {
    echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
}
?>

<div class="popup-overlay">
  <div class="popup-content">
    <div class="popup-header">
      <button class="close-btn">&times;</button>
    </div>
    <div class="popup-body">
      <div id="codigosGetty" class="codigo-getty-list">
      </div>
    </div>
  </div>
</div>