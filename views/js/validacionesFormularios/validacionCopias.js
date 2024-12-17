document.addEventListener("DOMContentLoaded", function(event){
    const inputFile = document.querySelector('input[name="fichero_sql"]');
    const popupSQL = document.querySelector("#popupSQL");
    const form = document.querySelector("#formSQL");
    
    const cancelarBtn = document.querySelector("#btnCancelarSQL")
    cancelarBtn.addEventListener("click", function(event){
        popupSQL.style.display = "none";
        console.log(inputFile.files[0].name)
        inputFile.value = "";
        console.log(inputFile.value)
    })

    const confirmarBtn = document.querySelector("#btnConfirmarSQL")
    confirmarBtn.addEventListener("click", function(){
        form.submit()
        popupSQL.style.display = "none";
    })
    

    console.log(inputFile);
    inputFile.addEventListener("change", function(event){
        event.preventDefault()
        popupSQL.style.display = "block";

    })
})