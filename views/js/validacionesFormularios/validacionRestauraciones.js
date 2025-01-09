document.addEventListener("DOMContentLoaded", function() {

    const datalist = document.getElementById("obras");
    const opcionesObras = datalist.querySelectorAll("option");
    const obra = document.getElementById("obraRelacionada");
    const form = document.querySelector("form");
    const array = [];

    opcionesObras.forEach(option => {
        array.push(option.value)
    });
    
    console.log(array);
    form.addEventListener("submit", function(event){
      event.preventDefault();
      if(array.includes(obra.value)){
        form.submit();
      }
      else{
        alert("La obra seleccionada no existe");
      }
    })

});
