document.addEventListener("DOMContentLoaded", function(){
    const inputExposiciones = document.getElementById("busqueda")
    const url = window.location.href;
    let pagina = url.includes("Exposiciones") ? "exposiciones" : url.includes("Obras") ? "obras" : url.includes("Usuarios") ? "usuarios" : null;

    if(inputExposiciones){
        inputExposiciones.addEventListener("input", function(event){
            let dato = inputExposiciones.value
            mostrarDatos(dato, pagina)
        })
    }

    function mostrarDatos(dato, pagina){
        let data ={
            "busqueda": dato,
            "pagina": pagina
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
            const tbody = document.querySelector('tbody');
            const primer_tr = document.querySelector('tr')
            tbody.innerHTML = primer_tr.outerHTML
            
            exposiciones.forEach(exposicion => {
                let tr = document.createElement('tr')
                let cont = 0; 
                for(let dato in exposicion){
                    let td = document.createElement('td')

                    
                    if(exposicion[dato] && typeof exposicion[dato] === 'string' && exposicion[dato].includes("images/")){
                        let img = document.createElement('img')
                        img.src = exposicion[dato]
                        img.alt = ""
                        td.appendChild(img)
                    }
                    else{
                        td.textContent = exposicion[dato]
                    }

                    tr.appendChild(td)
                }
                td_botones = document.createElement('td')
                tr.appendChild(td_botones)

                link1 = document.createElement('a')
                img1 = document.createElement('img')
                img1.src = 'images/editarv2.png'
                link1.appendChild(img1)
                
                link2 = document.createElement('a')
                img2 = document.createElement('img')
                img2.src = 'images/fichav2.png'
                link2.appendChild(img2)
 
                link3 = document.createElement('a')
                img3 = document.createElement('img')
                img3.src = 'images/borrarv2.png'
                link3.appendChild(img3)

                id = pagina === "obras" ? exposicion.numero_registro : pagina === "exposiciones" ? exposicion.id_exposicion : pagina === "usuarios" ? exposicion.id_usuario : null

                console.log(exposicion)
                link1.href = data.url[0] + id
                link2.href = data.url[1] + id
                link3.href = data.url[2] + id

                td_botones.appendChild(link1)
                td_botones.appendChild(link2)
                td_botones.appendChild(link3)

                tr.appendChild(td_botones)

                tbody.appendChild(tr)
            });
        })
        
        .catch(error => {
            console.error('Error:', error);
        })
    }
})