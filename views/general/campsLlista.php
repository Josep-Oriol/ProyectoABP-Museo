<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div id="campsLlista">
        <?php
            foreach($nombresVocabularios as $indice => $nombre){
                $id = $nombre['ID_vocabulario'];
                ?>
                    <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=<?php echo $id; ?>">
                        <div>
                            <p><?php echo $nombre["Nombre_vocabulario"]; ?></p>
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