<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div id="fichaUbicaciones">
        <div>
            <h2>Ubicacions</h2>
            <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
                <input type="hidden" name="crear" id="crear">
                <input type="submit" value="Crear ubicació pare" class="btn">
            </form>
        </div>
        <div>
            <?php foreach ($campos[0] as $ubicacion): // Solo las ubicaciones sin padre ?>
                <div class="inputsDiv">
                    <button class="mostrarHijos" onclick="ejecutarFuncionesMostrar(<?= $ubicacion['id_ubicacion'] ?>, this)"><img src="images/flecha_derecha.png" alt=""></button> <!-- cuando pulsas ejecutas el script mostrarHijos y le pasas 
                    la id_ubicacion del padre del cual quieres ver sus hijos -->
                    <input type='text' name='<?= $ubicacion['id_padre'] ?>' id='<?= $ubicacion['id_ubicacion'] ?>' value='<?= $ubicacion['descripcion_ubicacion'] ?>' />
                    
                    <button onclick="eliminarHijos(<?= $ubicacion['id_ubicacion'] ?>)"><img class="eliminarUbi" src="images/basura.png"></button>
                    
                    <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
                        <input type="hidden" name="id_ubicacion" value="<?= $ubicacion['id_ubicacion'] ?>">
                        <button type="submit" title="Afegir ubicació"><img src="images/mas.png"></button> <!-- Boton para añadir una ubicacion -->
                    </form>

                    <img class="historial" src="images/history.png" id="<?= $ubicacion['id_ubicacion']?>" alt="history"> 
                    
                </div>
                <div class="divHistorial" id="div_<?= $ubicacion['id_ubicacion']?>"></div>
                <div id='hijos-<?= $ubicacion['id_ubicacion'] ?>' style='display:none; padding-left: 5vw'></div> <!-- div donde se almacenan los hijos de cada 
                padre, este div por defecto se oculta -->
            
            <?php endforeach; ?>
        </div>
        <div>
           
        </div>

<div class="overlay-ubicaciones">
    <div class="ubicaciones-content">
        <div class="popup-header">
            <button class="close-btn">&times;</button>
        </div>
        <div class="btns">
            <button id="past">Pasadas</button>
            <button id="current">Actuales</button>
        </div>
        <div class="content">
            <table id="table-ubicaciones">
                <thead class="thead">
                    <tr>
                        <th>Títol</th>
                        <th>Ubicació</th>
                        <th>Inici</th>
                        <th>Fin</th>
                    </tr>
                </thead>
                <tbody class="tbody"></tbody>
            </table>
        </div>
    </div>
</div>


        <?php
        }
        else {
            echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
        }
        ?>
    </div>

