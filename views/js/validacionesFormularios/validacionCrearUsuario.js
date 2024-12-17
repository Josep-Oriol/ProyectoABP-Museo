document.addEventListener("DOMContentLoaded", function () {
  let inputsForm = document.getElementsByClassName("userForm");
  let inputImg = document.getElementById("fotoForm");
  let form = document.getElementById("Form");

  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      let enviar = Array.from(inputsForm).every(validar); //every comprueba  que ninguno de los campos este vacio, some comprueba que almenos uno no este vacio

      enviar ? form.submit() : alert("Revisa los campos");
    });

    function validar(input) {
      return input.value.trim() !== "" && input.value.trim() !== "ñ";
    }
  }
});
