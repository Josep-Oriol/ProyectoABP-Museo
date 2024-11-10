<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div class="Exposicion">
        <div>
            <form action="index.php?controller=Exposiciones&action=editar&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" name="descripcio" id="descripcio" value="<?php echo $datos['texto_exposicion']; ?>" required>
                </div>
                <div>
                    <label for="lloc">Lloc exposició</label>
                    <input type="text" name="lloc" id="lloc" value="<?php echo $datos['lugar_exposicion']; ?>" required>
                </div>
                <div>
                    <label for="tipus">Tipus</label>
                    <select name="tipus" id="tipus">
                        <?php 
                        foreach($campos as $indice => $campo){
                            $dato = $campo['nombre_campo'];
                            if($datos['tipo_exposicion'] == $dato){
                                echo "<option selected>$dato</option>";
                            }
                            else{
                                echo "<option>$dato</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label for="inici">Data inici</label>
                    <input type="date" name="inici" id="inici" value="<?php echo $datos['fecha_inicio_exposicion']; ?>">
                </div>
                <div>
                    <label for="final">Data Termini</label>
                    <input type="date" name="final" id="final" value="<?php echo $datos['fecha_fin_exposicion']; ?>">
                </div>

                <div>
                    <input type="submit" value="Guardar">
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