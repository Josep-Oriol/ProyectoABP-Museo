document.addEventListener('DOMContentLoaded', function() {
    let popupEliminar = document.getElementById('popupEliminar');
    let iconosEliminar = document.querySelectorAll('.iconoEliminar');

    function mostrarPopupEliminar() {
        popupEliminar.style.display = 'block';
    }

    function cerrarPopupEliminar() {
        popupEliminar.style.display = 'none';
    }

    function URLRedireccion(id) {
        const URL = window.location.search;
        console.log(URL);
        let variablesURL = new URLSearchParams(URL);
        let controller = variablesURL.get('controller');
        console.log(controller);
        return "index.php?controller=" + controller + "&action=eliminar&id=" + id;
    }

    function accionEliminar(id) {
        mostrarPopupEliminar();
        let botonConfirmar = document.querySelector('#confirmar-btn');
        let botonCancelar = document.getElementById('cancelar-btn');
        botonCancelar.addEventListener('click', cerrarPopupEliminar);
        botonConfirmar.addEventListener('click', function() {
            window.location.href = URLRedireccion(id);
        });
    }

    iconosEliminar.forEach(icono => {
        // Recorremos el array de elementos con esa clase y le añadimos el evento para mostrar el popup.
        icono.addEventListener('click', function(event) {
            // Detenemos la ejecución al darle clic y mostramos el popup.
            event.preventDefault();
            let id = this.id;
            console.log(id);
            accionEliminar(id);
        });
    });
});