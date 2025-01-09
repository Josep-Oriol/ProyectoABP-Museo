<header>
    <img src="images/nombre.png" alt="">

    <nav>
        <a href="index.php?controller=Obras&action=mostrarObras" class="opcionesHeader">Inici</a>

        <?php if ($_SESSION['Rol'] == 'Administració' || $_SESSION['Rol'] == 'Tècnic') { ?>
            <a href="index.php?controller=Exposiciones&action=mostrarExposiciones" class="opcionesHeader">Exposicions</a>
        <?php } ?>

        <?php if ($_SESSION['Rol'] == 'Administració') { ?>
            <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones" class="opcionesHeader">Ubicacions</a>
        <?php } ?>

        <?php if ($_SESSION['Rol'] == 'Administració' || $_SESSION['Rol'] == 'Tècnic') { ?>
            <a href="index.php?controller=Restauraciones&action=mostrarRestauraciones" class="opcionesHeader">Restauracions</a>
        <?php } ?>

        <?php if ($_SESSION['Rol'] == 'Administració') { ?>
            <div id="opcionAdmin">
                <a href="#">Administració</a>
                <div id="desplegableAdmin">
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Gestió d'usuaris</a>
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Gestió de vocabularis</a>
                    <a href="index.php?controller=Copias&action=mostrarCopias">Còpies de seguretat</a>
                </div>
            </div>
        <?php } ?>
    </nav>

    <div>
        <span><?php echo $_SESSION['Usuario']; ?></span>
        <img src="images/icono2.png" alt="" id="iconoPerfil">
        <div id="desplegablePerfil">
            <a href="index.php?controller=Usuarios&action=mostrarFicha&id=<?php echo $_SESSION['ID_usuario']; ?>">Veure el perfil</a>
            <a href="index.php?controller=Usuarios&action=editar&id=<?php echo $_SESSION['ID_usuario']; ?>">Editar perfil</a>
            <a href="index.php?controller=Usuarios&action=cerrarSesion">Tanca la sessió</a>
        </div>
    </div>
</header>
