
<?php
    if(isset($_SESSION['Rol'])){ ?>
<div id = "general">
  <div>
    <div>
        <h1>Copies de seguretat</h1>
    </div>
    <div>
        <div id="subirImagen">
          <form id="formSQL" action="index.php?controller=Copias&action=importarCopia" method="POST" enctype="multipart/form-data"  >
            <p>Seleccionar fichero</p>
            <input type="file" name="fichero_sql" id="inputFotografia" class="popupSQL">
          </form>
        </div>
        <div>
            <img src="images/lupa.png" alt="" id="buscar">
            <input type="text" id="busqueda">
            <img src="images/ajustes_deslizadores.png" alt="" id="filtro">
        </div>
        <div>
          <select name="numeroResultados" id="numeroResultados">
            <option value="0-5">0-5</option>
            <option value="0-25" selected>0-25</option>
            <option value="0-50">0-50</option>
            <option value="0-100">0-100</option>
            <option value="0-500">0-500</option>
            <option value="tots">Tots</option>
          </select>
        </div>
        <div>
          <img id="pag_atras"src="images/flecha_izquierda.png" alt="flecha izquierda">
          <img id="pag_delante" src="images/flecha_derecha.png" alt="flecha derecha">
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
      
      </table>
  </div>    
</div>
<span class="noResultados">No se han encontrado resultados</span>
<span class="loader"></span>

<div id="popupSQL">
  <div id="contenidoPopupSQL">
    <img src="images/alertIcon.png" alt="" id="imagenSQL">
    <p>Confirmar elimininació</p>
    <div>
      <button id="btnConfirmarSQL" class="confirmar">Confirmar</button>
      <button id="btnCancelarSQL" class="cancelar">Cancelar</button>
    </div>
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
