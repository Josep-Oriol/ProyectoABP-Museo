<?php
    if(isset($_SESSION['Rol'])){ ?>
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
                <td>Foto de perfil</td>
                <td>Usuari</td>
                <td>Nom</td>
                <td>Cognoms</td>
                <td>Correu electrònic</td>
                <td>Telèfon</td>
                <td>Rol</td>
                <td>Estat</td>
                <td> 
                    <a href="index.php?controller=Usuarios&action=crear"><button>Crear usuari</button></a>
                </td>
            </tr>
        <?php
    foreach($usuarios as $indice => $usuario) {
        $id = $usuario['id_usuario'];
        echo "<tr>
            <td><img alt='foto usuario' src='{$usuario['foto_usuario']}'></td>
            <td>{$usuario['usuario']}</td>
            <td>{$usuario['nombre']}</td>
            <td>{$usuario['apellidos']}</td>
            <td>{$usuario['correo_electronico']}</td>
            <td>{$usuario['telefono']}</td>
            <td>{$usuario['rol']}</td>
            <td>{$usuario['estado']}</td>
            <td>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Usuarios&action=eliminar&id=<?php echo $id;?>" class="iconoEliminar" id="<?php echo $id; ?>"><img src="images/borrarv2.png" alt="" ></a>
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