<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="Exposicion">
        <div>
            <form action="index.php?controller=Restauraciones&action=editar&id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="comentario">Comentari</label>
                    <input type="text" name="comentario" id="comentario" value="<?php echo $datos['comentario_restauracion']; ?>" required>
                </div>
                <div>
                    <label for="nombre">Nom restaurador</label>
                    <input type="text" name="nombre_res" id="nombre" value="<?php echo $datos['nombre_restaurador']; ?>" required>
                </div>

                <div>
                    <label for="fecha_inicio">Data inici</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $datos['fecha_inicio_restauracion']; ?>" required>
                </div>
                <div>
                    <label for="fecha_fin">Data termini</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $datos['fecha_fin_restauracion']; ?>" required>
                </div>
                <div>
                    <label for="obraRelacionada">Numero registre</label>
                    <input list="obras" id="obraRelacionada" class="escogerObra" name="obra" placeholder="Busca la obra" value="<?php echo $datos['numero_registro'] ?>" require_once>
                    <datalist id="obras">
                        <?php
                            foreach($obras as $indice => $obra){
                                echo "<option name='obra' value='".$obra['numero_registro']."'>".$obra['titulo']."</option>";
                            }
                        ?>
                    </datalist>
                </div>
                <div>
                    <label for="nombreObra">Obra en restauració</label>
                    <input type="text" value="<?php echo $datos['titulo'] ?>" readonly>
                </div>
                
                <div>
                    <input type="submit" value="Editar restauració">
                </div>
            </form>
        </div>
    </div>

    <script src="views/js/validacionesFormularios/validacionRestauraciones.js"></script>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>