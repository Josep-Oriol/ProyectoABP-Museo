<?php
    if(isset($_SESSION['Rol'])){

    ?>
    <div id="fichaUbicaciones">
        <div>
            <h2>Ubicacions</h2>
        </div>
        <div>
            <?php foreach ($campos[0] as $ubicacion):// Solo las ubicaciones sin padre?>
                
                <div class="inputsDiv">
                    <button class="mostrarHijos" onclick="ejecutarFuncionesMostrar(<?= $ubicacion['id_ubicacion'] ?>, this)"><img src="images/flecha_derecha.png" alt=""></button> <!-- cuando pulsas ejecutas el script mostrarHijos y le pasas 
                    la id_ubicacion del padre del cual quieres ver sus hijos -->
                    <input type='text' name='<?= $ubicacion['id_padre'] ?>' id='<?= $ubicacion['id_ubicacion'] ?>' value='<?= $ubicacion['descripcion_ubicacion'] ?>' />
                    <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
                        <input type="hidden" name="ID_ubicacion" value="<?= $ubicacion['id_ubicacion'] ?>">
                        <button type="submit">+</button> <!-- Boton para añadir una ubicacion -->
                    </form>
                </div>
                <div id='hijos-<?= $ubicacion['id_ubicacion'] ?>' style='display:none; padding-left: 5vw'></div> <!-- div donde se almacenan los hijos de cada 
                padre, este div por defecto se oculta -->
            
            <?php endforeach; ?>
        </div>
        <form action="index.php?controller=Vocabularios&action=crearUbicacion" method="POST">
            <input type="text" name="crear" id="crear" placeholder="+ Crear nova ubicació" required>
            <input type="submit" value="Crear">
        </form>
        <div>
            <button>Guardar</button>
            <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones"><button>Descartar cambios</button></a>
        </div>

        <?php
        }
        else {
            echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
        }
        ?>
    </div>

