<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="editarExposicion">
        <div>
            <div>
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" value="<?php echo $datos['texto_exposicion']; ?>">
                </div>
                <div>
                    <label for="lloc">Lloc exposició</label>
                    <input type="text" value="<?php echo $datos['lugar_exposicion']?>;">
                </div>
                <div>
                    <label for="inici">Data inici</label>
                    <input type="date" value="<?php echo $datos['fecha_inicio_exposicion']; ?>">
                </div>
                <div>
                    <label for="termini">Data termini</label>
                    <input type="date" value="<?php echo $datos['fecha_fin_exposicion']; ?>">
                </div>
            </div>
        </div>
    </div>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

