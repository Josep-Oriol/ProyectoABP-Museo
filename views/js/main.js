document.addEventListener('DOMContentLoaded', function() {
    const popupErroresForm = document.getElementById('popupFormulario');
    const cerrarPopup = document.getElementById('btnCerrar');
    cerrarPopup.addEventListener('click', function() {
        popupErroresForm.style.display = 'none';
    });
});