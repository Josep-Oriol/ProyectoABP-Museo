document.addEventListener("DOMContentLoaded", function() {
    function showPopup() {
        document.getElementById("popup-overlay").style.display = "flex";
    }

    const fichaBtn = document.getElementById("fichaBtn");
    if (fichaBtn) { // Verifica si el elemento existe
        fichaBtn.addEventListener("click", function(event) {
            event.preventDefault(); // Evita la acción predeterminada del enlace
            showPopup();
        });
    }
});