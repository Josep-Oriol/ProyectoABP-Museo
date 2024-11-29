document.addEventListener('DOMContentLoaded', function() {
    let popupImagen = document.getElementById('popupImagen');
    let vistaImagen = document.getElementById('vistaImagenAmpliada');
    const imagenes = document.querySelectorAll('.fotografiaObjeto');
    if (popupImagen) {
        imagenes.forEach(imagen => {
            imagen.addEventListener('click', function() {
                popupImagen.style.display = 'block';
                let imagenAmpliada = vistaImagen.children[0];
                imagenAmpliada.src = imagen.src;
            });
        });
        popupImagen.addEventListener('click', function(event) {
            event.stopPropagation();
            popupImagen.style.display = 'none';
        });
    
        vistaImagen.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
});