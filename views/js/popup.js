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
        console.log(controller);
        return "index.php?controller=" + controller + "&action=eliminar&id=" + id;
    }

    function accionEliminar(url, id) {
        mostrarPopupEliminar();
        let botonConfirmar = document.querySelector('#confirmar-btn');
        let botonCancelar = document.getElementById('cancelar-btn');
        botonCancelar.addEventListener('click', cerrarPopupEliminar);
        botonConfirmar.addEventListener('click', function() {
            window.location.href = URLRedireccion(url, id);
            console.log(url);

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
            console.log(id);
            accionEliminar(url, id);
        });
    });
});