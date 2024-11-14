document.addEventListener("DOMContentLoaded", function(){
    const inputExposiciones = document.getElementById("busqueda")
    
    if(inputExposiciones){
        inputExposiciones.addEventListener("input", function(event){
            let dato = inputExposiciones.value
            mostrarDatos(dato)
        })
    }

    function mostrarDatos(dato){
        let data ={
            "busqueda": dato
        }
        let dataJson = JSON.stringify(data)

        fetch('ajaxUbicaciones.php?controller=Buscador&action=buscar', {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body :dataJson
        })
        .then(response => response.json())

        .then(data => {
            exposiciones = data.texto
            const tbody = document.querySelector('tbody');
            const primer_tr = document.querySelector('tr')
            tbody.innerHTML = primer_tr.outerHTML

            exposiciones.forEach(exposicion => {
                let tr = document.createElement('tr')

                for(let dato in exposicion){
                    let td = document.createElement('td')
                    td.textContent = exposicion[dato]

                    tr.appendChild(td)
                }

                tbody.appendChild(tr)
                console.log(tbody)
            });
        })
        
        .catch(error => {
            console.error('Error:', error);
        })
    }
})