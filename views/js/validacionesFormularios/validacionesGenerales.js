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

function validarExtension(inputFichero, tipoFichero) {
    let extensiones;
    switch (tipoFichero) {
        case "imagen":
            extensiones = ['jpg', 'jpeg', 'png', 'webp'];
            break;
        case "sql":
            extensiones = ['sql'];
            break;
    }
    let nombreFichero = inputFichero.files[0].name;
    let extension = nombreFichero.split(".")[1].toLowerCase(); //La extensión se puede obtener convirtiendo el nombre del fichero en un array, obteniendo la segunda posición (1) y asegurándonos de que esté en minúsculas
    console.log(extension);

    let valida = extensiones.includes(extension);
    return valida;
}

function validarImagenEnviarForm(inputFichero, tipoFichero, mensajePopup) {
    let valido = false;
    let extensionValida = validarExtension(inputFichero, tipoFichero);
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
        let extensionValida = validarExtension(inputFichero, "imagen");
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