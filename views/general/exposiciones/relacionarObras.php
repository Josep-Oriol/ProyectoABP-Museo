<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="relacion">
        <div>
            <h2>Relacionar</h2>
        </div>
        <div>
            <form action="">
                <table>
                    <tr>
                        <td>Imatge</td>
                        <td>NºRegistre</td>
                        <td>Nom</td>
                        <td>Títol</td>
                        <td>Autor</td>
                        <td>Datació</td>
                        <td>Ubicació</td>
                        <td></td>
                    </tr>
                    <?php
                        foreach ($obras as $obra) {
                            // Comprobamos si la obra actual está en $obrasRelacionadas
                            $checked = false;
                            foreach ($obrasRelacionadas as $obraRelacionada) {
                                // Supongamos que comparamos por el campo 'numero_registro' de las obras
                                if ($obra['numero_registro'] == $obraRelacionada['numero_registro']) {
                                    $checked = true;
                                    break; // Salir del loop si ya encontramos la coincidencia
                                }
                            }

                            // Imprimir la fila de la tabla con el checkbox marcado si es necesario
                            echo "<tr>";
                            echo "<td>{$obra['fotografia']}</td>";
                            echo "<td>{$obra['numero_registro']}</td>";
                            echo "<td>{$obra['nombre_objeto']}</td>";
                            echo "<td>{$obra['titulo']}</td>";
                            echo "<td>{$obra['autor']}</td>";
                            echo "<td>{$obra['datacion']}</td>";
                            echo "<td>{$obra['descripcion_ubicacion']}</td>";
                            echo "<td><input type='checkbox' name='obras' value='{$obra['numero_registro']}' " . ($checked ? "checked" : "") . "></td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </form>
        </div>
    </div>      
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

