document.addEventListener("DOMContentLoaded", function () {

    const url = window.location.href;
    let pagina = url.includes("Exposiciones") ? "exposiciones" : url.includes("Obras") ? "obras" : url.includes("Usuarios") ? "usuarios" : null;
    let nombreColumna = pagina === "exposiciones" ? "exposicion" : pagina === "obras" ? "numero_registro" : pagina === "usuarios" ? "usuario" : null; 

    const popUps = document.getElementsByClassName('popupEliminar');
    Array.from(popUps).forEach((popUp) => {
        popUp.style.display = 'none'; // Cambia el estilo de cada elemento
    });

    const btnEliminar = document.getElementsByClassName('eliminarRegistro'); // Seleccionar por clase

    // Iterar sobre todos los elementos con la clase 'eliminarRegistro'
    Array.from(btnEliminar).forEach((button) => {
        
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            const idRegistro = button.getAttribute('id'); // Obtenemos la clase (o puedes usar otro atributo como `data-id`)
            Array.from(popUps).forEach((popUp) => {
                popUp.style.display = 'block'; // Cambia el estilo de cada elemento
                
                let btnEliminar = popUp.getElementsByClassName('btnEliminarRegistro')
                let btnCancelar = popUp.getElementsByClassName('btnCancelarEliminacion')
                Array.from(btnCancelar).forEach((btn) => {
                    btn.addEventListener('click', function(){
                        Array.from(popUps).forEach((popUp) => {
                            popUp.style.display = 'none'; // Cambia el estilo de cada elemento
                        });
                    })
                })
                if(button){
                    let data = {
                        id: idRegistro,
                        apartado: pagina,
                        columna: nombreColumna
                    }
                    let dataJson = JSON.stringify(data)
                    console.log(dataJson)
                    Array.from(btnEliminar).forEach((btn) => {
                        btn.addEventListener('click', function(){
                            fetch('ajax.php?controller=Eliminar&action=eliminarRegistro', {
                                method: 'POST',
                                headers:{
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: dataJson
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.status == 'success'){
                                    Array.from(popUps).forEach((popUp) => {
                                        popUp.style.display = 'none'; // Cambia el estilo de cada elemento
                                    });
                                    let filaEliminar = document.querySelector('tr[id="' + idRegistro + '"]');
                                    filaEliminar.remove();
                                }
                            })
                        })
                    })
                }  
            });
        });
    });
});