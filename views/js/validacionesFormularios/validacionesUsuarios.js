function validarSoloLetras(texto) {
    return /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]*$/.test(texto); //Devuelve true si contiene solo carácteres que sean letras en minúsculas o mayúsculas y con o sin tildes
}

function validarSoloNumeros(texto) {
    return /^[0-9]*$/.test(texto); //Devuelve true si solo contiene numeros entre el 0 y el 9, ambos incluidos.
}

async function validarUsuario(inputUsuario, errorUsuario) {
    errorUsuario.innerText = '';
    let data = await enviarDatos({"usuario" : inputUsuario.value.trim()}, 'models/Fetch/comprobarUsuario.php');
    let usuarioExiste = data.usuarioExiste;
    if (usuarioExiste) {
        errorUsuario.innerText = "L'usuari introduït ja existeix.";
    }
}

async function validarUsuarioEnvioForm(inputUsuario, mensajePopup) {
    let data = await enviarDatos({"usuario" : inputUsuario.value.trim()}, 'models/Fetch/comprobarUsuario.php');
    let usuarioExiste = data.usuarioExiste;
    let valido = !usuarioExiste; //Para que valido sea true no debe existir el usuario
    if (!valido) {
        mensajePopup.innerText += "\nL'usuari introduït ja existeix.";
    }
    return valido;
}

function eventosValidarNombreyApellidos(inputNombre, inputApellidos, errorNombre, errorApellido) {
    inputNombre.addEventListener('input', function() {
        errorNombre.innerText = '';
        let soloLetras = validarSoloLetras(inputNombre.value);
        if (!soloLetras) {
            errorNombre.innerText = 'El nom només pot contenir lletres.';
        }
    });
    inputApellidos.addEventListener('input', function() {
        errorApellido.innerText = '';
        let soloLetras = validarSoloLetras(inputApellidos.value);
        if (!soloLetras) {
            errorApellido.innerText = 'El cognom només pot contenir lletres.';
        }
    });
}

function eventoValidarTelefono(inputTelefono, errorTelefono) {
    inputTelefono.addEventListener('input', function() {
        errorTelefono.innerText = '';
        let soloNumeros = validarSoloNumeros(inputTelefono.value);
        if (!soloNumeros) {
            errorTelefono.innerText = 'El telèfon només pot contenir números.';
        }
    });
}

function validarCamposEnvioForm(inputNombre, inputApellidos, inputTelefono, mensajePopup) {
    let nombreValido = validarSoloLetras(inputNombre.value);
    if (!nombreValido) {
        mensajePopup.innerText += "\nEl nom només pot contenir lletres.";
    }
    let apellidosValidos = validarSoloLetras(inputApellidos.value);
    if (!apellidosValidos) {
        mensajePopup.innerText += "\nEl cognom només pot contenir lletres.";
    }
    let telefonoValido = validarSoloNumeros(inputTelefono.value);
    if (!telefonoValido) {
        mensajePopup.innerText += "\nEl telèfon només pot contenir números.";
    }

    let camposValidos = nombreValido && apellidosValidos && telefonoValido;
    return camposValidos;
}

function eventoValidarFormCrear(form, inputFotografia, inputUsuario, inputNombre, inputApellidos, inputTelefono, popup, mensajePopup) {
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        mensajePopup.innerText = '';
        let envioForm = false;

        let usuarioValido = await validarUsuarioEnvioForm(inputUsuario, mensajePopup);
        
        let camposValidos = validarCamposEnvioForm(inputNombre, inputApellidos, inputTelefono, mensajePopup);
        
        if (inputFotografia.files.length > 0) { // Validar si se ha subido una fotografia
            let imagenValida = validarImagenEnviarForm(inputFotografia, "imagen", mensajePopup);
            envioForm = imagenValida && usuarioValido && camposValidos;
        }
        else {
            envioForm = usuarioValido && camposValidos;
        }

        if (envioForm) {
            form.submit();
        }
        else {
            popup.style.display = 'block';
        }
    });
}

function eventoValidarFormEditar(form, inputFotografia, inputUsuario, inputNombre, inputApellidos, inputTelefono, popup, mensajePopup, usuarioInicial) {
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        mensajePopup.innerText = '';
        let envioForm = false;
        let usuarioValido;
        if (inputUsuario.value != usuarioInicial) { // Si el usuario ha cambiado su usuario
            usuarioValido = await validarUsuarioEnvioForm(inputUsuario, mensajePopup);
        }
        else {
            usuarioValido = true; //Si no lo ha cambiado lo pasamos como válido
        }
        
        let camposValidos = validarCamposEnvioForm(inputNombre, inputApellidos, inputTelefono, mensajePopup);
        
        if (inputFotografia.files.length > 0) { //Validar si se ha subido una fotografia
            let imagenValida = validarImagenEnviarForm(inputFotografia, "imagen", mensajePopup);
            envioForm = imagenValida && usuarioValido && camposValidos;
        }
        else {
            envioForm = usuarioValido && camposValidos;
        }

        if (envioForm) {
            form.submit();
        }
        else {
            popup.style.display = 'block';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const formCrearUsuario = document.getElementById('formCrearUsuario');
    const formEditarUsuario = document.getElementById('formEditarUsuario');

    const campoUsuario = document.getElementById('usuario');
    const mensajeErrorUsuario = document.getElementById('errorUsuario');
    const campoNombre = document.getElementById('nombre');
    const mensajeErrorNombre = document.getElementById('errorNombre');
    const campoApellidos = document.getElementById('apellidos');
    const mensajeErrorApellidos = document.getElementById('errorApellidos');
    const campoTelefono = document.getElementById('telefono');
    const mensajeErrorTelefono = document.getElementById('errorTelefono');
    const campoFoto = document.getElementById('inputFotografia');

    const popup = document.getElementById('popupFormulario');
    const mensajePopup = document.getElementById('mensajeErrores');

    if (formCrearUsuario || formEditarUsuario) {
        eventosValidarNombreyApellidos(campoNombre, campoApellidos, mensajeErrorNombre, mensajeErrorApellidos);
        eventoValidarTelefono(campoTelefono, mensajeErrorTelefono);
    }

    if (formCrearUsuario) {
        campoUsuario.addEventListener('input', async function() {
            await validarUsuario(campoUsuario, mensajeErrorUsuario);
        });
        eventoValidarFormCrear(formCrearUsuario, campoFoto, campoUsuario, campoNombre, campoApellidos, campoTelefono, popup, mensajePopup);
    }
    else if (formEditarUsuario) {
        const usuarioInicial = campoUsuario.value; //Guardamos el usuario que se rellena al cargar la página, que es el nombre de usuario actual.
        campoUsuario.addEventListener('input', async function() {
            mensajeErrorUsuario.innerText = '';
            if (usuarioInicial != campoUsuario.value) {
                await validarUsuario(campoUsuario, mensajeErrorUsuario);
            }
        });
        eventoValidarFormEditar(formEditarUsuario, campoFoto, campoUsuario, campoNombre, campoApellidos, campoTelefono, popup, mensajePopup, usuarioInicial);
    }
});