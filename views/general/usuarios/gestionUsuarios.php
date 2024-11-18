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
                <button id="filtro">
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
                <td>ID</td>
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
            <td>{$usuario['id_usuario']}</td>
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

<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Editor JavaScript online - www.cubicfactory.com</title>
</head>
<body>
<div class="popup-overlay">
  <div class="popup-content">
    <div class="popup-header">
      <button class="close-btn">&times;</button>
    </div>
    
    <div class="popup-body">
      <form id="filter-from" action="#" method="POST">
        <!-- Camp (ara com select) -->
        <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" class="form-control" required>
                <option value="Lector">Lector</option>
                <option value="Tècnic">Tècnic</option>
                <option value="Administració">Administració</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="form-control" required>
                <option value="Actiu">Actiu</option>
                <option value="Inactiu">Inactiu</option>
            </select>
        </div>

        <!-- Botons -->
        <div class="button-group">
          <button type="reset" class="btn-reset">Netejar filtres</button>
          <button id="test">test</button>
          <button type="submit" class="btn-apply" id="btn-apply">Aplicar filtres</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>