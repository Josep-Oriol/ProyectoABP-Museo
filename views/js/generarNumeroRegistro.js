document.addEventListener('DOMContentLoaded', function() {
    const inputLetra = document.getElementById('letra');
    const inputNumero = document.getElementById('numero_registro');
    const inputDecimal = document.getElementById('decimales');
    const sugerirNumero = document.getElementById('sugerirNumeroRegistro');
    const mensajeErrorFormato = document.getElementById('errorFormatoNumRegistro');
    const formulario = document.getElementById('formCrear');

    async function enviarDatos(datos) {
        let data;
        try {
            const response = await fetch('models/Fetch/obtenerNumeroRegistro.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body : JSON.stringify(datos)
            });
            data = await response.json();
            console.log(data);
        } catch (error) {
            console.error("Error al obtener el número de registro. Error: ", error);
        }
        return data;
    }

    async function obtenerNumeroRegistro() {
        mensajeErrorFormato.innerText = ''; //Ponemos vacío el texto del error por si antes se había cambiado.
        inputDecimal.value = ''; //Ponemos vacíos los decimales por si se hubieran cambiado antes
        let data = {
            "letra" : inputLetra.value
        }
        let dataDevuelta = await enviarDatos(data);
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
                    mensajeErrorFormato.innerText = 'Se ha alcanzado el número máximo de registros para esta letra. Escoge otra.';
                }
                else if (parteEntera === 99999 && parteDecimal === 99) {
                    mensajeErrorFormato.innerText = 'Se ha alcanzado el número máximo de registros sin letra. Escoge una letra.';
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
                inputNumero.value = numMax.toString().padStart(5, '0');
            }
        }
        else { //Si no existe valor máximo para esa letra, le asignamos el valor inicial para esa letra
            let numeroInicial = '00001';
            inputNumero.value = numeroInicial;
        }
    }

    if (letra) {
        obtenerNumeroRegistro();
        sugerirNumero.addEventListener('click', obtenerNumeroRegistro);
        letra.addEventListener('input', obtenerNumeroRegistro);

        formulario.addEventListener('submit', async function(event) {
            event.preventDefault();
            if (inputNumero.value.length < 5) {
                mensajeErrorFormato.innerText = 'El número debe contener 5 dígitos';
            }
            else if (inputDecimal.value.length === 1) {
                mensajeErrorFormato.innerText = 'Los decimales deben ser 2 dígitos';
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
                let dataDevuelta = await enviarDatos({nuevoNumeroRegistro : nuevoNumeroRegistro}); //Enviamos el nuevo numero introducido para ver si existe
                console.log(dataDevuelta);
    
                if (dataDevuelta.existe) {
                    alert('Error. El número de registro introducido ya existe.');
                }
                else {
                    formulario.submit();
                }
            }
        });
    }
});