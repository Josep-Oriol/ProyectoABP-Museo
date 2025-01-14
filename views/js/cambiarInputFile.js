function abrirInputFile(inputFile) {
    inputFile.click();
}

function indicarArchivoImagenSubido(inputFile, nombreArchivoSubido) {
    nombreArchivoSubido.innerText = inputFile.files[0].name;
    console.log(inputFile.files);
}

function mostrarArchivosSubidos(inputFile, nombreArchivosSubidos) {
    nombreArchivosSubidos.innerText = '';
    let archivosSubidos = inputFile.files;
    for (let archivo of archivosSubidos) {
        nombreArchivosSubidos.innerText += archivo.name + "\n";
    }
    console.log(archivosSubidos)
}

document.addEventListener('DOMContentLoaded', function() {
    const inputFileImagen = document.getElementById('inputFotografia');
    const subirImagen = document.getElementById('subirImagen');
    const nombreArchivoImagen = document.getElementById('nombreArchivo');

    const inputFileArchivos = document.getElementById('inputArchivosAdicionales');
    const subirArchivos = document.getElementById('subirArchivosAdicionales');
    const nombreArchivos = document.getElementById('nombreArchivos');

    if (inputFileImagen) {
        inputFileImagen.style.display = 'none';
        subirImagen.addEventListener('click', () => abrirInputFile(inputFileImagen));
        inputFileImagen.addEventListener('change', () => indicarArchivoImagenSubido(inputFileImagen, nombreArchivoImagen));
    }
    if (inputFileArchivos) {
        inputFileArchivos.style.display = 'none';
        subirArchivos.addEventListener('click', () => abrirInputFile(inputFileArchivos));
        inputFileArchivos.addEventListener('change', () => mostrarArchivosSubidos(inputFileArchivos, nombreArchivos));
    }
});