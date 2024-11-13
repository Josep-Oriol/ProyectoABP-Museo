
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
                <td>Tècnica</td>
                <td>Títol</td>
                <td>Autor</td>
                <td>Any</td>
                <td>Ubicació</td>
                <td> 
                    <a href="index.php?controller=Obras&action=crear"><button>Crear obra</button></a>
                </td>
            </tr>
        <?php
    foreach($obras as $indice => $obra) {
        $id = $obra['numero_registro'];
        echo "<tr>
            <td>{$obra['fotografia']}</td>
            <td>{$obra['numero_registro']}</td>
            <td>{$obra['nombre_objeto']}</td>
            <td>{$obra['titulo']}</td>
            <td>{$obra['autor']}</td>
            <td>{$obra['anyo_final']}</td>
            <td>{$obra['descripcion_ubicacion']}</td>

            <td>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id;?>"><img src="images/borrarv2.png" alt="" class="iconoEliminar"></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Tècnic') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
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
