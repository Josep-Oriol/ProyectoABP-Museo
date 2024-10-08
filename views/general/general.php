
<div id="general">
    <div>
        <div>
            <h1>Llistat d'obres</h1>
        </div>
        <div>
            <div>
                <img class="img_lupa" src="images/lupa.png" alt="">
                <input type="text">
                <img class="img_ajustes" src="images/ajustes_deslizadores.png" alt="">
            </div>
        </div>
        <div class="obras_visibles_desplegable">
            <div>0-50</div>
            <img class="flecha_abajo" src="images/flecha_abajo.png" alt="">
        </div>
        <div>
            <img src="images/flecha_izquierda.png" alt="">
            <img src="images/flecha_derecha.png" alt="">
        </div>
    </div>
    <div>
        <table>
            <tr>
                <td>Imatge</td>
                <td>NºRegistre</td>
                <td>Nom</td>
                <td>Títol</td>
                <td>Autor</td>
                <td>Datació</td>
                <td>Ubicació</td>
                <td> 

                    <form action="" method="POST">
                        <input type="submit" value="+ Obras">
                    </form>
                </td>
            </tr>
            <?php
                foreach($obras as $indice => $obra){
                    echo "<tr>
                        <td>{$obra['Nombre_museo']}</td>
                        <td>{$obra['Numero_registro']}</td>
                        <td>{$obra['Nombre_del_objeto']}</td>
                        <td>{$obra['Titulo']}</td>
                        <td>{$obra['Autor']}</td>
                        <td>{$obra['Datacion']}</td>
                        <td>{$obra['Ubicacion']}</td>   
                        <td>Añadir fotos</td> 
                        </tr>";
                }
            ?>
        </table>
    </div>
</div>
