document.addEventListener("DOMContentLoaded", function() {
    const campos = document.getElementById("campos")
    if(campos){
        campos.addEventListener("submit", function(event) {
            event.preventDefault();
    
            const inputs = document.querySelectorAll(".campo");
            const valuesSet = new Set();
            let hasDuplicates = false;
            
            inputs.forEach(input => {
                const value = input.value.trim(); // Obtiene el valor del campo
                if (valuesSet.has(value)) {
                    hasDuplicates = true; // Si ya existe el valor, marca que hay duplicados
                } else {
                    valuesSet.add(value); // Añade el valor al Set
                }
            });
            
            if (hasDuplicates) {
                alert("Hay campos duplicados.")
            }else {
                this.submit();
            }
            location.reload()
        }); 
    }
});