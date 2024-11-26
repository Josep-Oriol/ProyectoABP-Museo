document.addEventListener('DOMContentLoaded', function() {
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

    const letra = document.getElementById('letra');
    const numero = document.getElementById('numero_registro');
    const sugerirNumero = document.getElementById('sugerirNumeroRegistro');
    const decimal = document.getElementById('decimales');
    const mensajeErrorFormato = document.getElementById('errorFormatoNumRegistro');
    const formulario = document.getElementById('formCrear');
    if (letra) {
        sugerirNumero.addEventListener('click', async function() {
            const data = {
                "letra" : letra.value
            }
            let dataDevuelta = await enviarDatos(data);
            if (dataDevuelta.numMax != "") {
                let numMax = dataDevuelta.numMax;
                if (/^[A-Z]$/.test(numMax[0])) { //Si tiene letra
                    numMax = numMax.slice(1);
                }
                if (!Number.isInteger(Number(numMax))) { //Si es decimal
                    let parteEntera = Number(numMax.split('.')[0]); //Dividimos la parte entera de la decimal con split
                    let parteDecimal = Number(numMax.split('.')[1]);
                    if (parteDecimal === 99) {
                        numero.value = (parteEntera + 1).toString().padStart(5, '0'); //Formateamos el valor con 0 y 5 dígitos
                        decimal.value = '00';
                    }
                    else { //Si no lo es formateamos el valor con 0 y 5 dígitos y el decimal con 2 dígitos sumándole 1
                        numero.value = (parteEntera).toString().padStart(5, '0');
                        decimal.value = (parteDecimal + 1).toString().padStart(2, '0');
                    }
                }
                else {
                    numero.value = (Number(numMax) + 1).toString().padStart(5, '0');
                }
            }
            else { //Si no existe valor máximo para esa letra, le asignamos el valor inicial para esa letra
                let numeroInicial = '00001';
                numero.value = Number(numeroInicial).toString().padStart(5, '0');
            }
        });

        formulario.addEventListener('submit', async function(event) {
            event.preventDefault();
            if (numero.value.length < 5) {
                mensajeErrorFormato.innerText = 'El número debe contener 5 dígitos';
            }
            else if (decimal.value.length === 1) {
                mensajeErrorFormato.innerText = 'Los decimales deben ser 2 dígitos';
            }
            else {
                let nuevoNumeroRegistro;
                if (decimal.value != '') { 
                    nuevoNumeroRegistro = letra.value + numero.value + '.' + decimal.value; //Comprobamos si se ha introducido un decimal para añadir el punto decimal.
                }
                else {
                    nuevoNumeroRegistro = letra.value + numero.value;//En caso de que no haya letra, su valor será vacío.
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