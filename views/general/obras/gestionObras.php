
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
      <form id="filter-from" action="#" method="POST">
        <!-- Camp (ara com select) -->
        <div class="form-group">
          <label for="campo">Camp</label>
          <select id="campo" name="campo" class="form-control">
            <option value="">Seleccioni un camp</option>
            <?php
                // Codi php pels camps de l'obra
            ?>
          </select>
        </div>

        <!-- Any inicial i final -->
        <div class="form-group">
          <label>Rang d'anys</label>
          <div class="range-inputs">
            <input type="number" id="anyo_inicial" name="anyo_inicial" placeholder="Any inicial">
            <input type="number" id="anyo_final" name="anyo_final" placeholder="Any final">
          </div>
        </div>

        <!-- Dimensions -->
        <div class="form-group">
          <label>Dimensions màximes (cm)</label>
          <div class="dimensions-inputs">
            <input type="number" id="maxima_altura_cm" name="maxima_altura_cm" placeholder="Alçada">
            <input type="number" id="maxima_anchura_cm" name="maxima_anchura_cm" placeholder="Amplada">
            <input type="number" id="maxima_profundidad_cm" name="maxima_profundidad_cm" placeholder="Profunditat">
          </div>
        </div>

        <!-- Nombre d'exemplars (reduït) -->
        <div class="form-group">
          <label for="numero_ejemplares">Nombre d'exemplars</label>
          <input type="number" id="numero_ejemplares" name="numero_ejemplares" class="small-input">
        </div>

        <!-- Valoració econòmica (amb selector de moneda) -->
        <div class="form-group">
          <label for="valoracion_economica">Valoració econòmica</label>
          <div class="currency-input">
            <input type="number" id="valoracion_economica" name="valoracion_economica" step="0.01" class="small-input">
            <select id="moneda" name="moneda" class="currency-select">
              <option value="EUR">EUR</option>
              <option value="USD">USD</option>
            </select>
          </div>
        </div>

        <!-- Dates -->
        <div class="form-group">
          <label for="fecha_registro">Data de registre</label>
          <input type="date" id="fecha_registro" name="fecha_registro">
        </div>

        <div class="form-group">
          <label for="fecha_ingreso">Data d'ingrés</label>
          <input type="date" id="fecha_ingreso" name="fecha_ingreso">
        </div>

        <!-- Ubicació (ara com select) -->
        <div class="form-group">
          <label for="ubicacion">Ubicació</label>
          <select id="ubicacion" name="ubicacion" class="form-control">
            <option value="">Seleccioni una ubicació</option>
            <?php
                // Codi php per les ubicacions
            ?>
          </select>
        </div>

        <!-- Botons -->
        <div class="button-group">
          <button type="reset" class="btn-reset">Netejar filtres</button>
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
