<?php
if (isset($_SESSION['Rol'])) {
?>
    <section id="fichaObra">
        <div>
            <button id="btnFichaBasica">Fitxa bàsica</button>
            <button id="btnFichaCompleta">Fitxa completa</button>
        </div>
        <form action="" method="POST" id="fichaCompleta">
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
                                <label for="nom_obra">Títol</label>
                                <input type="text" id="nom_obra" value="<?php echo $obra['titulo']; ?>" disabled>
                            </div>
                            <div>
                                <label for="autor">Autor</label>
                                <input type="text" id="autor" value="<?php echo $obra['autor']; ?>" disabled>
                            </div>
                            <div>
                                <label for="data">Data</label>
                                <input type="text" id="data" value="<?php echo $obra['anyo_final']; ?>" disabled>
                            </div>
                            <div>
                                <a href="index.php?controller=Obras&action=generarPDF&id=<?php echo $id; ?>" title="Descarregar"><img src="images/download.png" alt="icono descargar"></a>
                                <?php
                                switch ($_SESSION['Rol']) {
                                    case 'Administració':
                                ?>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>" title="Editar"><img src="images/editarv2.png" alt="icono editar"></a>
                                        <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>" title="Eliminar"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                    <?php
                                        break;
                                    case 'Tècnic':
                                    ?>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>" title="Editar"><img src="images/editarv2.png" alt="icono editar"></a>
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
                            <label for="num-registre">Nº de registre</label>
                            <input type="text" id="num-registre" value="<?php echo $obra['numero_registro']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data-registre">Data de registre</label>
                            <input type="text" id="data-registre" value="<?php echo $obra['fecha_registro']; ?>" disabled>
                        </div>
                        <div>
                            <label for="nom-museu">Nom del Museu</label>
                            <input type="text" id="nom-museu" value="<?php echo $obra['nombre_museo']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Clasificació i Dimensions</h2>
                    <div>
                        <div>
                            <label for="classificacio">Classificació genèrica</label>
                            <input type="text" id="classificacio" value="<?php echo $obra['clasificacion_generica']; ?>" disabled>
                        </div>
                        <div>
                            <label for="nom-objecte">Nom de l'objecte</label>
                            <input type="text" id="nom-objecte" value="<?php echo $obra['nombre_objeto']; ?>" disabled>
                        </div>
                        <div>
                            <label for="coleccio">Col·lecció de procedència</label>
                            <input type="text" id="coleccio" value="<?php echo $obra['coleccion_procedencia']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-alçada">Mides màxima alçada (cm)</label>
                            <input type="number" id="mides-alçada" value="<?php echo $obra['maxima_altura_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-amplada">Mides màxima amplada (cm)</label>
                            <input type="number" id="mides-amplada" value="<?php echo $obra['maxima_anchura_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-profunditat">Mides màxima profunditat (cm)</label>
                            <input type="number" id="mides-profunditat" value="<?php echo $obra['maxima_profundidad_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="material">Material</label>
                            <input type="text" id="material" value="<?php echo $obra['material']; ?>" disabled>
                        </div>
                        <div>
                            <label for="tecnica">Tècnica</label>
                            <input type="text" id="tecnica" value="<?php echo $obra['tecnica']; ?>" disabled>
                        </div>
                        <div>
                            <label for="estat_conservacio">Estat de conservació</label>
                            <input type="text" id="estat_conservacio" value="<?php echo $obra['estado_conservacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="nombre-exemplars">Nombre d'exemplars</label>
                            <input type="number" id="nombre-exemplars" value="<?php echo $obra['numero_ejemplares']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ubicació</h2>
                    <div>
                        <div>
                            <label for="ubicacio">Ubicació</label>
                            <input type="text" id="ubicacio" value="<?php echo $obra['descripcion_ubicacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data_inici_ubicacio">Data inici ubicació</label>
                            <input type="text" id="data_inici_ubicacio" value="<?php echo $obra['fecha_inicio_ubicacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data_fi_ubicacio">Data fi ubicació</label>
                            <input type="text" id="data_fi_ubicacio" value="<?php echo $obra['fecha_fin_ubicacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="comentari_ubicacio">Comentari ubicació</label>
                            <input type="text" id="comentari_ubicacio" value="<?php echo $obra['comentario_ubicacion']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ingrés</h2>
                    <div>
                        <div>
                            <label for="forma_ingres">Forma d'ingrés</label>
                            <input type="text" id="forma_ingres" value="<?php echo $obra['forma_ingreso']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data_ingres">Data d'ingrés</label>
                            <input type="text" id="data_ingres" value="<?php echo $obra['fecha_ingreso']; ?>" disabled>
                        </div>
                        <div>
                            <label for="font_ingres">Font d'ingrés</label>
                            <input type="text" id="font_ingres" value="<?php echo $obra['fuente_ingreso']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dates i llocs</h2>
                    <div>
                        <div>
                            <label for="any-inicial">Any inicial</label>
                            <input type="text" id="any-inicial" value="<?php echo $obra['anyo_inicial']; ?>" disabled>
                        </div>
                        <div>
                            <label for="any-final">Any final</label>
                            <input type="text" id="any-final" value="<?php echo $obra['anyo_final']; ?>" disabled>
                        </div>
                        <div>
                            <label for="datacio">Datació</label>
                            <input type="text" id="datacio" value="<?php echo $obra['datacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="lloc-execucio">Lloc d'execució</label>
                            <input type="text" id="lloc-execucio" value="<?php echo $obra['lugar_ejecucion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="lloc-procedencia">Lloc de procedència</label>
                            <input type="text" id="lloc-procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Baixa</h2>
                    <div>
                        <div>
                            <label for="baixa">Baixa</label>
                            <input type="text" id="baixa" value="<?php echo $obra['baja']; ?>" disabled>
                        </div>
                        <div>
                            <label for="causa_baixa">Causa baixa</label>
                            <input type="text" id="causa_baixa" value="<?php echo $obra['causa_baja']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data_baixa">Data baixa</label>
                            <input type="text" id="data_baixa" value="<?php echo $obra['fecha_baja']; ?>" disabled> 
                        </div>
                        <div>
                            <label for="persona-autoritzada">Persona autoritzada</label>
                            <input type="text" id="persona-autoritzada" value="<?php echo $obra['usuario']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Identificació i Valoració</h2>
                    <div>
                        <div>
                            <label for="num-tiratge">Nº Tiratge</label>
                            <input type="text" id="num-tiratge" value="<?php echo $obra['numero_tiraje']; ?>" disabled>
                        </div>
                        <div>
                            <label for="altres-numeros-id">Altres números d'identificació</label>
                            <input type="text" id="altres-numeros-id" value="<?php echo $obra['otros_numeros_identificacion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="valoracio-economica">Valoració econòmica (€)</label>
                            <input type="number" id="valoracio-economica" value="<?php echo $obra['valoracion_economica']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Exposició i Restauració</h2>
                    <div>
                        <div>
                            <label for="exposicio">Exposició</label>
                            <input type="text" id="exposicio" value="<?php $valor = (isset($obra['texto_exposicion'])) ? $obra['texto_exposicion'] : "Indefinida";
                                                                        echo $valor ?>" disabled>
                        </div>
                        <div>
                            <label for="data-inici-expo">Data inici expo.</label>
                            <input type="text" id="data-inici-expo" value="<?php $valor = (isset($obra['fecha_inicio_exposicion'])) ? $obra['fecha_inicio_exposicion'] : "Indefinida";
                                                                                    echo $valor ?>" disabled>
                        </div>
                        <div>
                            <label for="data-fi-expo">Data fi expo.</label>
                            <input type="text" id="data-fi-expo" value="<?php $valor = (isset($obra['fecha_fin_exposicion'])) ? $obra['fecha_fin_exposicion'] : "Indefinida";
                                                                                    echo $valor ?>" disabled>
                        </div>
                        <div>
                            <label for="codi-restauracio">Codi restauració</label>
                            <input type="text" id="codi-restauracio" value="<?php echo $obra['id_restauracion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data-inici-restauracio">Data inici restauració</label>
                            <input type="text" id="data-inici-restauracio" value="<?php echo $obra['fecha_inicio_restauracion']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data-fi-restauracio">Data fi restauració</label>
                            <input type="text" id="data-fi-restauracio" value="<?php echo $obra['fecha_fin_restauracion']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="historial_obras_ubicaciones">
                    <h2>Historial d'ubicacions</h2>
                    <div>
                        <table>
                            <tr>
                                <th>Ubicació</th>
                                <th>Data inici</th>
                                <th>Data fi</th>
                            </tr>
                            
                            <?php
                                foreach($historialUbicaciones as $ubicacion) {
                                    echo "<tr>
                                        <td>{$ubicacion['nombre_ubicacion']}</td>
                                        <td>{$ubicacion['fecha_inicio']}</td>
                                        <td>{$ubicacion['fecha_fin']}</td>
                                    </tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>

                <div>
                    <h2>Informació Adicional</h2>
                    <div>
                        <div>
                            <label for="descripcio">Descripció</label>
                            <textarea  disabled id="descripcio"><?php echo $obra['descripcion_obra']; ?></textarea>
                        </div>
                        <div>
                            <label for="bibliografia">Bibliografia</label>
                            <textarea  disabled name="bibliografia" id="bibliografia"><?php echo $obra['bibliografia']; ?></textarea>
                        </div>
                        <div>
                            <label for="historia-objecte">Història de l'objecte</label>
                            <textarea disabled id="historia-objecte"><?php echo $obra['historia_objeto']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="" method="POST" id="fichaBasica">
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
                                <label for="num-registre">Nº de registre</label>
                                <input type="text" id="num-registre" value="<?php echo $obra['numero_registro']; ?>" disabled>
                            </div>
                            <div>
                                <label for="nom_obra">Títol</label>
                                <input type="text" id="nom_obra" value="<?php echo $obra['titulo']; ?>" disabled>
                            </div>
                            <div>
                                <label for="autor">Autor</label>
                                <input type="text" id="autor" value="<?php echo $obra['autor']; ?>" disabled>
                            </div>
                            <div>
                                <label for="data">Datació</label>
                                <input type="text" id="data" value="<?php echo $obra['datacion']; ?>" disabled>
                            </div>
                            <div>
                                <a href="index.php?controller=Obras&action=generarPdfBasica&id=<?php echo $id; ?>"><img src="images/download.png" alt="icono descargar"></a>
                                <a href="index.php?controller=Obras&action=generarWord&id=<?php echo $id; ?>"><img src="images/wordIcon.png" alt="icono descargar"></a>

                                <?php
                                switch ($_SESSION['Rol']) {
                                    case 'Administració':
                                ?>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
                                        <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                    <?php
                                        break;
                                    case 'Tècnic':
                                    ?>
                                        <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
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
                            <label for="data-registre">Data de registre</label>
                            <input type="text" id="data-registre" value="<?php echo $obra['fecha_registro']; ?>" disabled>
                        </div>
                        <div>
                            <label for="lloc-procedencia">Lloc de procedència</label>
                            <input type="text" id="lloc-procedencia" value="<?php echo $obra['lugar_procedencia']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Clasificació i Dimensions</h2>
                    <div>
                        <div>
                            <label for="nom-objecte">Nom de l'objecte</label>
                            <input type="text" id="nom-objecte" value="<?php echo $obra['nombre_objeto']; ?>" disabled>
                        </div>
                        <div>
                            <label for="classificacio">Classificació genèrica</label>
                            <input type="text" id="classificacio" value="<?php echo $obra['clasificacion_generica']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-alçada">Mides màxima alçada (cm)</label>
                            <input type="number" id="mides-alçada" value="<?php echo $obra['maxima_altura_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-amplada">Mides màxima amplada (cm)</label>
                            <input type="number" id="mides-amplada" value="<?php echo $obra['maxima_anchura_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="mides-profunditat">Mides màxima profunditat (cm)</label>
                            <input type="number" id="mides-profunditat" value="<?php echo $obra['maxima_profundidad_cm']; ?>" disabled>
                        </div>
                        <div>
                            <label for="material">Material</label>
                            <input type="text" id="material" value="<?php echo $obra['material']; ?>" disabled>
                        </div>
                        <div>
                            <label for="estat_conservacio">Estat de conservació</label>
                            <input type="text" id="estat_conservacio" value="<?php echo $obra['estado_conservacion']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ingrés</h2>
                    <div>
                        <div>
                            <label for="forma_ingres">Forma d'ingrés</label>
                            <input type="text" id="forma_ingres" value="<?php echo $obra['forma_ingreso']; ?>" disabled>
                        </div>
                        <div>
                            <label for="data_ingres">Data d'ingrés</label>
                            <input type="text" id="data_ingres" value="<?php echo $obra['fecha_ingreso']; ?>" disabled>
                        </div>
                        <div>
                            <label for="font_ingres">Font d'ingrés</label>
                            <input type="text" id="font_ingres" value="<?php echo $obra['fuente_ingreso']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Informació adicional</h2>
                    <div>
                        <div>
                            <label for="valoracio-economica">Valoració econòmica (€)</label>
                            <input type="number" id="valoracio-economica" value="<?php echo $obra['valoracion_economica']; ?>" disabled>
                        </div>
                        <div>
                            <label for="usuario_registro">Usuari que registra</label>
                            <input type="text" id="usuario_registro" value="" disabled>
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
