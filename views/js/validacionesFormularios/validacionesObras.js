function cambiarTipoFicha(fichaBasica, fichaCompleta, btnFichaBasica, btnFichaCompleta) {
    fichaCompleta.style.display = 'none';
    btnFichaBasica.classList.add('pulsado');
    btnFichaCompleta.addEventListener('click', () => {
        btnFichaCompleta.classList.add('pulsado');
        btnFichaBasica.classList.remove('pulsado');
        fichaBasica.style.display = 'none';
        fichaCompleta.style.display = 'block';
    });

    btnFichaBasica.addEventListener('click', () => { 
        btnFichaBasica.classList.add('pulsado');
        btnFichaCompleta.classList.remove('pulsado');
        fichaBasica.style.display = 'block';
        fichaCompleta.style.display = 'none';
    });
}

function resaltarInput(input, inputFechaInicio) {
    if (input.value && !inputFechaInicio.value) {
        inputFechaInicio.style.border = '2px solid #fc3535'; //En caso de que haya seleccionado un campo del select indicar que debe añadirle una fecha de inicio
    }
    else {
        inputFechaInicio.style.border = 'none';
    }
    
    if (!input.value && inputFechaInicio.value) { //En caso de que haya seleccionado una fecha de inicio y no haya seleccionado un campo del select
        input.style.border = '2px solid #fc3535';
    }
    else {
        input.style.border = 'none';
    }
}

/*function comprobarCampoVacio(input, fechaInicio, nombreCampo, mensajePopup) {
    campoVacio = false;
    if (input.value && !fechaInicio.value) { //Verificamos que haya seleccionado una ubicación o exposición para indicar que debe añadirle una fecha de inicio
        campoVacio = true;
        mensajePopup.innerText += "\nS'ha seleccionat una " + nombreCampo + " però no la seva data d'inici.";
    }
    else if (!input.value && fechaInicio.value) {
        campoVacio = true;
        mensajePopup.innerText += "\nS'ha seleccionat una data d'inici per a la " + nombreCampo + " però no la " + nombreCampo + ".";
    }
    return campoVacio;
}*/

function validarCampos(campoUbicacion, campoFechaInicioUbicacion) {
    campoUbicacion.addEventListener('change', () => resaltarInput(campoUbicacion, campoFechaInicioUbicacion));
    campoFechaInicioUbicacion.addEventListener('input', () => resaltarInput(campoUbicacion, campoFechaInicioUbicacion));
}

function validarNumeroRegistro(campoLetra, campoNumeroRegistro, campoDecimal, mensajeErrorFormato) {
    campoLetra.addEventListener('input', function() {
        campoLetra.value = campoLetra.value.toUpperCase();
        if (!(/^[A-Z]+$/.test(campoLetra.value))) {
            campoLetra.value = campoLetra.value.slice(0, -1); //Si se introduce un carácter que no es una letra, se elimina
        }
        if (campoLetra.value.length > 1) {
            campoLetra.value = campoLetra.value.slice(-1); //Si se introduce más de una letra, se elimina la primera para quedarse con la última
        }
    });

    campoNumeroRegistro.addEventListener('input', function() {
        mensajeErrorFormato.innerText = '';
        campoNumeroRegistro.style.border = '1px solid #BFBFBF';
        if (!(/^[0-9]*$/.test(campoNumeroRegistro.value)) || campoNumeroRegistro.value.length === 6) {
            let posicion = campoNumeroRegistro.value.length === 1 ? 0 : -1; 
            campoNumeroRegistro.value = campoNumeroRegistro.value.slice(0, posicion); //Si solo hay un dígito borrará ese, sino el último dígito del número
        }
        if (campoNumeroRegistro.value.length < 5) {
            campoNumeroRegistro.style.border = '2px solid #fc3535';
            mensajeErrorFormato.innerText = 'El número de registre deu tenir 5 dígits enters';
        }
    });

    campoDecimal.addEventListener('input', function() {
        mensajeErrorFormato.innerText = '';
        campoDecimal.style.border = '1px solid #BFBFBF';
        if (!(/^[0-9]*$/.test(campoDecimal.value)) || campoDecimal.value === '00' || campoDecimal.value.length === 3) { // En caso de que contenga un carácter que no sea un número del 0 al 9 incluidos o introduzca 00 o introduzca 3 dígitos
            let posicion = campoDecimal.value.length === 1 ? 0 : -1;
            campoDecimal.value = campoDecimal.value.slice(0, posicion); //Lo mismo que para el campo del numero
        }
        if (campoDecimal.value.length === 1) {
            campoDecimal.style.border = '2px solid #fc3535';
            mensajeErrorFormato.innerText = "La part decimal deu tenir dos dígits (no poden ser '00')";
        }
    });

    campoLetra.onpaste = function(event) { //Evitamos que se pueda pegar texto en el input
        event.preventDefault();
    }

    campoNumeroRegistro.onpaste = function(event) {
        event.preventDefault();
    }

    campoLetra.addEventListener('dragover', function(event) { //Evitamos que el usuario arrastre texto desde fuera hacia dentro del input
        event.preventDefault();
    });

    campoNumeroRegistro.addEventListener('dragover', function(event) {
        event.preventDefault();
    });

    campoLetra.autocomplete = 'off';
    campoNumeroRegistro.autocomplete = 'off';
    campoDecimal.autocomplete = 'off';
}

function validarEnvioFormCrear(formCrear, inputFichero, campoLetra, campoNumeroRegistro, campoDecimal, popup, mensajePopup) {
    formCrear.addEventListener('submit', async function(event) {
        event.preventDefault();
        mensajePopup.innerText = '';
        let envioForm = false;
        let numRegistroValido = await validarNumEnviarForm(campoLetra, campoNumeroRegistro, campoDecimal, mensajePopup);
        console.log("num valido: " + numRegistroValido);

        if (inputFichero.files.length > 0) {
            console.log("Se ha subido un fichero");
            let imagenValida = validarImagenEnviarForm(inputFichero, "imagen", mensajePopup);
            console.log("Imagen valida: " + imagenValida);
            envioForm = numRegistroValido && imagenValida;
        }
        else {
            envioForm = numRegistroValido;
        }

        if (envioForm) {
            formCrear.submit();
        } else {
            popup.style.display = 'block';
        }
    });
}

function validarEnvioFormEditar(formEditar, inputFichero, popup, mensajePopup) {
    formEditar.addEventListener('submit', function(event) {
        event.preventDefault();
        mensajePopup.innerText = '';
        let envioForm = false;
        
        if (inputFichero.files.length > 0) { //Comprobamos si se ha subido un fichero
            let imagenValida = validarImagenEnviarForm(inputFichero, "imagen", mensajePopup);
            envioForm = imagenValida;
        }
        else {
            envioForm = true;
        }

        if (envioForm) {
            formEditar.submit();
        }
        else {
            popup.style.display = 'block';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const fichaBasica = document.getElementById('fichaBasica');
    const fichaCompleta = document.getElementById('fichaCompleta');
    const btnFichaBasica = document.getElementById('btnFichaBasica');
    const btnFichaCompleta = document.getElementById('btnFichaCompleta');

    const campoFichero = document.getElementById('inputFotografia');
    const camposNumeroRegistro = document.getElementById('camposNumeroRegistro');
    const campoLetra = document.getElementById('letra');
    const campoNumeroRegistro = document.getElementById('numero_registro');
    const campoDecimal = document.getElementById('decimales');
    const mensajeErrorNumero = document.getElementById('errorFormatoNumRegistro');

    const campoUbicacion = document.getElementById('id_ubicacion');
    const campoFechaInicioUbicacion = document.getElementById('fecha_inicio_ubicacion');

    const formCrear = document.getElementById('formCrearObra');
    const formEditar = document.getElementById('formEditarObra');
    const popupFormulario = document.getElementById('popupFormulario');
    const mensajePopup = document.getElementById('mensajeErrores');
    
    if (fichaBasica) {
        cambiarTipoFicha(fichaBasica, fichaCompleta, btnFichaBasica, btnFichaCompleta);
    }
    if (formCrear) {
        validarNumeroRegistro(campoLetra, campoNumeroRegistro, campoDecimal, mensajeErrorNumero);
        validarEnvioFormCrear(formCrear, campoFichero, campoLetra, campoNumeroRegistro, campoDecimal, popupFormulario, mensajePopup);
    }
    else if (formEditar) {
        validarEnvioFormEditar(formEditar, campoFichero, popupFormulario, mensajePopup);
    }
    if (formCrear || formEditar) {
        validarCampos(campoUbicacion, campoFechaInicioUbicacion);
    }

});