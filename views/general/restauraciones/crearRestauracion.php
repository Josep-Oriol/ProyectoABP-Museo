<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="Exposicion">
        <div>

            <form action="index.php?controller=Restauraciones&action=crear" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="comentario">Comentari</label>
                    <input type="text" name="comentario" id="comentario" required>
                </div>
                <div>
                    <label for="nombre">Nom restaurador</label>
                    <input type="text" name="nombre_res" id="nombre" required>
                </div>

                <div>
                    <label for="fecha_inicio">Data inici</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div>
                    <label for="fecha_fin">Data termini</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" required>
                </div>
                <div>
                    <label for="obraRelacionada">Obra en restauració</label>
                    <input list="obras" id="obraRelacionada" name="obra" placeholder="Busca la obra">
                    <datalist id="obras">
                        <?php
                            foreach($obras as $indice => $obra){
                                echo "<option name='obra' value='".$obra['numero_registro']."'>".$obra['titulo']."</option>";
                            }
                        ?>
                    </datalist>
                </div>
                <div>
                    <input type="submit" value="Crear restauració">
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