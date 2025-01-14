function validarExtensionArchivo(archivo) {
    let esImagen = validarExtension(archivo, "imagen");
    let esMultimedia = validarExtension(archivo, "multimedia");
    let esDocumento = validarExtension(archivo, "documento");

    return esImagen || esMultimedia || esDocumento;
}

function validarArchivos(inputArchivos, mensajeError) {
    let archivosSubidos = inputArchivos.files;
    let validos = true;
    if (archivosSubidos.length > 1) {
        for (let archivo of archivosSubidos) {
            let archivoValido = validarExtensionArchivo(archivo);
            if (!archivoValido) {
                validos = false;
                mensajeError.innerText += "\nL'arxiu " + archivo.name + " no té una extensió vàlida.\n";
            }
        }
    }
    else {
        let archivo = archivosSubidos[0];
        let archivoValido = validarExtensionArchivo(archivo);
        if (!archivoValido) {
            validos = false;
            mensajeError.innerText += "\nL'arxiu no té una extensió vàlida.";
        }
    }
    return validos;
}

function validarAlSubirArchivo(inputArchivos, subirArchivos) {
    let mensajeError = document.createElement('p');
    mensajeError.style.color = 'red';
    mensajeError.style.marginTop = '5px';
    subirArchivos.appendChild(mensajeError);
    inputArchivos.addEventListener('change', function() {
        mensajeError.innerText = '';
        validarArchivos(inputArchivos, mensajeError);
    });
}

function validarArchivosEnviarForm(inputArchivos, mensajePopup) {
    validarArchivos(inputArchivos, mensajePopup);
}

function generarInput(tipo, nombre, valor) {
    let input = document.createElement('input');
    input.type = tipo;
    input.name = nombre;
    input.value = valor;

    return input;
}

function anadirEnlaces(campoNombre, campoEnlace, icono, enlaces, mensajeError) {
    mensajeError.style.color = 'red';
    let colorBordeError = '2px solid #fc3535';
    let colorBordeNormal = '1px solid #BFBFBF';
    icono.addEventListener('click', function() {
        mensajeError.innerText = '';
        campoNombre.style.border = colorBordeNormal;
        campoEnlace.style.border = colorBordeNormal;

        let nombre = campoNombre.value;
        let enlace = campoEnlace.value;
        if (nombre !== "" && enlace !== "") {
            let inputNombre = generarInput("text", "nombres_enlaces[]", nombre);
            let inputEnlace = generarInput("text", "enlaces[]", enlace);

            campoNombre.value = '';
            campoEnlace.value = '';

            let iconoEliminar = document.createElement('img');
            iconoEliminar.src = 'images/svg/minus.svg';
            iconoEliminar.alt = 'eliminar enlace';

            let div = document.createElement('div');
            div.appendChild(inputNombre);
            div.appendChild(inputEnlace);
            div.appendChild(iconoEliminar);
            enlaces.appendChild(div);
            iconoEliminar.addEventListener('click', function() {
                div.remove();
            });
        }
        else if (nombre === "" && enlace !== "") {
            mensajeError.innerText = "Nom de l'enllaç vuit.";
            campoNombre.style.border = colorBordeError;
        }
        else if (nombre !== "" && enlace === "") {
            mensajeError.innerText = "Enllaç vuit.";
            campoEnlace.style.border = colorBordeError;
        }
        else {
            mensajeError.innerText = "Nom de l'enllaç i enllaç vuits.";
            campoNombre.style.border = colorBordeError;
            campoEnlace.style.border = colorBordeError;
        }
    });
}



document.addEventListener('DOMContentLoaded', function() {
    const enlaces = document.getElementById('enlaces');
    const campoNombreEnlace = document.getElementById('nombre_enlace');
    const campoEnlace = document.getElementById('enlace');
    const iconoAnadirEnlace = document.getElementById('anadirEnlace');
    const mensajeErrorEnlace = document.getElementById('mensajeErrorEnlace');
    
    const inputSubirArchivos = document.getElementById('inputArchivosAdicionales');
    const subirArchivos = document.getElementById('subirArchivosAdicionales');
    if (enlaces) {
        anadirEnlaces(campoNombreEnlace, campoEnlace, iconoAnadirEnlace, enlaces, mensajeErrorEnlace);
        validarAlSubirArchivo(inputSubirArchivos, subirArchivos);
    }
});