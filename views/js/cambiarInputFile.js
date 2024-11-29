document.addEventListener('DOMContentLoaded', function() {
    let inputFile = document.getElementById('inputFotografia');
    let subirImagen = document.getElementById('subirImagen');
    let nombreArchivo = document.getElementById('nombreArchivo');

    if (inputFile) {
        inputFile.style.display = 'none';

        subirImagen.addEventListener('click', function() {
            inputFile.click();
        });

        inputFile.addEventListener('change', function() {
            nombreArchivo.innerHTML = inputFile.files[0].name;
            console.log(inputFile.files);
        });
    }
});