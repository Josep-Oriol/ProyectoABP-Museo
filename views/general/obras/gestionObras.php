
<?php
    if(isset($_SESSION['Rol'])){ ?>
<section id="general">
  <div>
      <div>
          <h1>Llistat d'obres</h1>
      </div>
      <div>
          <div>
            <button id="exportarExcel">Exportar<img src="images/exportar.png" alt=""></button>
          </div>
          <div>
              <img src="images/lupa.png" alt="" id="buscar">
              <input type="text" id="busqueda">
              <img src="images/ajustes_deslizadores.png" alt="" id="filtro">
          </div>
          <div>
              <select name="numeroResultados" id="numeroResultados">
                <option value="0-25">0-25</option>
                <option value="25-50">25-50</option>
                <option value="50-100">50-100</option>
                <option value="100-500">100-500</option>
                <option value="tots">Tots</option>
              </select>
          </div>
          <div>
              <img src="images/flecha_izquierda.png" alt="flecha izquierda">
              <img src="images/flecha_derecha.png" alt="flecha derecha">
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
      /*
      foreach($obras as $indice => $obra) {
          $id = $obra['numero_registro'];
          echo "<tr id=\"$id\">
              <td><img src='{$obra['fotografia']}' alt='fotografia obra {$obra['titulo']}' class='fotografiaObjeto'></td>
              <td>{$obra['numero_registro']}</td>
              <td>{$obra['nombre_objeto']}</td>
              <td>{$obra['titulo']}</td>
              <td>{$obra['autor']}</td>
              <td>{$obra['anyo_final']}</td>
              <td>{$obra['descripcion_ubicacion']}</td>

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
      }*/
      ?>
    </table>
  </div>    
  
</section>
<span class="noResultados">No se han encontrado resultados</span>
<span class="loader"></span>

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
