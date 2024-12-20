
<?php
    if(isset($_SESSION['Rol'])){ ?>
<section id="general">
  <div>
      <div>
        <h1>Restauracions</h1>
      </div>
      <div>
          <div id="exportarEstilo">
            <button id="exportarExcel">Exportar<img src="images/exportar.png" alt=""></button>
          </div>
          <div id="lupa">
              <img src="images/lupa.png" alt="" id="buscar">
              <input type="text" id="busqueda">
              <img src="images/ajustes_deslizadores.png" alt="" id="filtro">
          </div>
          <div id="paginacion">
            <select name="numeroResultados" id="numeroResultados">
              <option value="0-5">0-5</option>
              <option value="0-25" selected>0-25</option>
              <option value="0-50">0-50</option>
              <option value="0-100">0-100</option>
              <option value="0-500">0-500</option>
              <option value="tots">Tots</option>
            </select>
          </div>
          <div id="flechas">
              <img id="pag_atras"src="images/flecha_izquierda.png" alt="flecha izquierda">
              <img id="pag_delante" src="images/flecha_derecha.png" alt="flecha derecha">
          </div>
      </div>
  </div>
  <div>
    <table>
        <tr>
            <td>ID</td>
            <td>Comentari</td>
            <td>Nom restaurador</td>
            <td>Fecha inici</td>
            <td>Fecha termini</td>
            <td> 
                <a href="index.php?controller=Restauraciones&action=crearRestauracionPantalla"><button>Crear restauració</button></a>
            </td>
        </tr>
        <?php
        /*
        foreach($exposiciones as $indice => $exposicion) {
            $id = $exposicion['id_exposicion'];
            echo "<tr id=\"$id\">
                <td>{$exposicion['id_exposicion']}</td>
                <td>{$exposicion['texto_exposicion']}</td>
                <td>{$exposicion['lugar_exposicion']}</td>
                <td>{$exposicion['tipo_exposicion']}</td>
                <td>{$exposicion['fecha_inicio_exposicion']}</td>
                <td>{$exposicion['fecha_fin_exposicion']}</td>

                <td>";
                if ($_SESSION['Rol'] == 'Administració') {
                    ?>
                        <a href="index.php?controller=Exposiciones&action=Pantallaeditar&id=<?php echo $id;?>" title="Editar exposició"><img src="images/editarv2.png" alt=""></a>
                        <a href="index.php?controller=Exposiciones&action=fichaExposiciones&id=<?php echo $id;?>" title="Veure ficha"><img src="images/fichav2.png" alt=""></a>
                        <a id="<?php echo $id;?>" class="eliminarRegistro" title="Eliminar exposició"><img src="images/borrarv2.png" alt=""></a> 
                    <?php
                }
                else if ($_SESSION['Rol'] == 'Tècnic') {
                    ?>
                        <a href="index.php?controller=Exposiciones&action=Pantallaeditar&id=<?php echo $id;?>" title="Editar exposició"><img src="images/editarv2.png" alt=""></a>
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
        }*/
        ?>
    </table>
  </div>
</section>
<span class="noResultados">No se han encontrado resultados</span>
<span class="loader"></span>
<?php }
  else{
      echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
  }
?>

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
  
        
</div>