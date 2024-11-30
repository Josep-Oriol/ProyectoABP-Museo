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
                            <input type="text" id="creador" name="creador" readonly value='<?php $_SESSION['Usuario']?>'>
                        </div>
                        <div>
                            <label for="desc">Descripció</label>
                            <input type="textarea" id="desc" name="desc">
                        </div>
                        <div>
                            <label for="datacion">Datació</label>
                            <input type="date" id="datacion" name="datacion" required>
                        </div>
                        <div>
                            <input type="submit" value="Crear" id="btnCrearCopia">
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
