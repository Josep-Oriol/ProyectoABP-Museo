
<?php
    if(isset($_SESSION['Rol'])){ ?>
<div id = "general">
    <div>
        <h1>Exposicions</h1>
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
                <td>Descrpció</td>
                <td>Lloc exposició</td>
                <td>Tipus</td>
                <td>Data inici</td>
                <td>Data termini</td>
            
                <td> 
                    <a href="index.php?controller=Exposiciones&action=pantallaCrear"><button>Crear exposicion</button></a>
                </td>
            </tr>
        <?php
    foreach($exposiciones as $indice => $exposicion) {
        $id = $exposicion['id_exposicion'];
        echo "<tr>
            <td>{$exposicion['id_exposicion']}</td>
            <td>{$exposicion['texto_exposicion']}</td>
            <td>{$exposicion['lugar_exposicion']}</td>
            <td>{$exposicion['tipo_exposicion']}</td>
            <td>{$exposicion['fecha_inicio_exposicion']}</td>
            <td>{$exposicion['fecha_fin_exposicion']}</td>

            <td class='btn'>";
            if ($_SESSION['Rol'] == 'Administració') {
                ?>
                    <a href="index.php?controller=Exposiciones&action=Pantallaeditar&id=<?php echo $id;?>"><img src="images/editarv2.png" alt=""></a>
                    <a href="index.php?controller=Exposiciones&action=fichaExposiciones&id=<?php echo $id;?>"><img src="images/fichav2.png" alt=""></a>
                    <a id="<?php echo $id;?>"href="index.php?controller=Exposiciones&action=eliminar&id=<?php echo $id;?>"><img src="images/borrarv2.png" alt=""></a>
                <?php
            }
            else if ($_SESSION['Rol'] == 'Tècnic') {
                ?>
                    <a href=""><img src="images/editarv2.png" alt=""></a>
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

<div class="popup-overlay">
  <div class="popup-content">
    <div class="popup-header">
      <button class="close-btn">&times;</button>
    </div>
    
    <div class="popup-body">
      <form id="filter-from">
        <!-- Tipo de Exposición -->
        <div class="form-group">
          <label for="tipo_exposicion">Tipus d'exposició</label>
          <select id="tipo_exposicion" name="tipo_exposicion" class="form-control">
            <option value="">Tots els tipus</option>
            <option value="aliena">Aliena</option>
            <option value="propia">Pròpia</option>
          </select>
        </div>

        <!-- Lugar de Exposición -->
        <div class="form-group">
          <label for="lugar_exposicion">Lloc de l'exposició</label>
          <input type="text" id="lugar_exposicion" name="lugar_exposicion" class="form-control" placeholder="Introdueix el lloc">
        </div>

        <!-- Fechas de la exposición -->
        <div class="form-group">
          <label>Període de l'exposició</label>
          <div class="range-inputs">
            <div class="date-input">
              <label for="fecha_inicio">Data d'inici</label>
              <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
            </div>
            <div class="date-input">
              <label for="fecha_fin">Data de fi</label>
              <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
            </div>
          </div>
        </div>

        <!-- Botones -->
        <div class="button-group">
          <button type="reset" class="btn-reset">Netejar filtres</button>
          <button type="submit" class="btn-apply" id="btn-apply">Aplicar filtres</button>
        </div>
      </form>
    </div>
  </div>
</div>
