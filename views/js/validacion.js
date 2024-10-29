document.addEventListener('DOMContentLoaded', function(){
    let enviarBtn = document.getElementById('enviar');

    enviarBtn.addEventListener('click', function(){
        datos()
    })
})

function datos(){
    let elementos = document.getElementsByClassName("pruebaAjax");
    let arrayElementos = Array.from(elementos);
    
}


