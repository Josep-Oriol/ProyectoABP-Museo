<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <div id="vocabularios">
        <div>
            <h1>Vocabularis</h1>
        </div>
        <div>
            <div>
                <div><a href="index.php?controller=Vocabularios&action=mostrarUbicaciones"><img src="images/ubicaciones.png" alt=""></a></div>
                <div><p>Ubicacions</p></div>
            </div>
            <div>
                <div><a href="index.php?controller=Vocabularios&action=mostrarAutories"><img src="images/autories.png" alt=""></a></div>
                <div><p>Autories</p></div>
            </div>
            <div>
                <div><a href="index.php?controller=Vocabularios&action=mostrarVocabularios"><img src="images/campsLlista.png" alt=""></a></div>
                <div><p>Camps llista</p></div>
            </div>
        </div>
    </div>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
    ?>