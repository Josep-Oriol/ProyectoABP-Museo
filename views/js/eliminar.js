document.addEventListener("DOMContentLoaded", function(){
    const btnRelacion = document.getElementsByClassName("btnRelaciones");

    if(btnRelacion){
        Array.from(btnRelacion).forEach(btn => {
            btn.addEventListener('click', function(event){
                let array = btn.id.split(['&'])
                
                let idObra = array[0]
                let idExposicion = array[1]
                let data ={
                    idObra : idObra,
                    idExposicion : idExposicion
                };

                let dataJson = JSON.stringify(data)

                fetch('ajaxUbicaciones.php?controller=Exposiciones&action=eliminarRelacionesFicha', {
                    method: 'POST',
                    headers:{
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                    },
                    body :dataJson
                })
                .then(response => response.json())
                .then(data => {
                    if(data.filas > 0){
                        console.log(data.obra + data.exposicion)
         
                        tr = document.getElementById("tr_" + data.obra)
                        tr.remove()
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
            })      
        });
    }
})