<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="Exposicion">
        <div>
            <form action="index.php?controller=Exposiciones&action=crear" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" name="descripcio" id="descripcio" required>
                </div>
                <div>
                    <label for="lloc">Lloc Exposició</label>
                    <input type="text" name="lloc" id="lloc" required>
                </div>
                <div>
                    <label for="tipus">Tipus</label>
                    <select name="tipus" id="tipus">
                        <?php 
                        foreach($campos as $indice => $campo){
                            $dato = $campo['nombre_campo'];
                            echo "<option>$dato</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="inici">Data inici</label>
                    <input type="date" name="inici" id="inici" required>
                </div>
                <div>
                    <label for="final">Data termini</label>
                    <input type="date" name="final" id="final" required>

                </div>
                <div>
                    <input type="submit" value="Crear exposició">
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