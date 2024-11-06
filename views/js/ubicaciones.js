function ejecutarFuncionesMostrar(id, boton) {
    console.log("Botón clicado:", boton);
    console.log("Ejecutando mostrar hijos para ID:", id);
    mostrarHijos(id); // Llama a la función para mostrar hijos
    rotarImagen(boton); // Llama a la función para cambiar la imagen
}
function mostrarHijos(id) {
let divHijos = $("#hijos-" + id); //variable que almacena el contenedor de los hijos 
    
    if (divHijos.is(':empty')) { /* comprueba si el div de los hijos esta vacio, si esta vacio
        significa que no se han cargado los hijos de esa ubicacion, asi que ejecuta el AJAX */
        $.ajax({
            url: 'ajaxUbicaciones.php?controller=Vocabularios&action=cargarHijos&ajax=true', //php que gestiona la solicitud  
            type: 'GET',
            data: { ID_padre: id }, //enviamos la id_ubicacion (id) del padre a la funcion cargarHijos de VocabulariosController, es decir a la url
            success: function(hijos) { /* si la respuesta es exitosa, recibe los hijos que ha enviado 'cargarHijos', que es un array en formato
            json */
                 
            if (hijos.length > 0) { // si el array hijos tiene contenido, es decir si esa ubicacion tiene hijos
                        
                hijos.forEach(function(hijo) { //por cada hijo se ejecuta la funcion pasandole por parametro el hijo
                divHijos.append(`
                <div class="inputsDiv">
                    <button onclick="mostrarHijos(${hijo.ID_ubicacion})"><img src="images/flecha_derecha.png" alt=""></button>
                    <input type='text' name='${hijo.ID_padre}' id='${hijo.ID_ubicacion}' value='${hijo.Descripcion_ubicacion}' />
                    <button>+</button>
                </div>
                    <div id='hijos-${hijo.ID_ubicacion}' style='display:none; padding-left: 5vw'></div>
                    `); //agregamos este contenido al div 'divHijos' con el 'divHijos.append'
                });    
            }
                divHijos.toggle(); // despues de añadir el contenido html a divHijos, lo muestra.  
            }
        });
    } else {
        divHijos.toggle(); // si divHijos esta lleno, es decir que ya estamos mostrando los hijos, los escondemos
    }
}

let angulo = 0; // Inicializa un ángulo para rotar la imagen

function rotarImagen(boton) {
    const imagen = boton.querySelector("img"); 
    
    if(angulo === 0){
        angulo += 90;
    }else{
        angulo -=90;
    } 
     
    imagen.style.transform = `rotate(${angulo}deg)`;
}