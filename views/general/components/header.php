
<header>
    <img src="images/nombre.png" alt="">
    
    <nav>
        <a href="index.php?controller=Obras&action=mostrarObras" class="opcionesHeader">Inici</a>
        <a href="index.php?controller=Exposiciones&action=mostrarExposiciones" class="opcionesHeader">Exposicions</a>
        <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones" class="opcionesHeader">Ubicacions</a>
        <?php
        if ($_SESSION['Rol'] == 'Administració' || $_SESSION['Rol'] == 'Tècnic') {
            ?>
            <div id="opcionAdmin">
                <a href="">Administració</a>
                <div id="desplegableAdmin">
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Gestió d'usuaris</a>
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Gestió de vocabularis</a>
                    <a href="">Còpies de seguretat</a>
                </div>
            </div>
            <?php
        }
        ?>
    </nav>
    <div>
        <span><?php echo $_SESSION['Usuario']; ?></span>
        <img src="images/icono2.png" alt="" id="iconoPerfil">
        <div id="desplegablePerfil">
            <a href="">Veure el perfil</a>
            <a href="">Editar perfil</a>
            <a href="index.php?controller=Usuarios&action=cerrarSesion">Tanca la sessió</a>
        </div>
    </div>
</header>
