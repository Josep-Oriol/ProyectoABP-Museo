document.addEventListener("DOMContentLoaded", function(){
    const inputBuscar = document.getElementById("busqueda")
    
    if(inputBuscar){
        inputBuscar.addEventListener("input", function(event){
            let dato = inputBuscar.value
            mostrarDatos(dato)
        })
    }

    function mostrarDatos(dato){
        let data ={
            "busqueda": dato
        }
        let dataJson = JSON.stringify(data)

        fetch('ajax.php?controller=Buscador&action=buscar', {
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
            const tbody = document.querySelector('#tabla tbody');
            const primer_tr = document.getElementById('primer_tr')
            tbody.innerHTML = primer_tr.outerHTML

            exposiciones.forEach(exposicion => {
                let tr = document.createElement('tr')

                let tdId = document.createElement('td')
                tdId.textContent = exposicion.id_exposicion

                let tdDescripcion = document.createElement('td')
                tdDescripcion.textContent = exposicion.texto_exposicion

                let tdTipo = document.createElement('td')
                tdTipo.textContent = exposicion.tipo_exposicion

                let tdLugar = document.createElement('td')
                tdLugar.textContent = exposicion.lugar_exposicion

                let tdInicio = document.createElement('td')
                tdInicio.textContent = exposicion.fecha_inicio_exposicion

                let tdFinal = document.createElement('td')
                tdFinal.textContent = exposicion.fecha_fin_exposicion


                let tdBtn = document.createElement('td')
                
                let link1 = document.createElement('a');
                link1.href = `index.php?controller=Exposiciones&action=Pantallaeditar&id=${exposicion.id_exposicion}`;
                let img1 = document.createElement('img');
                img1.src = 'images/editarv2.png';
                img1.alt = 'Editar';
                link1.appendChild(img1);

                let link2 = document.createElement('a');
                link2.href = `index.php?controller=Exposiciones&action=fichaExposiciones&id=${exposicion.id_exposicion}`;
                let img2 = document.createElement('img');
                img2.src = 'images/fichav2.png';
                img2.alt = 'Ficha';
                link2.appendChild(img2);

                let link3 = document.createElement('a');
                link3.href = `index.php?controller=Exposiciones&action=eliminar&id=${exposicion.id_exposicion}`;
                link3.id = exposicion.id_exposicion;
                let img3 = document.createElement('img');
                img3.src = 'images/borrarv2.png';
                img3.alt = 'Eliminar';
                link3.appendChild(img3);

                // Agregar los enlaces al td
                tdBtn.appendChild(link1);
                tdBtn.appendChild(link2);
                tdBtn.appendChild(link3);

                tr.appendChild(tdId)
                tr.appendChild(tdDescripcion)
                tr.appendChild(tdTipo)
                tr.appendChild(tdLugar)
                tr.appendChild(tdInicio)
                tr.appendChild(tdFinal)
                tr.appendChild(tdBtn)

                tbody.appendChild(tr)
                console.log(tbody)
            });
        })
        
        .catch(error => {
            console.error('Error:', error);
        })
    }
})