
<?php
    if(isset($_SESSION['Rol'])){ ?>
<div id = "general">
    <div>
        <h1>Llistat d'obres</h1>
        <div>
            <div>
                <button id="buscar">
                    <img src="images/lupa.png" alt="">
                </button>
                <input type="text" id="busqueda">
                <button>
                    <img src="images/ajustes_deslizadores.png" alt="">
                </button>
            </div>
            <div>
                <div>
                    <a>0 - 50</a>
                    <img src="images/flecha_abajo.png" alt="">
                </div>
                <div>
                    <img src="images/flecha_izquierda.png" alt="">
                    <img src="images/flecha_derecha.png" alt="">
                </div>
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
                    <a href="index.php?controller=Obras&action=crear"><button>Crear obra</button></a>
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
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href=""><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=eliminar&id="><img src="images/borrarv2.png" alt="" class="iconoEliminar"></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Tècnic') {
                ?>
                    <a href=""><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Lector') {
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
