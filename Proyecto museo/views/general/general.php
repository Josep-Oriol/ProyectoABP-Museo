
<?php
    if(isset($_SESSION['Rol'])){ ?>
        <div id="general">
    <div>
        <div>
            <h1>Llistat d'obres</h1>
        </div>
        <div>
            <div>
                <img src="images/lupa.png" alt="">
                <input type="text">
            </div>
        </div>
    </div>
    <div>
        <table>
            <tr>
                <td>Imatge</td>
                <td>NºRegistre</td>
                <td>Nom</td>
                <td>Títol</td>
                <td>Autor</td>
                <td>Datació</td>
                <td>Ubicació</td>
                <td> 

                    <form action="" method="POST">
                        <input type="submit" value="+ Obras">
                    </form>
                </td>
            </tr>
        <?php
    foreach($obras as $indice => $obra) {

        $id = $obra['Numero_registro'];
        echo "<tr>
            <td>{$obra['Fotografia']}</td>
            <td>{$obra['Numero_registro']}</td>
            <td>{$obra['Nombre_del_objeto']}</td>
            <td>{$obra['Titulo']}</td>
            <td>{$obra['Autor']}</td>
            <td>{$obra['Datacion']}</td>
            <td>{$obra['Descripcion']}</td>

            <td>";
            if ($_SESSION['Rol'] == 'administracio') {
                ?>
                    <a href=""><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href=""><img src="images/borrarv2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'tecnic') {
                ?>
                    <a href=""><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'lector') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                <?php
            }
            echo "</td>";
        echo "</tr>";
    }
?>
        </table>
    </div>
</div>
   <?php }
    else{
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>
