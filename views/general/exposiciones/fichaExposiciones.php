<?php
    if(isset($_SESSION['Rol'])){
    ?>
    <div class="Exposicion">
        <div>
            <form action="">
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" value="<?php echo $datos['id_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="descripcio">Descripció</label>
                    <input type="text" value="<?php echo $datos['texto_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="lloc">Lloc exposició</label>
                    <input type="text" value="<?php echo $datos['lugar_exposicion'];?>" readonly>
                </div>
                <div>
                    <label for="inici">Data inici</label>
                    <input type="date" value="<?php echo $datos['fecha_inicio_exposicion']; ?>" readonly>
                </div>
                <div>
                    <label for="termini">Data termini</label>
                    <input type="date" value="<?php echo $datos['fecha_fin_exposicion']; ?>" readonly>
                </div>
            </form>
        </div>
        <div>
            <div>
                <h2>Obras relacionadas</h2> <!-- Poner el contenido deseado -->
            </div>
            <div>
                <table>
                    <tr>
                        <th>NºRegistre</th>
                        <th>Nom</th>
                        <th>Titol</th>
                        <td> 
                            <a href="index.php?controller=Exposiciones&action=relacionarObras&id=<?php echo $datos['id_exposicion']; ?>"><button>Añadir a la exposicion</button></a>
                        </td>
                    </tr>
                    <?php
                    
                    foreach($datosObras as $indice => $datoObra){
                        echo "<tr>";
                        echo "<td>".$datoObra['numero_registro']."</td>";
                        echo "<td>".$datoObra['titulo']."</td>";
                        echo "<td>".$datoObra['autor']."</td>";
                        echo "<td>"."<a href=''><button>Retirar de la exposicion</button></a>"."</td>";
                        echo "</tr>";
                    }
                    ?>
                    
                </table>
            </div>
        </div>
    </div>
        
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }
?>

