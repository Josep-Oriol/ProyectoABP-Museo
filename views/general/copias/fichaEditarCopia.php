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
                            <input type="text" id="nom" name="nom"  value='<?php echo $copia['nombre_copia']?>' >
                        </div>
                        <div>
                            <label for="creador">Creador</label>
                            <input type="text" id="creador" name="creador" value='<?php echo $copia['usuario'] ?>' readonly>
                        </div>
                        <div>
                            <label for="desc">Descripció</label>
                            <input type="textarea" id="desc" name="desc" value='<?php echo $copia['descripcion_copia'] ?>' >
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