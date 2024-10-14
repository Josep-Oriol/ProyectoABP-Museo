<?php
    if(isset($_SESSION['Rol'])){ ?>
<div id="general">
    <div>
        <div>
            <h1>Usuaris</h1>
        </div>
        <div>
            <div>
                <img class="img_lupa" src="images/lupa.png" alt="">
                <input type="text">
                <img class="img_ajustes" src="images/ajustes_deslizadores.png" alt="">
            </div>
        </div>
        <div class="usuarios_visibles_desplegable">
            <div>0-50</div>
            <img class="flecha_abajo" src="images/flecha_abajo.png" alt="">
        </div>
        <div>
            <img src="images/flecha_izquierda.png" alt="">
            <img src="images/flecha_derecha.png" alt="">
        </div>
    </div>
    <div>
        <table>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Cognoms</td>
                <td>Telefón</td>
                <td>Rol</td>
                <td>Estat</td>
                <td> 
                    <a href="index.php?controller=Usuarios&action=crear">+ usuarios</a>
                </td>
            </tr>
        <?php
    foreach($usuarios as $indice => $usuario) {
        $id = $usuario['ID_usuario'];
        echo "<tr>
            <td>{$usuario['ID_usuario']}</td>
            <td>{$usuario['Nombre']}</td>
            <td>{$usuario['Apellidos']}</td>
            <td>{$usuario['Telefono']}</td>
            <td>{$usuario['Rol']}</td>
            <td>{$usuario['Estado']}</td>
            <td>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=eliminar&id=<?php echo $id;?>"><img src="images/borrarv2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Tècnic') {
                ?>
                    <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Lector') {
                ?>
                    <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
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