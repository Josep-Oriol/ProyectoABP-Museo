<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="Exposicion">
        <div>
            <form action="">
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" value="<?php echo $datos['id_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" value="<?php echo $datos['texto_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="lloc">Lloc exposició</label>
                    <input type="text" value="<?php echo $datos['lugar_exposicion'];?>" readonly>
                </div>
                <div>
                    <label for="inici">Data inici</label>
                    <input type="date" value="<?php echo $datos['fecha_inicio_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="termini">Data termini</label>
                    <input type="date" value="<?php echo $datos['fecha_fin_exposicion']; ?>" readonly>
                </div>
            </form>
        </div>
    </div>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

