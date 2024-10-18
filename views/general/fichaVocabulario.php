<?php
    if(isset($_SESSION['Rol'])){
?>
    <div>
        <div><h2><?php echo $nombre; ?></h2></div>
    </div>
    <?php
    foreach ($campos as $indice => $campo) {
        echo"<input type='text' name='campo_$campo' id='$campo' value='$campo'></input>";
    }
    ?>
    <input type="text" name="crear" id="crear" placeholder="+ Crear nou camp">
<?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>