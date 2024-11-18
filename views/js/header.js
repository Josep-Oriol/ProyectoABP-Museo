document.addEventListener('DOMContentLoaded', function() {
    let iconoPerfil = document.getElementById('iconoPerfil');
    let opcionesPerfil = document.getElementById('opcionesPerfil');

    opcionesPerfil.style.display = 'none';

    iconoPerfil.addEventListener('mouseover', function() {
        opcionesPerfil.style.display = 'block';
    })
});