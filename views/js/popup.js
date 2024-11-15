document.addEventListener("DOMContentLoaded", function(){
    const openBtn = document.getElementById("filtro");
    const cerrar = document.querySelector('.close-btn');

    const popup = document.querySelector('.popup-overlay');
    const form = document.getElementById("filter-from"); 


    if(openBtn){
        openBtn.addEventListener("click", function(){
            popup.style.display = "flex";
        });
    
        cerrar.addEventListener("click", function(){
            popup.style.display = "none";
        });
    }

    const sendBtn = document.getElementById("btn-apply");

    sendBtn.addEventListener("click", function(){
        const datosFormulario = new FormData(form)
        const datos = {};

        datosFormulario.forEach((clave , valor) => {
            datos[valor] = clave;
        });
        console.log(datos);
    })
})