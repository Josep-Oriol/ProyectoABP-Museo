document.addEventListener('DOMContentLoaded', function() {
    let etiquetaUsuario = document.getElementById('etiquetaUsuario');
    let inputUsuario = document.getElementById('usuario');
    
    inputUsuario.addEventListener('change', function() {
        console.log(inputUsuario.value);
        if (inputUsuario.value.length == 0) {
            inputUsuario.style.border = '2px solid red';
        }
    });
});