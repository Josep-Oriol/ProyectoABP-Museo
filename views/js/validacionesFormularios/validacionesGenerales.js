async function enviarDatos(datos, url) {
    let data;
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body : JSON.stringify(datos)
        });
        data = await response.json();
        console.log(data);
    } catch (error) {
        console.error("Error: ", error);
    }
    return data;
}

function validarExtension(fichero, tipoFichero) {
    let extensiones;
    switch (tipoFichero) {
        case "imagen":
            extensiones = ['jpg', 'jpeg', 'png', 'webp', 'tiff'];
            break;
        case "multimedia":
            extensiones = ['mp4', 'mov', 'wmv', 'avi', 'mkv', 'webm', 'mp3', 'wav'];
            break;
        case "documento":
            extensiones = ['pdf', 'docx', 'doc', 'odt', 'ods', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'odp', 'txt'];
            break;
        case "sql":
            extensiones = ['sql'];
            break;
    }
    let nombreFichero = fichero.name;
    let extension = nombreFichero.split(".")[1].toLowerCase(); //La extensión se puede obtener convirtiendo el nombre del fichero en un array, obteniendo la segunda posición (1) y asegurándonos de que esté en minúsculas
    console.log(extension);

    let valida = extensiones.includes(extension);
    return valida;
}

function validarImagenEnviarForm(inputFichero, tipoFichero, mensajePopup) {
    let valido = false;
    let fichero = inputFichero.files[0];
    let extensionValida = validarExtension(fichero, tipoFichero);
    if (extensionValida) {
        valido = true;
    }
    else {
        mensajePopup.innerText += '\nEl fitxer no té una extensió vàlida.';
    }
    return valido;
}

function validarAlSubirImagen(inputFichero) {
    let apartadoSubirArchivo = document.getElementById('subirImagen');
    let mensajeError = document.createElement('p');
    mensajeError.innerText = "L'extensió de l'arxiu no és vàlida";
    mensajeError.style.color = 'red';
    mensajeError.style.marginTop = '5px';
    apartadoSubirArchivo.appendChild(mensajeError);
    mensajeError.style.display = 'none';
    inputFichero.addEventListener('change', function() {
        let fichero = inputFichero.files[0].name;
        let extensionValida = validarExtension(fichero, "imagen");
        if (extensionValida) {
            mensajeError.style.display = 'none';
        }
        else {
            mensajeError.style.display = 'block';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const inputFichero = document.getElementById('inputFotografia');
    if (inputFichero) {
        validarAlSubirImagen(inputFichero);
    }
});