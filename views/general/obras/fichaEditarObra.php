<?php
if (isset($_SESSION['Rol'])) {
?>
    <section id="fichaObra">
        <form action="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>" enctype="multipart/form-data" method="POST" id="formEditarObra">
            <div>
                <div>
                    <h2>Dades Principals</h2>
                    <div>
                        <div>
                            <span>Fotografia</span>
                            <img src="<?php echo $obra['fotografia']; ?>" alt="fotografia obra">
                        </div>
                        <div>
                            <div>
                                <label for="titulo">Títol <span>*</span></label>
                                <input type="text" id="titulo" name="titulo" value="<?php echo $obra['titulo']; ?>" required>
                            </div>
                            <div>
                                <label for="autor">Autor <span>*</span></label>
                                <select name="autor" id="autor" required>
                                    <option value=""></option>
                                    <?php
                                    foreach ($camposLista['Autories'] as $indice => $campo) {
                                        if ($campo != $obra['autor']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        } else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="subirImagen">
                                <img src="images/subirArchivo.png" alt="subir archivo" title="Subir archivo">
                                <span>PNG/JPG/JPEG/WEBP</span>
                                <p id="nombreArchivo"></p>
                                <input type="file" name="fotografia" id="inputFotografia">
                            </div>
                            <div>
                                <?php
                                switch ($_SESSION['Rol']) {
                                    case 'Administració':
                                ?>      <div>
                                            <input type="image" src="images/guardar.png" alt="guardar cambios" title="Guardar canvis">
                                            <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>" title="Eliminar"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                        </div>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><button type="button">Descartar canvis</button></a>
                                    <?php
                                        break;
                                    case 'Tècnic':
                                    ?>
                                        <div>
                                            <input type="image" src="images/guardar.png" alt="guardar cambios">
                                        </div>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>" title="Editar"><button>Descartar canvis</button></a>
                                <?php
                                        break;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dades Generals</h2>
                    <div>
                        <div>
                            <label for="numero_registro">Nº de registre</label>
                            <input type="text" id="numero_registro" name="numero_registro" value="<?php echo $obra['numero_registro']; ?>" required disabled>
                        </div>
                        <div>
                            <label for="fecha_registro">Data de registre <span>*</span></label>
                            <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $obra['fecha_registro']; ?>" required>
                        </div>
                        <div>
                            <label for="nombre_museo">Nom del Museu <span>*</span></label>
                            <input type="text" id="nombre_museo" name="nombre_museo" value="<?php echo $obra['nombre_museo']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Clasificació i Dimensions</h2>
                    <div>
                        <div>
                            <label for="clasificacion_generica">Classificació genèrica <span>*</span></label>
                            <select name="clasificacion_generica" id="clasificacion_generica" required>
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Classificació genèrica'] as $indice => $campo) {
                                    if ($campo != $obra['clasificacion_generica']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="nombre_objeto">Nom de l'objecte <span>*</span></label>
                            <input type="text" id="nombre_objeto" name="nombre_objeto" value="<?php echo $obra['nombre_objeto']; ?>" required>
                        </div>
                        <div>
                            <label for="coleccion_procedencia">Col·lecció de procedència</label>
                            <select name="coleccion_procedencia" id="coleccion_procedencia">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Col·lecció de procedència'] as $indice => $campo) {
                                    if ($campo != $obra['coleccion_procedencia']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="maxima_altura_cm">Mides màxima alçada (cm)</label>
                            <input type="number" id="maxima_altura_cm" name="maxima_altura_cm" value="<?php echo $obra['maxima_altura_cm']; ?>">
                        </div>
                        <div>
                            <label for="maxima_anchura_cm">Mides màxima amplada (cm)</label>
                            <input type="number" id="maxima_anchura_cm" name="maxima_anchura_cm" value="<?php echo $obra['maxima_anchura_cm']; ?>">
                        </div>
                        <div>
                            <label for="maxima_profundidad_cm">Mides màxima profunditat (cm)</label>
                            <input type="number" id="maxima_profundidad_cm" name="maxima_profundidad_cm" value="<?php echo $obra['maxima_profundidad_cm']; ?>">
                        </div>
                        <div>
                            <label for="material">Material</label>
                            <select name="material" id="material">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Material'] as $indice => $campo) {
                                    if ($campo != $obra['material']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="tecnica">Tècnica</label>
                            <select name="tecnica" id="tecnica">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Tècnica'] as $indice => $campo) {
                                    if ($campo != $obra['tecnica']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="estado_conservacion">Estat de conservació</label>
                            <select name="estado_conservacion" id="estado_conservacion">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Estat de conservació'] as $indice => $campo) {
                                    if ($campo != $obra['estado_conservacion']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="numero_ejemplares">Nombre d'exemplars</label>
                            <input type="number" id="numero_ejemplares" name="numero_ejemplares" value="<?php echo $obra['numero_ejemplares']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ubicació</h2>
                    <div>
                        <div>
                            <label for="id_ubicacion">Ubicació <span>*</span></label>
                            <select name="id_ubicacion" id="id_ubicacion" required>
                                <option value=""></option>
                                <?php
                                foreach ($ubicaciones as $indice => $ubicacion) {
                                    if ($ubicacion['descripcion_ubicacion'] != $obra['descripcion_ubicacion']) {
                                        echo "<option value='{$ubicacion['id_ubicacion']}'>{$ubicacion['descripcion_ubicacion']}</option>";
                                    } else {
                                        echo "<option value='{$ubicacion['id_ubicacion']}' selected>{$ubicacion['descripcion_ubicacion']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="fecha_inicio_ubicacion">Data inici ubicació <span>*</span></label>
                            <input type="date" id="fecha_inicio_ubicacion" name="fecha_inicio_ubicacion" value="<?php echo $obra['fecha_inicio_ubicacion']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ingrés</h2>
                    <div>
                        <div>
                            <label for="forma_ingreso">Forma d'ingrés</label>
                            <select name="forma_ingreso" id="forma_ingreso">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista["Forma d'ingrés"] as $indice => $campo) {
                                    if ($campo != $obra['forma_ingreso']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="fecha_ingreso">Data d'ingrés <span>*</span></label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $obra['fecha_ingreso']; ?>" required>
                        </div>
                        <div>
                            <label for="fuente_ingreso">Font d'ingrés</label>
                            <input type="text" id="fuente_ingreso" name="fuente_ingreso" value="<?php echo $obra['fuente_ingreso']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dates i llocs</h2>
                    <div>
                        <div>
                            <label for="anyo_inicial">Any inicial <span>*</span></label>
                            <input type="text" id="anyo_inicial" name="anyo_inicial" value="<?php echo $obra['anyo_inicial']; ?>" required>
                        </div>
                        <div>
                            <label for="anyo_final">Any final <span>*</span></label>
                            <input type="text" id="anyo_final" name="anyo_final" value="<?php echo $obra['anyo_final']; ?>" required>
                        </div>
                        <div>
                            <label for="datacion">Datació <span>*</span></label>
                            <input type="text" id="datacion" name="datacion" value="<?php echo $obra['datacion']; ?>" required>
                        </div>
                        <div>
                            <label for="lugar_ejecucion">Lloc d'execució</label>
                            <input type="text" id="lugar_ejecucion" name="lugar_ejecucion" value="<?php echo $obra['lugar_ejecucion']; ?>">
                        </div>
                        <div>
                            <label for="lugar_procedencia">Lloc de procedència</label>
                            <input type="text" id="lugar_procedencia" name="lugar_procedencia" value="<?php echo $obra['lugar_procedencia']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Baixa</h2>
                    <div>
                        <div>
                            <label for="baja">Baixa</label>
                            <select name="baja" id="baja">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Baixa'] as $indice => $campo) {
                                    if ($campo != $obra['baja']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="causa_baja">Causa baixa</label>
                            <select name="causa_baja" id="causa_baja">
                                <option value=""></option>
                                <?php
                                foreach ($camposLista['Causa de baixa'] as $indice => $campo) {
                                    if ($campo != $obra['causa_baja']) {
                                        echo "<option value='$campo'>$campo</option>";
                                    } else {
                                        echo "<option value='$campo' selected>$campo</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="fecha_baja">Data baixa</label>
                            <input type="date" id="fecha_baja" name="fecha_baja" value="<?php echo $obra['fecha_baja']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Identificació i Valoració</h2>
                    <div>
                        <div>
                            <label for="numero_tiraje">Nº Tiratge</label>
                            <input type="text" id="numero_tiraje" name="numero_tiraje" value="<?php echo $obra['numero_tiraje']; ?>">
                        </div>
                        <div>
                            <label for="otros_numeros_identificacion">Altres números d'identificació</label>
                            <input type="text" id="otros_numeros_identificacion" name="otros_numeros_identificacion" value="<?php echo $obra['otros_numeros_identificacion']; ?>">
                        </div>
                        <div>
                            <label for="valoracion_economica">Valoració econòmica (€)</label>
                            <input type="number" id="valoracion_economica" name="valoracion_economica" value="<?php echo $obra['valoracion_economica']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Exposició i Restauració</h2>
                    <div>
                        <div>
                            <label for="id_exposicion">Exposició</label>
                            <select name="id_exposicion" id="id_exposicion">
                                <option value=""></option>
                                <?php
                                foreach ($exposiciones as $indice => $exposicion) {
                                    if ($exposicion['texto_exposicion'] != $obra['texto_exposicion']) {
                                        echo "<option value='{$exposicion['id_exposicion']}'>{$exposicion['texto_exposicion']}</option>";
                                    } else {
                                        echo "<option value='{$exposicion['id_exposicion']}' selected>{$exposicion['texto_exposicion']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="fecha_inicio_exposicion">Data inici exposició</label>
                            <input type="date" id="fecha_inicio_exposicion" name="fecha_inicio_exposicion" value="<?php echo $obra['fecha_inicio_exposicion']; ?>">
                        </div>
                        <div>
                            <label for="fecha_fin_exposicion">Data fi exposició</label>
                            <input type="date" id="fecha_fin_exposicion" name="fecha_fin_exposicion" value="<?php echo $obra['fecha_fin_exposicion']; ?>">
                        </div>
                        <div>
                            <label for="id_restauracion">Codi restauració</label>
                            <input type="text" id="id_restauracion" name="id_restauracion" value="<?php echo $obra['id_restauracion']; ?>">
                        </div>
                        <div>
                            <label for="fecha_inicio_restauracion">Data inici restauració</label>
                            <input type="date" id="fecha_inicio_restauracion" name="fecha_inicio_restauracion" value="<?php echo $obra['fecha_inicio_restauracion']; ?>">
                        </div>
                        <div>
                            <label for="fecha_fin_restauracion">Data fi restauració</label>
                            <input type="date" id="fecha_fin_restauracion" name="fecha_fin_restauracion" value="<?php echo $obra['fecha_fin_restauracion']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Informació Adicional</h2>
                    <div>
                        <div>
                            <label for="descripcion_obra">Descripció <span>*</span></label>
                            <textarea id="descripcion_obra" name="descripcion_obra" required><?php echo $obra['descripcion_obra']; ?></textarea>
                        </div>
                        <div>
                            <label for="bibliografia">Bibliografia</label>
                            <textarea name="bibliografia" id="bibliografia"><?php echo $obra['bibliografia']; ?></textarea>
                        </div>
                        <div>
                            <label for="historia_objeto">Història de l'objecte</label>
                            <textarea id="historia_objeto" name="historia_objeto"><?php echo $obra['historia_objeto']; ?></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </section>

<?php
} else {
    echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
}
