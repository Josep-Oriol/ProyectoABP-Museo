<html>
<link rel="stylesheet" href="views/css/ficha.css">

</html>
<div class="ficha">
    <div class="resumenGeneral_obra">
        <div class="imagen_obra">
            <img src="" alt="">
        </div>
        <div class="resumen_obra">
            <ul>
                <li>Títol Obra</li>
                <li>Autor</li>
                <li>Data</li>
                <li>Nom Objecte</li>
            </ul>
        </div>
        <div class="imagen_eliminar_obra">
            <img src="images/basura.png" alt="">
        </div>
        <div class="descripcion_obra">
            <h2>Descripció</h2>
            <div class="campoDescripcion_obra">
            
            </div>
        </div>
    </div>

    <div class="datosObra">
        <table>
            <?php
                foreach($obras as $indice => $obra){
                    echo "
                        <tr>
                            <h4>Nº Registre</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Numero de registre</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Clasificació genèrica</h4>
                            <td>{$obra['Nombre_del_objeto']}</td>
                        </tr>
                        <tr>
                            <h4>Col·lecció de procedència</h4>
                            <td>{$obra['Coleccion_de_procedencia']}</td>
                            <h4>Material</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Tècnica</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Alçada màxima</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Amplada màxima</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Profunditat màxima</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Any inicial</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Any final</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Nombre d’exemplars</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Ubicació</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data inici ubicació</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data fi ubicació</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Comentari ubicació</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data de registre</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Valoració econòmica</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Forma d’ingrés</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data d’ingrés</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Font d’ingrés</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Baixa</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Causa de baixa</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data de baixa</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Persona autoritzada 
                                de la baixa</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Estat de conservació</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Lloc d’execució</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Lloc de procedència</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Nº Tiratge</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Altres números d’identificació</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Codi restauració</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data inici restauració</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data fi restauració</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Exposició</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data inici exposició</h4>
                            <td>{$obra['Numero_registro']}</td>
                            <h4>Data fi exposició</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        <tr>
                            <h4>Bibliografia</h4>
                            <td>{$obra['Numero_registro']}</td>
                        </tr>
                        ";
                }
            ?>
        </table>
    </div>
    <div class="boton_guardar">

    </div>
</div>