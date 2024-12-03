document.addEventListener('DOMContentLoaded', function() {
    let popupImagen = document.getElementById('popupImagen');
    let vistaImagen = document.getElementById('vistaImagenAmpliada');
    if (popupImagen) {
        popupImagen.addEventListener('click', function(event) {
            event.stopPropagation();
            popupImagen.style.display = 'none';
        });
    
        vistaImagen.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
});