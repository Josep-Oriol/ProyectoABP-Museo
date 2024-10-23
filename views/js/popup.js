function cerrarPopup() {
    popup.style.display = "none"; // Oculta el popup
}

let usuarioId = null; // Variable para almacenar el ID del usuario a eliminar

function confirmarEliminacion() {
    if (usuarioId !== null) {
        // Redirigir a la acción de eliminación
        window.location.href = `index.php?controller=Usuarios&action=eliminar&id=${usuarioId}`;
    }
}

function crear() {
    window.location.href = 'index.php?controller=Usuarios&action=crear';
}

function editar() {
    if (usuarioId !== null) {
        // Redirigir a la acción de editar
        window.location.href = `index.php?controller=Usuarios&action=editar&id=${usuarioId}`;
    }
}

function obtenerImagenyFuncion(accion) {
    let imagen, funcion = null;
    switch (accion) {
        case 'Eliminar':
            imagen = 'images/senal-de-advertencia.png';
            funcion = confirmarEliminacion;
            break;
        case 'Crear':
            imagen = 'images/pregunta.png';
            funcion = crear;
            break;
        case 'Editar':
            imagen = 'images/pregunta.png';
            funcion = editar;
            break;
        case 'Exitoso':
            imagen = 'images/marca-de-verificacion.png';
            funcion = "";
            break;
        /*case 'Error':
            imagen = 'images/cruz-error.png';
            funcion = paginaActual;
            textoAceptar = 'Aceptar';
            break;*/
    }
    elementosPopup = [imagen, funcion];
    return elementosPopup;
}

function mostrarPopup(id, accion, mensaje) {
    usuarioId = id;
    elementosPopup = obtenerImagenyFuncion(accion); 
    let imagen = elementosPopup[0];
    let funcion = elementosPopup[1];

    let etiquetaImagen = document.getElementById('imagenPopup');
    etiquetaImagen.src = imagen;
    etiquetaImagen.alt = imagen;
    
    let etiquetaMensaje = document.getElementById('mensajePopup');
    etiquetaMensaje.innerText = mensaje;

    let botonConfirmar = document.getElementById('confirmar-btn');
    let botonCancelar = document.getElementById('cerrar-btn');

    botonConfirmar.innerText = accion;

    if (accion !== 'Exitoso') {
        botonConfirmar.addEventListener('click', funcion);
        botonCancelar.addEventListener('click', cerrarPopup);
    }
    else {
        botonConfirmar.addEventListener('click', cerrarPopup);
        botonCancelar.style.display = 'none';
    }

    document.getElementById("popup").style.display = "block";
}