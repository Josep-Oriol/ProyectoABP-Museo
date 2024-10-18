<div id="campsLlista">
   <!-- <a href="#">
        <div>
            <p>Clasificació generica</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Tipus d'exposició</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Material</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Estat de conservació</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Datació</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Causa de baixa</p>
        </div>
    </a>
    <a href="#">
        <div>
            <p>Tècnica</p>
        </div>
    </a>
    <a href="index.php?controller=Vocabularios&action=mostrarCamposVocabulario&id=1">
        <div>
            <p>Forma d'ingrés</p>
        </div>
    </a> -->

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