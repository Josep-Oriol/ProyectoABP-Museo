<?php
if (isset($_SESSION['Rol'])) {
?>
    <form action="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>" enctype="multipart/form-data" method="POST">
        <section id="fichaObra">
            <div>
                <div>
                    <h2>Dades Principals</h2>
                    <div>
                        <div>
                            <div>
                                <label for="fotografia">Fotografia</label>
                                <img src="images/usuarios/1729075332.jpg" alt="fotografia obra">
                                <input type="file" name="fotografia" id="fotografia">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="nom_obra">Nom Obra</label>
                                <input type="text" id="nom_obra" name="nom_obra" value="<?php echo $obra['titulo']; ?>" required>
                            </div>
                            <div>
                                <label for="autor">Autor</label>
                                <select name="autor" id="autor" required>
                                    <option value=""></option>
                                <?php
                                    foreach ($camposLista['Autories'] as $indice => $campo) {
                                        if ($campo != $obra['autor']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div>
                                <label for="data">Data</label>
                                <input type="date" id="data" name="data" value="<?php echo $obra['anyo_final']; ?>" required>
                            </div>
                            <div>
                                <?php
                                switch ($_SESSION['Rol']) {
                                    case 'Administració':
                                ?>
                                        <div>
                                            <input type="image" src="images/guardar.png" alt="guardar cambios">
                                        </div>
                                        <div>
                                            <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                        </div>
                                    <?php
                                        break;
                                    case 'Tècnic':
                                    ?>
                                        <div>
                                            <input type="image" src="images/guardar.png" alt="guardar cambios">
                                        </div>
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
                            <label for="num_registre">Nº de registre</label>
                            <input type="text" id="num_registre" name="num_registre" value="<?php echo $obra['numero_registro']; ?>" required>
                        </div>
                        <div>
                            <label for="data_registre">Data de registre</label>
                            <input type="date" id="data_registre" name="data_registre" value="<?php echo $obra['fecha_registro']; ?>" required>
                        </div>
                        <div>
                            <label for="nom_museu">Nom del Museu</label>
                            <input type="text" id="nom_museu" name="nom_museu" value="<?php echo $obra['nombre_museo']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Clasificació i Dimensions</h2>
                    <div>
                        <div>
                            <label for="classificacio_generica">Classificació genèrica</label>
                            <select name="classificacio_generica" id="classificacio_generica" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Classificació genèrica'] as $indice => $campo) {
                                        if ($campo != $obra['clasificacion_generica']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="nom_objecte">Nom de l'objecte</label>
                            <input type="text" id="nom_objecte" name="nom_objecte" value="<?php echo $obra['nombre_objeto']; ?>" required>
                        </div>
                        <div>
                            <label for="coleccio_procedencia">Col·lecció de procedència</label>
                            <select name="coleccio_procedencia" id="coleccio_procedencia" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Col·lecció de procedència'] as $indice => $campo) {
                                        if ($campo != $obra['coleccion_procedencia']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="mides_alçada">Mides màxima alçada (cm)</label>
                            <input type="number" id="mides_alçada" name="mides_alçada" value="<?php echo $obra['maxima_altura_cm']; ?>" required>
                        </div>
                        <div>
                            <label for="mides_amplada">Mides màxima amplada (cm)</label>
                            <input type="number" id="mides_amplada" name="mides_amplada" value="<?php echo $obra['maxima_anchura_cm']; ?>" required>
                        </div>
                        <div>
                            <label for="mides_profunditat">Mides màxima profunditat (cm)</label>
                            <input type="number" id="mides_profunditat" name="mides_profunditat" value="<?php echo $obra['maxima_profundidad_cm']; ?>" required>
                        </div>
                        <div>
                            <label for="material">Material</label>
                            <select name="material" id="material" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Material'] as $indice => $campo) {
                                        if ($campo != $obra['material']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="tecnica">Tècnica</label>
                            <select name="tecnica" id="tecnica" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Tècnica'] as $indice => $campo) {
                                        if ($campo != $obra['tecnica']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="estat_conservacio">Estat de conservació</label>
                            <select name="estat_conservacio" id="estat_conservacio" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Estat de conservació'] as $indice => $campo) {
                                        if ($campo != $obra['estado_conservacion']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="nombre_exemplars">Nombre d'exemplars</label>
                            <input type="number" id="nombre_exemplars" name="nombre_exemplars" value="<?php echo $obra['numero_ejemplares']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ubicació</h2>
                    <div>
                        <div>
                            <label for="ubicacio">Ubicació</label>
                            <input type="text" id="ubicacio" name="ubicacio" value="<?php echo $obra['descripcion_ubicacion']; ?>">
                        </div>
                        <div>
                            <label for="data_inici_ubicacio">Data inici ubicació</label>
                            <input type="date" id="data_inici_ubicacio" name="data_inici_ubicacio" value="<?php echo $obra['fecha_inicio_ubicacion']; ?>">
                        </div>
                        <div>
                            <label for="data_fi_ubicacio">Data fi ubicació</label>
                            <input type="date" id="data_fi_ubicacio" name="data_fi_ubicacio" value="<?php echo $obra['fecha_fin_ubicacion']; ?>">
                        </div>
                        <div>
                            <label for="comentari_ubicacio">Comentari ubicació</label>
                            <input type="text" id="comentari_ubicacio" name="comentari_ubicacio" value="<?php echo $obra['descripcion_ubicacion']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ingrés</h2>
                    <div>
                        <div>
                            <label for="forma_ingres">Forma d'ingrés</label>
                            <select name="forma_ingres" id="forma_ingres" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista["Forma d'ingrés"] as $indice => $campo) {
                                        if ($campo != $obra['forma_ingreso']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="data_ingres">Data d'ingrés</label>
                            <input type="date" id="data_ingres" name="data_ingres" value="<?php echo $obra['fecha_ingreso']; ?>" required>
                        </div>
                        <div>
                            <label for="font_ingres">Font d'ingrés</label>
                            <input type="text" id="font_ingres" name="font_ingres" value="<?php echo $obra['fuente_ingreso']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dates i llocs</h2>
                    <div>
                        <div>
                            <label for="any_inicial">Any inicial</label>
                            <input type="text" id="any_inicial" name="any_inicial" value="<?php echo $obra['anyo_inicial']; ?>" required>
                        </div>
                        <div>
                            <label for="any_final">Any final</label>
                            <input type="text" id="any_final" name="any_final" value="<?php echo $obra['anyo_final']; ?>" required>
                        </div>
                        <div>
                            <label for="datacio">Datació</label>
                            <input type="text" id="datacio" name="datacio" value="<?php echo $obra['datacion']; ?>" required>
                        </div>
                        <div>
                            <label for="lloc_execucio">Lloc d'execució</label>
                            <input type="text" id="lloc_execucio" name="lloc_execucio" value="<?php echo $obra['lugar_ejecucion']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Baixa</h2>
                    <div>
                        <div>
                            <label for="baixa">Baixa</label>
                            <select name="baixa" id="baixa" required>
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Baixa'] as $indice => $campo) {
                                        if ($campo != $obra['baja']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="causa_baixa">Causa baixa</label>
                            <select name="causa_baixa" id="causa_baixa">
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Causa de baixa'] as $indice => $campo) {
                                        if ($campo != $obra['causa_baja']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="data_baixa">Data baixa</label>
                            <input type="date" id="data_baixa" name="data_baixa" value="<?php echo $obra['fecha_baja']; ?>">
                        </div>
                        <div>
                            <label for="persona_autoritzada">Persona autoritzada</label>
                            <input type="text" id="persona_autoritzada" name="persona_autoritzada" value="<?php echo $obra['usuario']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Identificació i Valoració</h2>
                    <div>
                        <div>
                            <label for="num_tiratge">Nº Tiratge</label>
                            <input type="text" id="num_tiratge" name="num_tiratge" value="<?php echo $obra['numero_tiraje']; ?>" required>
                        </div>
                        <div>
                            <label for="altres_numeros_id">Altres números d'identificació</label>
                            <input type="text" id="altres_numeros_id" name="altres_numeros_id" value="<?php echo $obra['otros_numeros_identificacion']; ?>">
                        </div>
                        <div>
                            <label for="valoracio_economica">Valoració econòmica (€)</label>
                            <input type="number" id="valoracio_economica" name="valoracio_economica" value="<?php echo $obra['valoracion_economica']; ?>" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Exposició i Restauració</h2>
                    <div>
                        <div>
                            <label for="tipus_exposicio">Exposició</label>
                            <select name="tipus_exposicio" id="tipus_exposicio">
                                <option value=""></option>
                                <?php
                                    foreach ($camposLista['Tipus exposició'] as $indice => $campo) {
                                        if ($campo != $obra['tipo_exposicion']) {
                                            echo "<option value='$campo'>$campo</option>";
                                        }
                                        else {
                                            echo "<option value='$campo' selected>$campo</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="data_inici_expo">Data inici expo.</label>
                            <input type="date" id="data_inici_expo" name="data_inici_expo" value="<?php $valor = (isset($obra['fecha_inicio_exposicion'])) ? $obra['fecha_inicio_exposicion'] : ""; echo $valor?>">
                        </div>
                        <div>
                            <label for="data_fi_expo">Data fi expo.</label>
                            <input type="date" id="data_fi_expo" name="data_fi_expo" value="<?php $valor = (isset($obra['fecha_fin_exposicion'])) ? $obra['fecha_fin_exposicion'] : ""; echo $valor?>">
                        </div>
                        <div>
                            <label for="codi_restauracio">Codi restauració</label>
                            <input type="text" id="codi_restauracio" name="codi_restauracio" value="<?php echo $obra['id_restauracion']; ?>">
                        </div>
                        <div>
                            <label for="data_inici_restauracio">Data inici restauració</label>
                            <input type="date" id="data_inici_restauracio" name="data_inici_restauracio" value="<?php echo $obra['fecha_inicio_restauracion']; ?>">
                        </div>
                        <div>
                            <label for="data_fi_restauracio">Data fi restauració</label>
                            <input type="date" id="data_fi_restauracio" name="data_fi_restauracio" value="<?php echo $obra['fecha_fin_restauracion']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Informació Adicional</h2>
                    <div>
                        <div>
                            <label for="descripcio">Descripció</label>
                            <textarea id="descripcio" name="descripcio" required><?php echo $obra['descripcion_obra']; ?></textarea>
                        </div>
                        <div>
                            <label for="bibliografia">Bibliografia</label>
                            <input type="text" id="bibliografia" name="bibliografia" value="<?php echo $obra['bibliografia']; ?>" required>
                        </div>
                        <div>
                            <label for="historia_objecte">Història de l'objecte</label>
                            <textarea id="historia_objecte" name="historia_objecte" required><?php echo $obra['historia_objeto']; ?></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </form>
<?php
} else {
    echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
}
