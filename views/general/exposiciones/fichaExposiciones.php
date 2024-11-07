<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaVerUsuario">
        <div>
            <div>
                <div>
                    <label for="descripcio">Descripció</label>
                    <span id="descripcio"><?php echo $datos['texto_exposicion']; ?></span>
                </div>
                <div>
                    <label for="lloc">Lloc exposició</label>
                    <span id="lloc"><?php echo $datos['lugar_exposicion']; ?></span>
                </div>
                <div>
                    <label for="inici">Data inici</label>
                    <span id="inici"><?php echo $datos['fecha_inicio_exposicion']; ?></span>
                </div>
                <div>
                    <label for="termini">Data termini</label>
                    <span id="termini"><?php echo $datos['fecha_fin_exposicion']; ?></span>
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

