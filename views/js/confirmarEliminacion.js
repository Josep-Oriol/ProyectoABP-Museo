let usuarioId = null; // Variable para almacenar el ID del usuario a eliminar

function mostrarPopup(id) {
    usuarioId = id; // Almacena el ID del usuario
    document.getElementById("popup").style.display = "block"; // Muestra el popup
}

function cerrarPopup() {
    document.getElementById("popup").style.display = "none"; // Oculta el popup
}

function confirmarEliminacion() {
    if (usuarioId !== null) {
        // Redirigir a la acción de eliminación
        window.location.href = `index.php?controller=Usuarios&action=eliminar&id=${usuarioId}`;
    }
}
