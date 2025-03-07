<?php
if (isset($_SESSION['Rol'])) {
?>
    <section id="fichaCopia">
        <form action="" method="POST" id="fichaCompleta">
            <div>
                <div>
                    <h2>Dades Principals</h2>
                    <div>
                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom"  value='<?php echo $copia['nombre_copia']?>' readonly>
                        </div>
                        <div>
                            <label for="creador">Creador</label>
                            <input type="text" id="creador" name="creador" readonly value='<?php echo $copia['usuario'] ?>' readonly>
                        </div>
                        <div>
                            <label for="desc">Descripció</label>
                            <input type="text" id="desc" name="desc" value='<?php echo $copia['descripcion_copia'] ?>' readonly>
                        </div>
                        <div>
                            <label for="fecha">Datació</label>
                            <input type="text" id="fecha" name="fecha" value='<?php echo $copia['fecha_copia'] ?>' readonly>
                        </div>
                        <div>
                            <?php
                            switch ($_SESSION['Rol']) {
                                case 'Administració':
                            ?>
                                    <a href="index.php?controller=Copias&action=editar&id=<?php echo $id; ?>" title="Editar"><img src="images/editarv2.png" alt="icono editar"></a>
                                    <a href="index.php?controller=Copias&action=eliminar&id=<?php echo $id; ?>" title="Eliminar"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                    <a href="index.php?controller=Copias&action=descargar&id=<?php echo $id; ?>" title="descargar"><img src="images/download.png" alt="icono descargar"></a>
                                <?php
                                    break;
                                case 'Tècnic':
                                ?>
                                    <a href="index.php?controller=Copias&action=editar&id=<?php echo $id; ?>" title="Editar"><img src="images/editarv2.png" alt="icono editar"></a>
                            <?php
                                    break;
                            }
                            ?>
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