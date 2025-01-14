<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div id="campsLlista">
        <?php
            foreach($nombresVocabularios as $indice => $nombre){
                $id = $nombre['id_vocabulario'];
                $nombreVocabulario = $nombre['nombre_vocabulario'];
                ?>  
                    <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=<?php echo $id; ?>&nombre=<?php echo urlencode($nombreVocabulario); ?>">

                        <div>
                            <p><?php echo $nombre["nombre_vocabulario"]; ?></p>
                        </div>
                    </a> 
                <?php
            }
        ?>
    </div>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>