async function obtenerNumeroRegistro(inputLetra, inputNumero, inputDecimal, mensajeErrorFormato) {
    mensajeErrorFormato.innerText = ''; //Ponemos vacío el texto del error por si antes se había cambiado.
    inputNumero.style.border = '1px solid #BFBFBF';
    inputDecimal.style.border = '1px solid #BFBFBF';
    inputDecimal.value = ''; //Ponemos vacíos los decimales por si se hubieran cambiado antes
    let data = {
        "letra" : inputLetra.value
    }
    let dataDevuelta = await enviarDatos(data, 'models/Fetch/obtenerNumeroRegistro.php');
    if (dataDevuelta.numMax != "") {
        let numMax = dataDevuelta.numMax;
        if (/^[A-Z]$/.test(numMax[0])) { //Comprobamos si el primer caracter es una letra
            numMax = numMax.slice(1); //Borramos el primer caracter
        }
        if (!Number.isInteger(Number(numMax))) { //Si es decimal
            console.log("Es decimal. Numero: " + numMax);
            let parteEntera = Number(numMax.split('.')[0]); //Dividimos la parte entera de la decimal con split
            let parteDecimal = Number(numMax.split('.')[1]);

            if (parteEntera < 99999 && parteDecimal === 99) {
                parteEntera++;
                parteDecimal = 1;
            }
            else if (parteEntera === 99999 && parteDecimal < 99) {
                parteDecimal++;
            }
            else if (inputLetra.value != '' && parteEntera === 99999 && parteDecimal === 99) {
                mensajeErrorFormato.innerText = "S'ha alcançat el nombre màxim de registres per a aquesta lletra. Escull-ne una altra.";
            }
            else if (parteEntera === 99999 && parteDecimal === 99) {
                mensajeErrorFormato.innerText = "S'ha alcançat el nombre màxim de registres sense lletra. Escull una lletra.";
            }
            else {
                parteDecimal++;
            }

            inputNumero.value = parteEntera.toString().padStart(5, '0'); //Formateamos el valor para que tenga 5 dígitos. Si el número tiene menos de 5 dígitos lo rellena con 0 a la izquierda
            inputDecimal.value = parteDecimal.toString().padStart(2, '0');
        }
        else {
            console.log("Es entero. Numero: " + numMax);
            numMax = Number(numMax);
            if (numMax === 99999) {
                inputNumero.value = numMax;
                inputDecimal.value = '01'; //En caso de llegar al número más alto, le sugerimos el primer decimal
            }
            else {
                numMax++;
            }
            inputNumero.value = numMax.toString().padStart(5, '0');
        }
    }
    else { //Si no existe valor máximo para esa letra, le asignamos el valor inicial para esa letra
        let numeroInicial = '00001';
        inputNumero.value = numeroInicial;
    }
}

async function validarNumEnviarForm(inputLetra, inputNumero, inputDecimal, mensajePopup) {
    let valido = false;
    if (inputNumero.value.length < 5) {
        mensajePopup.innerText += '\nEl número de registre ha de contenir 5 dígits';
    }
    else if (inputDecimal.value.length === 1) {
        mensajePopup.innerText += '\nEls decimals del número de registre han de ser 2 dígits';
    }
    else {
        let nuevoNumeroRegistro;
        if (inputDecimal.value != '') { 
            nuevoNumeroRegistro = inputLetra.value + inputNumero.value + '.' + inputDecimal.value; //Comprobamos si se ha introducido un decimal para añadir el punto decimal.
        }
        else {
            nuevoNumeroRegistro = inputLetra.value + inputNumero.value;//En caso de que no haya letra, su valor será vacío.
        }
        console.log(nuevoNumeroRegistro);
        let dataDevuelta = await enviarDatos({nuevoNumeroRegistro : nuevoNumeroRegistro}, 'models/Fetch/obtenerNumeroRegistro.php'); //Enviamos el nuevo numero introducido para ver si existe
        console.log(dataDevuelta);
        if (dataDevuelta.existe) {
            mensajePopup.innerText += '\nEl número de registre introduït ja existeix.';
        }
        else {
            valido = true;
        }
    }
    return valido;
}

document.addEventListener('DOMContentLoaded', async function() {
    const inputLetra = document.getElementById('letra');
    const inputNumero = document.getElementById('numero_registro');
    const inputDecimal = document.getElementById('decimales');
    const sugerirNumero = document.getElementById('sugerirNumeroRegistro');
    const mensajeErrorFormato = document.getElementById('errorFormatoNumRegistro');

    if (inputLetra) {
        await obtenerNumeroRegistro(inputLetra, inputNumero, inputDecimal, mensajeErrorFormato);
        sugerirNumero.addEventListener('click', async () => await obtenerNumeroRegistro(inputLetra, inputNumero, inputDecimal, mensajeErrorFormato));
        inputLetra.addEventListener('input', async () => await obtenerNumeroRegistro(inputLetra, inputNumero, inputDecimal, mensajeErrorFormato));
    }
});