document.addEventListener('DOMContentLoaded', function() {
    const opcionAdmin = document.getElementById('opcionAdmin');
    const iconoPerfil = document.getElementById('iconoPerfil');
    const desplegableAdmin = document.getElementById('desplegableAdmin');
    const desplegablePerfil = document.getElementById('desplegablePerfil');
    const opcionesHeader = document.querySelectorAll('.opcionesHeader');
    let temporizador;

    function mostrarDesplegable(icono, desplegable) {
        icono.addEventListener('mouseenter', function() {
            clearTimeout(temporizador);
            desplegable.style.display = 'block';
        });

        desplegable.addEventListener('mouseenter', function() {
            clearTimeout(temporizador);
            desplegable.style.display = 'block';
        });

        desplegable.addEventListener('mouseleave', function() {
            clearTimeout(temporizador)
            desplegable.style.display = 'none';
        });

        icono.addEventListener('mouseleave', function() {
            temporizador = setTimeout(function () {
                desplegable.style.display = 'none';
            }, 100);
        });
    }

    if (opcionAdmin) {
        mostrarDesplegable(opcionAdmin, desplegableAdmin);
    }
    mostrarDesplegable(iconoPerfil, desplegablePerfil);
    
    opcionesHeader.forEach(opcion => {
        if (opcion.href === window.location.href) {
            opcion.style.borderBottom = '2px solid rgb(235, 235, 235)';
        }
    });
});