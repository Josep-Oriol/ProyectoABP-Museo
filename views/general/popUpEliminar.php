<div id="popup" class="popup" style="display: none;" onclick="cerrarPopup()">
    <div onclick="event.stopPropagation()">
        <img src="images/senal-de-advertencia.png" alt="advertencia">
        <p>Estàs segur que vols eliminar aquest usuari?</p>
        <div>
            <button id="confirmar-btn" onclick="confirmarEliminacion()">Eliminar</button>
            <button onclick="cerrarPopup()">Cancelar</button>
        </div>
    </div>
</div>