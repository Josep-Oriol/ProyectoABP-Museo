<?php
    if(isset($_SESSION['Rol'])) {
    ?>
    <section id="fichaObra">
        <div>
            <div>
                <h2>Dades Principals</h2>
                <div>
                    <div>
                        <div>
                            <label for="fotografia">Fotografia</label>
                            <img src="images/Usuarios/1729075332.jpg" alt="" id="fotografia">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="nom_obra">Títol</label>
                            <input type="text" id="nom_obra" value="<?php echo $obra['Titulo'];?>">
                        </div>
                        <div>
                            <label for="autor">Autor</label>
                            <input type="text" id="autor" value="<?php echo $obra['Autor'];?>">
                        </div>
                        <div>
                            <label for="data">Data</label>
                            <input type="text" id="data" value="<?php echo $obra['Anyo_final'];?>">
                        </div>
                        <div>
                            <div>
                                <a href=""><img src="images/download.png" alt="icono descargar"></a>
                            </div>
                            <?php
                            switch ($_SESSION['Rol']) {
                                case 'Administració':
                                    ?>
                                        <div>
                                            <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
                                        </div>
                                        <div>
                                            <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                        </div>
                                    <?php
                                    break;
                                case 'Tècnic':
                                    ?>
                                        <div>
                                            <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
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
                        <label for="num-registre">Nº de registre</label>
                        <input type="text" id="num-registre" readonly value="<?php echo $obra['Numero_registro'];?>">
                    </div>
                    <div>
                        <label for="data-registre">Data de registre</label>
                        <input type="text" id="data-registre" value="<?php echo $obra['Fecha_de_registro'];?>">
                    </div>
                    <div>
                        <label for="nom-museu">Nom del Museu</label>
                        <input type="text" id="nom-museu" value="<?php echo $obra['Nombre_museo'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Clasificació i Dimensions</h2>
                <div>
                    <div>
                        <label for="classificacio">Classificació genèrica</label>
                        <input type="text" id="classificacio" value="<?php echo $obra['Clasificacion_generica'];?>">
                    </div>
                    <div>
                        <label for="nom-objecte">Nom de l'objecte</label>
                        <input type="text" id="nom-objecte" value="<?php echo $obra['Nombre_del_objeto'];?>">
                    </div>
                    <div>
                        <label for="coleccio">Col·lecció de procedència</label>
                        <input type="text" id="coleccio" value="<?php echo $obra['Coleccion_de_procedencia'];?>">
                    </div>
                    <div>
                        <label for="mides-alçada">Mides màxima alçada (cm)</label>
                        <input type="number" id="mides-alçada" value="<?php echo $obra['Medidas_maxima_altura_cm'];?>">
                    </div>
                    <div>
                        <label for="mides-amplada">Mides màxima amplada (cm)</label>
                        <input type="number" id="mides-amplada" value="<?php echo $obra['Medidas_maxima_anchura_cm'];?>">
                    </div>
                    <div>
                        <label for="mides-profunditat">Mides màxima profunditat (cm)</label>
                        <input type="number" id="mides-profunditat" value="<?php echo $obra['Medidas_maxima_profundidad_cm'];?>">
                    </div>
                    <div>
                        <label for="material">Material</label>
                        <input type="text" id="material" value="<?php echo $obra['Material'];?>">
                    </div>
                    <div>
                        <label for="tecnica">Tècnica</label>
                        <input type="text" id="tecnica" value="<?php echo $obra['Tecnica'];?>">
                    </div>
                    <div>
                        <label for="estat_conservacio">Estat de conservació</label>
                        <input type="text" id="estat_conservacio" value="<?php echo $obra['Estado_de_conservacion'];?>">
                    </div>
                    <div>
                        <label for="nombre-exemplars">Nombre d'exemplars</label>
                        <input type="number" id="nombre-exemplars" value="<?php echo $obra['Numero_de_ejemplares'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Ubicació</h2>
                <div>
                    <div>
                        <label for="ubicacio">Ubicació</label>
                        <input type="text" id="ubicacio" value="<?php echo $obra['Descripcion_ubicacion'];?>">
                    </div>
                    <div>
                        <label for="data_inici_ubicacio">Data inici ubicació</label>
                        <input type="text" id="data_inici_ubicacio" value="<?php echo $obra['Fecha_inicio_ubicacion'];?>">
                    </div>
                    <div>
                        <label for="data_fi_ubicacio">Data fi ubicació</label>
                        <input type="text" id="data_fi_ubicacio" value="<?php echo $obra['Fecha_fin_ubicacion'];?>">
                    </div>
                    <div>
                        <label for="comentari_ubicacio">Comentari ubicació</label>
                        <input type="text" id="comentari_ubicacio" value="<?php echo $obra['Descripcion_ubicacion'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Ingrés</h2>
                <div>
                    <div>
                        <label for="forma_ingres">Forma d'ingrés</label>
                        <input type="text" id="forma_ingres" value="<?php echo $obra['Forma_de_ingreso'];?>">
                    </div>
                    <div>
                        <label for="data_ingres">Data d'ingrés</label>
                        <input type="text" id="data_ingres" value="<?php echo $obra['Fecha_de_ingreso'];?>">
                    </div>
                    <div>
                        <label for="font_ingres">Font d'ingrés</label>
                        <input type="text" id="font_ingres" value="<?php echo $obra['Fuente_de_ingreso'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Dates i llocs</h2>
                <div>
                    <div>
                        <label for="any-inicial">Any inicial</label>
                        <input type="text" id="any-inicial" value="<?php echo $obra['Anyo_inicial'];?>">
                    </div>
                    <div>
                        <label for="any-final">Any final</label>
                        <input type="text" id="any-final" value="<?php echo $obra['Anyo_final'];?>">
                    </div>
                    <div>
                        <label for="datacio">Datació</label>
                        <input type="text" id="datacio" value="<?php echo $obra['Datacion'];?>">
                    </div>
                    <div>
                        <label for="lloc-execucio">Lloc d'execució</label>
                        <input type="text" id="lloc-execucio" value="<?php echo $obra['Lugar_de_ejecucion'];?>">
                    </div>
                    <div>
                        <label for="lloc-procedencia">Lloc de procedència</label>
                        <input type="text" id="lloc-procedencia" value="<?php echo $obra['Lugar_de_procedencia'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Baixa</h2>
                <div>
                    <div>
                        <label for="baixa">Baixa</label>
                        <input type="text" id="baixa" value="<?php echo $obra['Baja'];?>">
                    </div>
                    <div>
                        <label for="causa_baixa">Causa baixa</label>
                        <input type="text" id="causa_baixa" value="<?php echo $obra['Causa_baja'];?>">
                    </div>
                    <div>
                        <label for="data_baixa">Data baixa</label>
                        <input type="text" id="data_baixa" value="<?php echo $obra['Fecha_baja'];?>">
                    </div>
                    <div>
                        <label for="persona-autoritzada">Persona autoritzada</label>
                        <input type="text" id="persona-autoritzada" value="<?php echo $obra['Usuario'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Identificació i Valoració</h2>
                <div>
                    <div>
                        <label for="num-tiratge">Nº Tiratge</label>
                        <input type="text" id="num-tiratge" value="<?php echo $obra['Numero_tiraje'];?>">
                    </div>
                    <div>
                        <label for="altres-numeros-id">Altres números d'identificació</label>
                        <input type="text" id="altres-numeros-id" value="<?php echo $obra['Otros_numeros_de_identificacion'];?>">
                    </div>
                    <div>
                        <label for="valoracio-economica">Valoració econòmica (€)</label>
                        <input type="number" id="valoracio-economica" value="<?php echo $obra['Valoracion_economica'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Exposició i Restauració</h2>
                <div>
                    <div>
                        <label for="exposicio">Exposició</label>
                        <input type="text" id="exposicio" value="<?php echo $obra['FK_id_exposicion'];?>">
                    </div>
                    <div>
                        <label for="data-inici-expo">Data inici expo.</label>
                        <input type="text" id="data-inici-expo" readonly value="<?php echo $obra['Fecha_inicio_exposicion'];?>">
                    </div>
                    <div>
                        <label for="data-fi-expo">Data fi expo.</label>
                        <input type="text" id="data-fi-expo" readonly  value="<?php echo $obra['Fecha_fin_exposicion'];?>">
                    </div>
                    <div>
                        <label for="codi-restauracio">Codi restauració</label>
                        <input type="text" id="codi-restauracio" value="<?php echo $obra['ID_restauracion'];?>">
                    </div>
                    <div>
                        <label for="data-inici-restauracio">Data inici restauració</label>
                        <input type="text" id="data-inici-restauracio" value="<?php echo $obra['Fecha_inicio_restauracion'];?>">
                    </div>
                    <div>
                        <label for="data-fi-restauracio">Data fi restauració</label>
                        <input type="text" id="data-fi-restauracio" value="<?php echo $obra['Fecha_fin_restauracion'];?>">
                    </div>
                </div>
            </div>

            <div>
                <h2>Informació Adicional</h2>
                <div>
                    <div>
                        <label for="descripcio">Descripció</label>
                        <textarea id="descripcio"><?php echo $obra['Descripcion_obra'];?></textarea>
                    </div>
                    <div>
                        <label for="bibliografia">Bibliografia</label>
                        <input type="text" id="bibliografia" value="<?php echo $obra['Bibliografia'];?>">
                    </div>
                    <div>
                        <label for="historia-objecte">Història de l'objecte</label>
                        <textarea id="historia-objecte"><?php echo $obra['Historia_del_objeto'];?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }