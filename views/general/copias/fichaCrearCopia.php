<?php
if (isset($_SESSION['Rol'])) {
?>
    <section id="fichaCopia">
        <form action="index.php?controller=Copias&action=crear" enctype="multipart/form-data" method="POST" id="formCrear">
            <div>
                <div>
                    <h2>Dades Principals</h2>
                    <div>
                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div>
                            <label for="creador">Creador</label>
                            <input type="text" id="creador" name="creador" readonly value='<?php echo $_SESSION['Usuario']?>'>
                        </div>
                        <div>
                            <label for="desc">Descripció</label>
                            <input type="textarea" id="desc" name="desc">
                        </div>
                        <div>
                            <label for="fecha">Datació</label>
                            <input type="text" id="fecha" name="fecha" value='<?php echo date("Y-m-d"); ?>' readonly>
                        </div>
                        <div>
                            <input type="submit" value="Crear" id="btnCrearCopia">
                        </div>
                    </div>
                    <p>La copia de seguretat es guardará a la carpeta de descárregas del sistema.<p>
                </div>
            </div>
        </form>
    </section>

<?php
} else {
    echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
}
