let url = window.location.href;
let pagina = url.includes('mostrarCamposVocabulario') ? 'Vocabulario' : null

if(pagina != null) {
    document.addEventListener('DOMContentLoaded', function() {
        const btnEliminar = document.getElementById('eliminarCampos')
        const btnCrear = document.getElementById('crearCampo')
        const btnEditar = document.getElementById('editar')
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
    
        // NO PERMITIR CREAR CAMPOS EN BLANCO
    
        function comprobarContenidoInput() {
            if (inputRellenado.value.trim() !== '') {
                btnCrear.disabled = false;
            } else {
                btnCrear.disabled = true;
            }
        }
    
        inputRellenado.addEventListener('input', comprobarContenidoInput);
    
        setInterval(comprobarContenidoInput, 100);
    
        // NO PERMITIR CREAR CAMPOS DUPLICADOS
    
        let camposCreados = [];
    
        function revisarInputs() {
            camposCreados = Array.from(document.querySelectorAll('input.campo'));
        }
    
        revisarInputs();
    
    
    
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
                event.preventDefault();
                const input = document.getElementById('crearCampoInput')
    
                revisarInputs();
    
                const existeCampo = camposCreados.some(campo => campo.value === input.value.trim());
    
                if(existeCampo){
                    return;
                }else {
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
                            nuevoDiv.id = `${nombre}`; 
    
                            const nuevoInput = document.createElement('input');
                            nuevoInput.classList.add('campo');
                            nuevoInput.type = 'text';
                            nuevoInput.name = nombre;
                            nuevoInput.id = nombre;
                            nuevoInput.value = nombre;
                            nuevoInput.autocomplete = 'off';
    
                            const nuevoCheckbox = document.createElement('input');
                            nuevoCheckbox.classList.add('campo-checkbox');
                            nuevoCheckbox.type = 'checkbox';
                            nuevoCheckbox.name = `${nombre}_checkbox`;
                            nuevoCheckbox.id = `${nombre}`;
    
                            nuevoDiv.appendChild(nuevoInput);
                            nuevoDiv.appendChild(nuevoCheckbox);
    
                            const formulario = document.getElementById('campos');
    
                            const ultimoDiv = formulario.querySelector('div.input-group:last-of-type');
    
                            if (ultimoDiv) {
                                ultimoDiv.parentNode.insertBefore(nuevoDiv, ultimoDiv.nextSibling);
                            }
    
                            const campoInput = document.getElementById('crearCampoInput')
                            campoInput.value = '';
                        }
                    })
                }
            })
        }
    
        let camposActuales = Array.from(document.querySelectorAll('input.campo')).map(campo => campo.value);
        let mensaje = document.getElementById('mensajeEditado')


        if(btnEditar){
            btnEditar.addEventListener('click', function(){
                let camposEditados = Array.from(document.querySelectorAll('input.campo')).map(campo => campo.value);
                
                let data = {
                    antiguoValor: camposActuales,
                    nuevoValor: camposEditados
                }
    
                let dataJson = JSON.stringify(data)
    
                fetch('ajax.php?controller=Vocabularios&action=editarCampos', {
                    method: 'POST',
                    headers:{
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body :dataJson
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success'){
    
                        mensaje.style.display = 'block';
                        mensaje.style.color = 'green';
                        mensaje.innerHTML = 'Camps editats amb exit'
    
                        setTimeout(() => {
                            mensaje.style.display = "none"; 
                        }, 2000); 
    
                        camposActuales = Array.from(document.querySelectorAll('input.campo')).map(campo => campo.value);
                    }else if (data.status === 'sinCambios'){
                        console.log(data.status)
                    }else if (data.status === 'repetidos') {
                        mensaje.style.display = 'block';
                        mensaje.style.color = 'red';
                        mensaje.innerHTML = 'Error: ya existeix un camp amb el nom ' + '"' + data.duplicado + '"';
                        setTimeout(() => {
                            mensaje.style.display = "none"; 
                        }, 2000); 

                        let inputs = document.querySelectorAll('input.campo');
    
                        inputs.forEach((input, index) => {
                            // Restaurar el valor original desde camposActuales
                            input.value = camposActuales[index];
                        });
                    }
                })
            })
        }
    })
}