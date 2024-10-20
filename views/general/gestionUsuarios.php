<?php
    if(isset($_SESSION['Rol'])){ ?>
    <?php include 'views/general/popUpEliminar.php'; ?> 
<div id="general">
    <div>
        <h1>Usuaris</h1>
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
                <td>ID</td>
                <td>Foto de perfil</td>
                <td>Nom</td>
                <td>Cognoms</td>
                <td>Correu electrònic</td>
                <td>Telèfon</td>
                <td>Rol</td>
                <td>Estat</td>
                <td> 
                    <a href="index.php?controller=Usuarios&action=crear"><button>Crear usuario</button></a>
                </td>
            </tr>
        <?php
    foreach($usuarios as $indice => $usuario) {
        $id = $usuario['ID_usuario'];
        echo "<tr>
            <td>{$usuario['ID_usuario']}</td>
            <td><img alt='foto usuario' src='{$usuario['Foto_usuario']}'></td>
            <td>{$usuario['Nombre']}</td>
            <td>{$usuario['Apellidos']}</td>
            <td>{$usuario['Correo_electronico']}</td>
            <td>{$usuario['Telefono']}</td>
            <td>{$usuario['Rol']}</td>
            <td>{$usuario['Estado']}</td>
            <td>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                    <a href="javascript:void(0);" onclick="mostrarPopup(<?php echo $id;?>)"><img src="images/borrarv2.png" alt=""></a>
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