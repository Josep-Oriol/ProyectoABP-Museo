let url = window.location.href;
let pagina = url.includes("mostrarCamposVocabulario") ? "Vocabulario" : null;

const paramsUrl = new URLSearchParams(window.location.search);
let id = paramsUrl.get("id");
const nombreCampo = paramsUrl.get("nombre");

const relaciones = {
  Tècnica: "Codi Getty tècnica",
  Material: "Codi Getty material",
};

let dataAsociar = {};

if (pagina != null) {
  document.addEventListener("DOMContentLoaded", function () {
    const btnEliminar = document.getElementById("eliminarCampos");
    const btnCrear = document.getElementById("crearCampo");
    const btnEditar = document.getElementById("editar");
    const inputRellenado = document.getElementById("crearCampoInput");

    // ESTILO BOTON ELIMINAR DEPENDIENDO DEL ESTADO DE LOS CHECKBOX

    let checkboxes = document.querySelectorAll('input[type="checkbox"]');

    function cambiarEstiloBotonEliminar() {
      checkboxes = document.querySelectorAll('input[type="checkbox"]');

      let hayCheckboxSeleccionado = Array.from(checkboxes).some(
        (checkbox) => checkbox.checked
      );

      if (!hayCheckboxSeleccionado) {
        btnEliminar.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
        btnEliminar.style.border = "none";
        btnEliminar.style.animation = "none";
      } else {
        btnEliminar.style.backgroundColor = "";
        btnEliminar.style.border = "";
        btnEliminar.style.animation = "";
      }
    }

    setInterval(cambiarEstiloBotonEliminar, 100);

    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", cambiarEstiloBotonEliminar); // Para actualizar cuando el usuario cambia el estado
    });

    cambiarEstiloBotonEliminar();

    // CREAR CAMPOS CON ENTER SI HAY ALGUN VALOR EN EL INPUT DE CREAR

    inputRellenado.addEventListener("keydown", function (event) {
      const valorInput = inputRellenado.value.trim();
      if (event.key === "Enter" && valorInput !== "") {
        event.preventDefault();
        btnCrear.click();
      }
    });

    // NO PERMITIR CREAR CAMPOS EN BLANCO

    function comprobarContenidoInput() {
      if (inputRellenado.value.trim() !== "") {
        btnCrear.disabled = false;
      } else {
        btnCrear.disabled = true;
      }
    }

    inputRellenado.addEventListener("input", comprobarContenidoInput);

    setInterval(comprobarContenidoInput, 100);

    // NO PERMITIR CREAR CAMPOS DUPLICADOS

    let camposCreados = [];

    function revisarInputs() {
      camposCreados = Array.from(document.querySelectorAll("input.campo"));
    }

    revisarInputs();

    if (btnEliminar) {
      btnEliminar.addEventListener("click", function () {
        let checkboxesMarcados = document.querySelectorAll(
          'input[type="checkbox"]:checked'
        );

        let idsSeleccionados = [];

        checkboxesMarcados.forEach((checkBox) => {
          let id = checkBox.id;
          idsSeleccionados.push(id);
        });

        let data = {
          idsSeleccionados: idsSeleccionados,
        };

        let dataJson = JSON.stringify(data);

        fetch("ajax.php?controller=Vocabularios&action=EliminarCampos", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: dataJson,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "success") {
              let divTotales = document.querySelectorAll(".input-group");

              let divEliminar = [];

              divTotales.forEach((div) => {
                idsSeleccionados.forEach((idSeleccionada) => {
                  if (div.id == idSeleccionada) {
                    divEliminar.push(div);
                  }
                });
              });
              divEliminar.forEach((div) => {
                div.remove();
              });
            }
          })
          .catch((error) => console.error("Error en la solicitud:", error));
      });
    }

    if (btnCrear) {
      btnCrear.addEventListener("click", function () {
        event.preventDefault();
        const input = document.getElementById("crearCampoInput");

        revisarInputs();

        const existeCampo = camposCreados.some(
          (campo) => campo.value === input.value.trim()
        );

        if (!existeCampo) {
          let id = input.name;
          let nombre = input.value;

          let data = {
            id: id,
            nombre: nombre,
          };

          let fetchurl;
          if (
            nombreCampo == "Codi Getty tècnica" ||
            nombreCampo == "Codi Getty material"
          ) {
            fetchurl =
              "ajax.php?controller=Vocabularios&action=crearCampoGetty";
          } else {
            fetchurl = "ajax.php?controller=Vocabularios&action=crearCampo";
          }

          let dataJson = JSON.stringify(data);

          fetch(fetchurl, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest",
            },
            body: dataJson,
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.status === "success") {
                const nuevoDiv = document.createElement("div");
                nuevoDiv.classList.add("input-group");
                nuevoDiv.id = `${nombre}`;

                const nuevoInput = document.createElement("input");
                nuevoInput.classList.add("campo");
                nuevoInput.type = "text";
                nuevoInput.name = nombre;
                nuevoInput.id = nombre;
                nuevoInput.value = nombre;
                nuevoInput.autocomplete = "off";

                const nuevoCheckbox = document.createElement("input");
                nuevoCheckbox.classList.add("campo-checkbox");
                nuevoCheckbox.type = "checkbox";
                nuevoCheckbox.name = `${nombre}_checkbox`;
                nuevoCheckbox.id = `${nombre}`;

                nuevoDiv.appendChild(nuevoInput);
                nuevoDiv.appendChild(nuevoCheckbox);

                const formulario = document.getElementById("campos");

                const ultimoDiv = formulario.querySelector(
                  "div.input-group:last-of-type"
                );

                if (ultimoDiv) {
                  ultimoDiv.parentNode.insertBefore(
                    nuevoDiv,
                    ultimoDiv.nextSibling
                  );
                }

                const campoInput = document.getElementById("crearCampoInput");
                campoInput.value = "";

                camposActuales = Array.from(
                  document.querySelectorAll("input.campo")
                ).map((campo) => campo.value);
              }
            });
        }
      });
    }

    let camposActuales = Array.from(
      document.querySelectorAll("input.campo")
    ).map((campo) => campo.value);
    let mensaje = document.getElementById("mensajeEditado");

    if (btnEditar) {
      btnEditar.addEventListener("click", function () {
        let camposEditados = Array.from(
          document.querySelectorAll("input.campo")
        ).map((campo) => campo.value);

        let data = {
          antiguoValor: camposActuales,
          nuevoValor: camposEditados,
        };

        let dataJson = JSON.stringify(data);

        fetch("ajax.php?controller=Vocabularios&action=editarCampos", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: dataJson,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status === "success") {
              mensaje.style.display = "block";
              mensaje.style.color = "green";
              mensaje.innerHTML = "Camps editats amb exit";

              setTimeout(() => {
                mensaje.style.display = "none";
              }, 3000);

              camposActuales = Array.from(
                document.querySelectorAll("input.campo")
              ).map((campo) => campo.value);
            } else if (data.status === "sinCambios") {
              console.log(data.status);
            } else if (data.status === "repetidos") {
              mensaje.style.display = "block";
              mensaje.style.color = "red";
              mensaje.innerHTML =
                "Error: ya existeix un camp amb el nom " +
                '"' +
                data.duplicado +
                '"';

              setTimeout(() => {
                mensaje.style.display = "none";
              }, 3000);

              let inputs = document.querySelectorAll("input.campo");

              inputs.forEach((input, index) => {
                // Restaurar el valor original desde camposActuales
                input.value = camposActuales[index];
              });
            } else if (data.status === "vacio") {
              mensaje.style.display = "block";
              mensaje.style.color = "red";
              mensaje.innerHTML = "Error: no hi poden haver camps buits";

              let inputs = document.querySelectorAll("input.campo");

              inputs.forEach((input, index) => {
                // Restaurar el valor original desde camposActuales
                input.value = camposActuales[index];
              });

              setTimeout(() => {
                mensaje.style.display = "none";
              }, 3000);
            }
          });
      });
      camposActuales = Array.from(document.querySelectorAll("input.campo")).map(
        (campo) => campo.value
      );
    }

    const botonesGetty = document.querySelectorAll(".codigosGetty");

    botonesGetty.forEach((boton) => {
      boton.addEventListener("click", function () {
        const texto = this.getAttribute("id");
        dataAsociar = {};
        dataAsociar.nombreTexto = texto;
        obtenerCodigosGetty(nombreCampo);
      });
    });

    function obtenerCodigosGetty(nombre) {
      let nombreCampoFetch;

      if (relaciones[nombre]) {
        nombreCampoFetch = relaciones[nombre];
      }
      const data = { nombre: nombreCampoFetch };

      const dataJson = JSON.stringify(data);

      fetch("ajax.php?controller=Vocabularios&action=obtenerCodigosGetty", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: dataJson,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Respuesta recibida:", data);

          if (Array.isArray(data)) {
            data = data[0];
          }

          if (data.status === "success") {
            console.log("La solicitud fue exitosa");
            mostrarCodigosGetty(data.codigos);
          } else {
            console.error("Error:", data.mensaje);
          }
        })
        .catch((error) => console.error("Error en la petición:", error));
    }

    function mostrarCodigosGetty(data) {
      const contenedor = document.getElementById("codigosGetty");
      contenedor.innerHTML = "";

      const codigos = Array.isArray(data) ? data : Object.values(data);
      if (codigos.length) {
        codigos.forEach((item) => {
          // Crear contenedor para cada código
          const itemDiv = document.createElement("div");
          itemDiv.classList.add("codigo-getty-item");

          // Acceder a la propiedad 'codigo' del objeto
          const spanCodigo = document.createElement("span");
          spanCodigo.textContent = item;

          // Crear botón "Añadir"
          const botonAgregar = document.createElement("button");
          botonAgregar.classList.add("asociarCodigoGetty");
          botonAgregar.setAttribute("id", item);
          botonAgregar.textContent = "Añadir";

          // Evento para el botón
          botonAgregar.addEventListener("click", () => {
            console.log(`Código seleccionado: ${item}`);
            alert(`Código ${item.codigo} asociado correctamente.`);
          });

          // Agregar elementos al contenedor
          itemDiv.appendChild(spanCodigo);
          itemDiv.appendChild(botonAgregar);
          contenedor.appendChild(itemDiv);
        });
      } else {
        const mensaje = document.createElement("p");
        mensaje.textContent = "No hay códigos Getty disponibles.";
        contenedor.appendChild(mensaje);
      }
    }

    const botonesAsociar = document.querySelectorAll(".asociarCodigoGetty");

    botonesAsociar.forEach((boton) => {
      boton.addEventListener("click", function () {
        const codigoId = this.getAttribute("id");
        dataAsociar.codigoGetty = codigoId;
        asociarCodigoGetty(codigoId);
      });
    });

    function asociarCodigoGetty(codigoId) {
      fetch("ajax.php?controller=Vocabularios&action=asociarGetty", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(dataAsociar),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(`Error en la respuesta: ${response.statusText}`);
          }
          return response.json();
        })
        .then((data) => {
          if (data.status === "success") {
            console.log(`Código ${codigoId} asociado correctamente.`);
            alert(`Código ${codigoId} asociado correctamente.`);
          } else {
            console.error("Error:", data.mensaje);
            alert("Error al asociar el código.");
          }
        })
        .catch((error) => {
          console.error("Error en la petición:", error);
          alert("Hubo un error en la solicitud.");
        });
    }
  });
}
