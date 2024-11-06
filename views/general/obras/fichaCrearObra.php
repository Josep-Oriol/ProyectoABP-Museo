<?php
if (isset($_SESSION['Rol'])) {
?>
    <form action="index.php?controller=Obras&action=crear" enctype="multipart/form-data" method="POST">
        <section id="fichaObra">
            <div>
                <h2>Dades Principals</h2>
                <div>
                    <div>
                        <div>
                            <label for="fotografia">Fotografia</label>
                            <input type="file" name="fotografia" id="fotografia">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="nom_obra">Títol</label>
                            <input type="text" id="nom_obra" name="nom_obra" required>
                        </div>
                        <div>
                            <label for="autor">Autor</label>
                            <input type="text" id="autor" name="autor" required>
                        </div>
                        <div>
                            <label for="data">Data</label>
                            <input type="text" id="data" name="data" required>
                        </div>
                        <div>
                            <input type="submit" value="Guardar">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dades Generals</h2>
                    <div>
                        <div>
                            <label for="num_registre">Nº de registre</label>
                            <input type="text" id="num_registre" name="num_registre" required>
                        </div>
                        <div>
                            <label for="data_registre">Data de registre</label>
                            <input type="date" id="data_registre" name="data_registre" required>
                        </div>
                        <div>
                            <label for="nom_museu">Nom del Museu</label>
                            <input type="text" id="nom_museu" name="nom_museu" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Clasificació i Dimensions</h2>
                    <div>
                        <div>
                            <label for="classificacio">Classificació genèrica</label>
                            <input type="text" id="classificacio" name="classificacio" required>
                        </div>
                        <div>
                            <label for="nom_objecte">Nom de l'objecte</label>
                            <input type="text" id="nom_objecte" name="nom_objecte" required>
                        </div>
                        <div>
                            <label for="coleccio">Col·lecció de procedència</label>
                            <input type="text" id="coleccio" name="coleccio" required>
                        </div>
                        <div>
                            <label for="mides_alçada">Mides màxima alçada (cm)</label>
                            <input type="number" id="mides_alçada" name="mides_alcada" required>
                        </div>
                        <div>
                            <label for="mides_amplada">Mides màxima amplada (cm)</label>
                            <input type="number" id="mides_amplada" name="mides_amplada" required>
                        </div>
                        <div>
                            <label for="mides_profunditat">Mides màxima profunditat (cm)</label>
                            <input type="number" id="mides_profunditat" name="mides_profunditat" required>
                        </div>
                        <div>
                            <label for="material">Material</label>
                            <input type="text" id="material" name="material" required>
                        </div>
                        <div>
                            <label for="tecnica">Tècnica</label>
                            <input type="text" id="tecnica" name="tecnica" required>
                        </div>
                        <div>
                            <label for="estat_conservacio">Estat de conservació</label>
                            <input type="text" id="estat_conservacio" name="estat_conservacio" required>
                        </div>
                        <div>
                            <label for="nombre_exemplars">Nombre d'exemplars</label>
                            <input type="number" id="nombre_exemplars" name="nombre_exemplars" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ubicació</h2>
                    <div>
                        <div>
                            <label for="ubicacio">Ubicació</label>
                            <input type="text" id="ubicacio" name="ubicacio">
                        </div>
                        <div>
                            <label for="data_inici_ubicacio">Data inici ubicació</label>
                            <input type="date" id="data_inici_ubicacio" name="data_inici_ubicacio">
                        </div>
                        <div>
                            <label for="data_fi_ubicacio">Data fi ubicació</label>
                            <input type="date" id="data_fi_ubicacio" name="data_fi_ubicacio">
                        </div>
                        <div>
                            <label for="comentari_ubicacio">Comentari ubicació</label>
                            <input type="text" id="comentari_ubicacio" name="comentari_ubicacio">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Ingrés</h2>
                    <div>
                        <div>
                            <label for="forma_ingres">Forma d'ingrés</label>
                            <input type="text" id="forma_ingres" name="forma_ingres" required>
                        </div>
                        <div>
                            <label for="data_ingres">Data d'ingrés</label>
                            <input type="date" id="data_ingres" name="data_ingres" required>
                        </div>
                        <div>
                            <label for="font_ingres">Font d'ingrés</label>
                            <input type="text" id="font_ingres" name="font_ingres" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Dates i llocs</h2>
                    <div>
                        <div>
                            <label for="any_inicial">Any inicial</label>
                            <input type="text" id="any_inicial" name="any_inicial" required>
                        </div>
                        <div>
                            <label for="any_final">Any final</label>
                            <input type="text" id="any_final" name="any_final" required>
                        </div>
                        <div>
                            <label for="datacio">Datació</label>
                            <input type="text" id="datacio" name="datacio" required>
                        </div>
                        <div>
                            <label for="lloc_execucio">Lloc d'execució</label>
                            <input type="text" id="lloc_execucio" name="lloc_execucio" required>
                        </div>
                        <div>
                            <label for="lloc_procedencia">Lloc de procedència</label>
                            <input type="text" id="lloc_procedencia" name="lloc_procedencia" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Baixa</h2>
                    <div>
                        <div>
                            <label for="baixa">Baixa</label>
                            <input type="text" id="baixa" name="baixa">
                        </div>
                        <div>
                            <label for="causa_baixa">Causa baixa</label>
                            <input type="text" id="causa_baixa" name="causa_baixa">
                        </div>
                        <div>
                            <label for="data_baixa">Data baixa</label>
                            <input type="date" id="data_baixa" name="data_baixa">
                        </div>
                        <div>
                            <label for="persona_autoritzada">Persona autoritzada</label>
                            <input type="text" id="persona_autoritzada" name="persona_autoritzada">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Identificació i Valoració</h2>
                    <div>
                        <div>
                            <label for="num_tiratge">Nº Tiratge</label>
                            <input type="text" id="num_tiratge" name="num_tiratge" required>
                        </div>
                        <div>
                            <label for="altres_numeros_id">Altres números d'identificació</label>
                            <input type="text" id="altres_numeros_id" name="altres_numeros_id">
                        </div>
                        <div>
                            <label for="valoracio_economica">Valoració econòmica (€)</label>
                            <input type="number" id="valoracio_economica" name="valoracio_economica" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Exposició i Restauració</h2>
                    <div>
                        <div>
                            <label for="exposicio">Exposició</label>
                            <input type="text" id="exposicio" name="exposicio">
                        </div>
                        <div>
                            <label for="data_inici_expo">Data inici expo.</label>
                            <input type="date" id="data_inici_expo" name="data_inici_expo">
                        </div>
                        <div>
                            <label for="data_fi_expo">Data fi expo.</label>
                            <input type="date" id="data_fi_expo" name="data_fi_expo">
                        </div>
                        <div>
                            <label for="codi_restauracio">Codi restauració</label>
                            <input type="text" id="codi_restauracio" name="codi_restauracio">
                        </div>
                        <div>
                            <label for="data_inici_restauracio">Data inici restauració</label>
                            <input type="date" id="data_inici_restauracio" name="data_inici_restauracio">
                        </div>
                        <div>
                            <label for="data_fi_restauracio">Data fi restauració</label>
                            <input type="date" id="data_fi_restauracio" name="data_fi_restauracio">
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Informació Adicional</h2>
                    <div>
                        <div>
                            <label for="descripcio">Descripció</label>
                            <textarea id="descripcio" name="descripcio" required></textarea>
                        </div>
                        <div>
                            <label for="bibliografia">Bibliografia</label>
                            <input type="text" id="bibliografia" name="bibliografia" required>
                        </div>
                        <div>
                            <label for="historia_objecte">Història de l'objecte</label>
                            <textarea id="historia_objecte" name="historia_objecte" required></textarea>
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
