document.addEventListener('DOMContentLoaded', function() {
    let popupEliminar = document.getElementById('popupEliminar');
    let iconosEliminar = document.querySelectorAll('.iconoEliminar');

    function mostrarPopupEliminar() {
        popupEliminar.style.display = 'block';
    }

    function cerrarPopupEliminar() {
        popupEliminar.style.display = 'none';
    }

    function obtenerURL() {
        return window.location.search;
    }

    function URLRedireccion(url, id) {
        let variablesURL = new URLSearchParams(url);
        let controller = variablesURL.get('controller');

        return "index.php?controller=" + controller + "&action=eliminar&id=" + id;
    }

    function accionEliminar(url, id) {
        mostrarPopupEliminar();
        let botonConfirmar = document.querySelector('#confirmar-btn');
        let botonCancelar = document.getElementById('cancelar-btn');
        botonCancelar.addEventListener('click', cerrarPopupEliminar);
        botonConfirmar.addEventListener('click', function() {
            window.location.href = URLRedireccion(url, id);

            window.location.href = url;
        });
    }

    iconosEliminar.forEach(icono => {
        // Recorremos el array de elementos con esa clase y le añadimos el evento para mostrar el popup.
        icono.addEventListener('click', function(event) {
            // Detenemos la ejecución al darle clic y mostramos el popup.
            event.preventDefault();
            let url = obtenerURL();
            let id = this.id;

            accionEliminar(url, id);
        });
    });
    // Popup filtro
    const closeBtn = document.getElementsByClassName("close-btn")
    closeBtn.addEventListener("click", function(){
        let popup = document.getElementsByClassName("popup-overlay")
        popup.style.display = none;
    })

    const filtroBtn = document.getElementsByClassName("filtro")
    filtroBtn.addEventListener("click", function(){
        let popup = document.getElementsByClassName("popup-overlay")
        popup.style.display = flex;
    })
    
});