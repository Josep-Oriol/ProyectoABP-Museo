<?php
    if(isset($_SESSION['Rol'])){
        $id = $_GET['id'];
    ?>
    <div class="relacion">
        <div>
            <h2>Relacionar</h2>
        </div>
        <div>
            <form action="index.php?controller=Exposiciones&action=relacionar&id=<?php echo $id; ?>" method="POST">
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

                            $checked = false;
                            foreach ($obrasRelacionadas as $obraRelacionada) {
                                if ($obra['numero_registro'] == $obraRelacionada['numero_registro']) {
                                    $checked = true;
                                }
                            }

                            echo "<tr>";
                            echo "<td>{$obra['fotografia']}</td>";
                            echo "<td>{$obra['numero_registro']}</td>";
                            echo "<td>{$obra['nombre_objeto']}</td>";
                            echo "<td>{$obra['titulo']}</td>";
                            echo "<td>{$obra['autor']}</td>";
                            echo "<td>{$obra['datacion']}</td>";
                            echo "<td>{$obra['descripcion_ubicacion']}</td>";
                            echo "<td><input type='checkbox' name='obra_{$obra['numero_registro']}' value='{$obra['numero_registro']}' " . ($checked ? "checked" : "") . "></td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
                <input type="submit">
            </form>
        </div>
    </div>      
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

