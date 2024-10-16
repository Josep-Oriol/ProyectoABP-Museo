document.addEventListener('DOMContentLoaded', function() {
    const busquedaUsuario = document.getElementById('busqueda'); //obtenemos el elemento donde escribimos la busqueda, lo guardamos en la constante 'busqueda'
    const buscar = document.getElementById('buscar'); //obtenemos el boton que usamos para ejecutar la busqueda' constante 'buscar'

    buscar.addEventListener('click', function() { // Agregamos un 'escuchador de eventos' que se ejecutará cuando se haga clic en 'buscar'
        realizarBusqueda(); // Llama a la función que realiza la búsqueda
    });

    busquedaUsuario.addEventListener('keypress', function(event) { // Agregamos un 'escuchador de eventos' para la tecla 'Enter'
        if (event.key === 'Enter') { // Verificamos si la tecla presionada es 'Enter'
            event.preventDefault(); // Evitamos que se envíe un formulario si está dentro de uno
            realizarBusqueda(); // Llama a la función que realiza la búsqueda
        }
    });

    function realizarBusqueda() { // Función que contiene la lógica de búsqueda
        const busqueda = busquedaUsuario.value.toLowerCase(); // Convertir la consulta a minúsculas
        const filas = document.querySelectorAll('tbody tr'); // Recojemos en la constante 'filas' todas las filas del tbody

        // Mostramos siempre la primera fila (encabezado)
        filas[0].style.display = ''; // Aseguramos que la primera fila esté visible

        // Iteramos sobre las demás filas (empezando desde la segunda fila)
        for (let i = 1; i < filas.length; i++) { // Iniciamos el bucle desde 1 para omitir la primera fila
            const tituloObra = filas[i].cells[3].textContent.toLowerCase(); // Obtiene el contenido textual de la fila 'Titulo'
            if (tituloObra.includes(busqueda)) { // Si el campo 'Titulo' de esa fila coincide con el valor de la constante 'busqueda'
                filas[i].style.display = ''; // Mostrar fila si coincide
            } else {
                filas[i].style.display = 'none'; // Ocultar fila si no coincide
            }
        }
    }

    // Evento para mostrar todas las obras si el campo de búsqueda está vacío y se hace clic fuera de él
    
    document.addEventListener('click', function(event) {
        if (!busquedaUsuario.contains(event.target) && busquedaUsuario.value.trim() === '') {
            mostrarTodasLasObras(); // Llama a la función para mostrar todas las obras
        }
    });

    function mostrarTodasLasObras() { // Función para mostrar todas las obras
        const filas = document.querySelectorAll('tbody tr'); // Recojemos en la constante 'filas' todas las filas del tbody

        // Mostramos siempre la primera fila (encabezado)
        filas[0].style.display = ''; // Aseguramos que la primera fila esté visible

        // Iteramos sobre las demás filas (empezando desde la segunda fila)
        for (let i = 1; i < filas.length; i++) { // Iniciamos el bucle desde 1 para omitir la primera fila
            filas[i].style.display = ''; // Mostrar todas las filas
        }
    }

});
 

