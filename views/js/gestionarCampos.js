document.addEventListener('DOMContentLoaded', function() {
    const btnEliminar = document.getElementById('eliminarCampos')
    const btnCrear = document.getElementById('crearCampo')
    const inputRellenado = document.getElementById('crearCampoInput')

    // ESTILO BOTON ELIMINAR DEPENDIENDO DEL ESTADO DE LOS CHECKBOX

    let checkboxes = document.querySelectorAll('input[type="checkbox"]');

    function cambiarEstiloBotonEliminar() {
        checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        let hayCheckboxSeleccionado = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        if (!hayCheckboxSeleccionado) {
            btnEliminar.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
            btnEliminar.style.border = 'none';
            btnEliminar.style.animation = 'none';
        } else {
            btnEliminar.style.backgroundColor = '';
            btnEliminar.style.border = ''; 
            btnEliminar.style.animation = '';
        }
    }

    setInterval(cambiarEstiloBotonEliminar, 100);

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', cambiarEstiloBotonEliminar);  // Para actualizar cuando el usuario cambia el estado
    });
    
    cambiarEstiloBotonEliminar();

    // CREAR CAMPOS CON ENTER SI HAY ALGUN VALOR EN EL INPUT DE CREAR

    inputRellenado.addEventListener('keydown', function(event) {
        const valorInput = inputRellenado.value.trim();
        if (event.key === 'Enter' && valorInput !== ("")) {
            event.preventDefault()
            btnCrear.click();
        }
    });

    function comprobarContenidoInput() {
        if (inputRellenado.value.trim() !== '') {
            return true;
        } else {
            return false;
        }
    }

    inputRellenado.addEventListener('input', comprobarContenidoInput);


    if(btnEliminar) {
        btnEliminar.addEventListener('click', function(){
            let checkboxesMarcados = document.querySelectorAll('input[type="checkbox"]:checked');

            let idsSeleccionados = [];

            checkboxesMarcados.forEach(checkBox => {
                let id = checkBox.id;
                idsSeleccionados.push(id);
            });

            let data ={
                idsSeleccionados: idsSeleccionados
            }

            let dataJson = JSON.stringify(data)

            fetch('ajax.php?controller=Vocabularios&action=EliminarCampos', {
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body :dataJson
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success'){
                    let divTotales = document.querySelectorAll('.input-group')

                    let divEliminar =[]

                    divTotales.forEach(div => {
                        idsSeleccionados.forEach(idSeleccionada => {
                            if (div.id == idSeleccionada) {
                                divEliminar.push(div)
                            }
                        })
                    })
                    divEliminar.forEach(div => {
                        div.remove();
                    })
                }
            })
            .catch(error => console.error('Error en la solicitud:', error)); 
        })
    }

    if (btnCrear){
        btnCrear.addEventListener('click', function(){
            const input = document.getElementById('crearCampoInput')

            let id = input.name
            let nombre = input.value

            let data = {
                id: id,
                nombre: nombre
            }

            let dataJson = JSON.stringify(data)

            fetch('ajax.php?controller=Vocabularios&action=crearCampo', {
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body :dataJson
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    const nuevoDiv = document.createElement('div');
                    nuevoDiv.classList.add('input-group');
                    nuevoDiv.id = `${nombre}`; // Asignamos un ID único

                    // Crear el input de texto
                    const nuevoInput = document.createElement('input');
                    nuevoInput.classList.add('campo');
                    nuevoInput.type = 'text';
                    nuevoInput.name = nombre;
                    nuevoInput.id = nombre;
                    nuevoInput.value = nombre;
                    nuevoInput.autocomplete = 'off';

                    // Crear el checkbox
                    const nuevoCheckbox = document.createElement('input');
                    nuevoCheckbox.classList.add('campo-checkbox');
                    nuevoCheckbox.type = 'checkbox';
                    nuevoCheckbox.name = `${nombre}_checkbox`;
                    nuevoCheckbox.id = `${nombre}`;

                    // Agregar los inputs al nuevo div
                    nuevoDiv.appendChild(nuevoInput);
                    nuevoDiv.appendChild(nuevoCheckbox);

                    // Obtener el div original (puedes usar su ID o clase)
                    const formulario = document.getElementById('campos');

                    // Selecciona el último div dentro del formulario
                    const ultimoDiv = formulario.querySelector('div.input-group:last-of-type');

                    if (ultimoDiv) {
                        // Insertar el nuevo div justo después del div original
                        ultimoDiv.parentNode.insertBefore(nuevoDiv, ultimoDiv.nextSibling);
                    }

                    const campoInput = document.getElementById('crearCampoInput')
                    campoInput.value = '';
                }
            })
        })
    }
})