
<?php
    if(isset($_SESSION['Rol'])){ ?>
<div id = "general">
    <div>
        <h1>Llistat Copias</h1>
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
                <td>ID</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Fecha</td>
                <td>Creador</td>
                <td> 
                    <a href="index.php?controller=Copias&action=crear"><button>Crear copia</button></a>
                </td>
            </tr>
        <?php
    foreach($copias as $indice => $copia) {
        $id = $copia['id_copia'];
        echo "<tr id=\"$id\">
            <td>{$copia['id_copia']}</td>
            <td>{$copia['nombre_copia']}</td>
            <td>{$copia['descripcion_copia']}</td>
            <td>{$copia['fecha_copia']}</td>
            <td>{$copia['usuario']}</td>

            <td>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>" title="Veure ficha"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=editar&id=<?php echo $id;?>" title="Editar obra"><img src="images/editarv2.png" alt=""></a>
                    <a id="<?php echo $id;?>" class="eliminarRegistro" title="Eliminar obra"><img src="images/borrarv2.png" alt=""></a>
            
                <?php
            }
            else if ($_SESSION['Rol'] == 'Tècnic') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>" title="Veure ficha"><img src="images/fichav2.png" alt=""></a>
                    <a href="index.php?controller=Obras&action=editar&id=<?php echo $id;?>" title="Editar obra"><img src="images/editarv2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Lector') {
                ?>
                    <a href="index.php?controller=Obras&action=mostrarFicha&id=<?php echo $id;?>" title="Veure ficha"><img src="images/fichav2.png" alt=""></a>
                <?php
            }
            echo "</td>";
        echo "</tr>";
    }
?>
        </table>
    </div>    
</div>

<div id="popupImagen" >
  <div id="vistaImagenAmpliada">
    <img src="" alt="">
  </div>
</div>

<div class="popup-overlay">
  <div class="popup-content">
    <div class="popup-header">
      <button class="close-btn">&times;</button>
    </div>

    <div class="popup-body">
      <form id="filter-form" action="#" method="POST">
        <!-- Sección AND -->
        <div class="form-group">
          <h3>Ha de ser</h3>
          <div id="and-filters" class="filters-section">
            <div class="filter-item">
              <label>Filtrar per:</label>
              <select name="and-campo[]" class="form-control" id="and-select-value">
                <!-- Opciones segun el form -->
              </select>
              <button type="button" class="btn-add-field" id="add-and-filter">Afegir</button>
            </div>
            <div id="and-filters-inputs">
            </div>
          </div>
        </div>

        <hr class="separator" />

        <div class="form-group">
          <h3>Pot ser</h3>
          <div id="or-filters" class="filters-section">
            <div class="filter-item">
              <label>Filtrar per:</label>
              <select name="or-campo[]" class="form-control" id="or-select-value">
                <!-- Opciones segun el form -->
              </select>
              <button type="button" class="btn-add-field" id="add-or-filter">Afegir</button>
            </div>
            <div id="or-filters-inputs">
            </div>
          </div>
        </div>

        <div class="button-group">
          <button type="reset" class="btn-reset" id="btn-reset">Netejar filtres</button>
          <button type="submit" class="btn-apply" id="btn-apply">Aplicar filtres</button>
        </div>
      </form>
    </div>
  </div>
</div>

   <?php }
    else{
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>
