
function ejecutarFuncionesMostrar(id, boton) {
    mostrarHijos(id, boton); // Llama a la función para mostrar hijos
}
function mostrarHijos(id, boton) {
    console.log("ID recibido:", id);
let divHijos = $("#hijos-" + id); //variable que almacena el contenedor de los hijos 
    
    // Verificar si los hijos ya fueron cargados previamente
    if (divHijos.data("loaded")) {
        divHijos.toggle(); // Alterna visibilidad si ya están cargados
        rotarImagen(boton, divHijos.is(':visible'));
        return;
    }
    // Desactivar el botón mientras se carga
    $(boton).prop("disabled", true);
    
        $.ajax({
            url: 'ajax.php?controller=Vocabularios&action=cargarHijos&ajax=true', //php que gestiona la solicitud  
            type: 'GET',
            data: { id_padre: id }, //enviamos la id_ubicacion (id) del padre a la funcion cargarHijos de VocabulariosController, es decir a la url
            success: function(hijos) { /* si la respuesta es exitosa, recibe los hijos que ha enviado 'cargarHijos', que es un array en formato
            json */
                 
            if (hijos.length > 0) { // si el array hijos tiene contenido, es decir si esa ubicacion tiene hijos
                        
                hijos.forEach(function(hijo) { //por cada hijo se ejecuta la funcion pasandole por parametro el hijo
                divHijos.append(`
                <div class="inputsDiv">
                    <button onclick="ejecutarFuncionesMostrar(${hijo.id_ubicacion}, this)"><img src="images/flecha_derecha.png" ></button>
                    <input type='text' name='${hijo.id_padre}' id='${hijo.id_ubicacion}' value='${hijo.descripcion_ubicacion}' />
                    <button onclick="eliminarHijos(${hijo.id_ubicacion})"><img class="eliminarUbi" src="images/basura.png"></button>
                    <form action="index.php?controller=Vocabularios&action=crearUbicacionHija" method="POST">
                        <input type="hidden" name="id_ubicacion" value='${hijo.id_ubicacion}'>
                        <button type="submit" title="Afegir ubicació"><img src="images/mas.png"></button> <!-- Boton para añadir una ubicacion -->
                    </form>
                    <img class="historial" src="images/historial.png" id="historial">
                </div>
                    <div id='hijos-${hijo.id_ubicacion}' style='display:none; padding-left: 5vw'></div>
                    `); //agregamos este contenido al div 'divHijos' con el 'divHijos.append'
                });    
            }
                divHijos.data("loaded", true);
                divHijos.toggle(); // despues de añadir el contenido html a divHijos, lo muestra.
                rotarImagen(boton, divHijos.is(':visible')); //ejecutamos el metodo de rotar imagen diciendole (con el true) que estamos mostrando los hijos.
            },
            complete: function() {
                $(boton).prop("disabled", false); // Reactivar el botón después de completar la solicitud
            }
        });
    }

function rotarImagen(boton, mostrar) {
    const imagen = boton.querySelector("img"); 
    imagen.style.transform = mostrar ? "rotate(90deg)" : "rotate(0deg)"; //si 'divHijos' es visible, se rota la imagen, si es false, vuelve a su posicion original
}

function eliminarHijos(id_ubicacion){
    let data = {
        id_ubicacion : id_ubicacion
    }

    let dataJson = JSON.stringify(data)

    fetch('ajax.php?controller=Vocabularios&action=eliminarUbicacionHija', {
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
            document.getElementById(id_ubicacion).parentNode.remove();
            location.reload();
        }else{
            let popUp = document.getElementById('popUpUbicaciones');
            popUp.style.display = 'flex';

            setTimeout(() => {
                popUp.style.display = "none"; 
            }, 3000);
        }
    })
}

document.addEventListener('DOMContentLoaded', function() {
    const botones = document.getElementsByClassName('historial')

    Array.from(botones).forEach(boton => {
        boton.addEventListener('click', function(){
            let div = document.getElementById('div_' + boton.id)

            let data = {
                id_ubicacion: boton.id
            }
            let dataJson = JSON.stringify(data);
            
            fetch('ajax.php?controller=Vocabularios&action=mostrarHistorial', {
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body :dataJson
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
            })
        })
    })
})

