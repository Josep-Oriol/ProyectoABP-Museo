document.addEventListener('DOMContentLoaded', function() {
    let iconoPerfil = document.getElementById('iconoPerfil');
    let opcionesPerfil = document.getElementById('opcionesPerfil');

    iconoPerfil.addEventListener('mouseenter', function() {
        opcionesPerfil.style.display = 'block';
        opcionesPerfil.style.position = 'absolute';
        opcionesPerfil.style.top = '8vh';
        opcionesPerfil.style.right = '10px';
    });

    opcionesPerfil.addEventListener('mouseleave', function() {
        opcionesPerfil.style.display = 'none';
    });

    /*iconoPerfil.addEventListener('mouseleave', function() {
        opcionesPerfil.style.display = 'none';
    });*/
});