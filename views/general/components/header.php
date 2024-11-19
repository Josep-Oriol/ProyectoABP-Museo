
<header>
    <img src="images/nombre.png" alt="">
    
    <nav>
        <a href="index.php?controller=Obras&action=mostrarObras">Inici</a>
        <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a>
        <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones">Ubicacions</a>
        <div>
            <a href="">Administració</a>
            <div>
                <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Gestió d'usuaris</a>
                <hr>
                <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Gestió de vocabularis</a>
                <hr>
                <a href="">Còpies de seguretat</a>
            </div>
        </div>
    </nav>
    <div>
        <span><?php echo $_SESSION['Usuario']; ?></span>
        <a id="iconoPerfil"><img src="images/icono2.png" alt=""></a>
        <div id="opcionesPerfil">
            <a href="">Veure el perfil</a>
            <a href="">Editar perfil</a>
            <a href="index.php?controller=Usuarios&action=cerrarSesion">Tanca la sessió</a>
        </div>
    </div>
</header>
