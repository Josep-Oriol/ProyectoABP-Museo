function ejecutarFuncionesMostrar(id, boton) {
  mostrarHijos(id, boton); // Llama a la función para mostrar hijos
}

function mostrarHijos(id, boton) {
  console.log("ID recibido:", id);
  let divHijos = $("#hijos-" + id); // Contenedor de los hijos

  // Verificar si los hijos ya fueron cargados previamente
  if (divHijos.data("loaded")) {
    divHijos.toggle(); // Alterna visibilidad si ya están cargados
    rotarImagen(boton, divHijos.is(":visible"));
    return;
  }

  // Desactivar el botón mientras se carga
  $(boton).prop("disabled", true);

  $.ajax({
    url: "ajax.php?controller=Vocabularios&action=cargarHijos&ajax=true", // URL para cargar hijos
    type: "GET",
    data: { id_padre: id }, // ID del padre enviado al controlador
    success: function (hijos) {
      if (hijos.length > 0) {
        // Crear y añadir cada hijo dinámicamente
        hijos.forEach(function (hijo) {
          // Crear el contenedor principal
          const inputsDiv = document.createElement("div");
          inputsDiv.classList.add("inputsDiv");

          // Botón con flecha derecha
          const botonFlecha = document.createElement("button");
          const imgFlecha = document.createElement("img");
          imgFlecha.setAttribute("src", "images/flecha_derecha.png");
          botonFlecha.appendChild(imgFlecha);

          // Añadir un eventListener al botón
          botonFlecha.addEventListener("click", function () {
            ejecutarFuncionesMostrar(hijo.id_ubicacion, botonFlecha);
          });

          // Input de texto
          const inputTexto = document.createElement("input");
          inputTexto.setAttribute("type", "text");
          inputTexto.setAttribute("name", hijo.id_padre);
          inputTexto.setAttribute("id", hijo.id_ubicacion);
          inputTexto.setAttribute("value", hijo.descripcion_ubicacion);

          // Botón de eliminación
          const botonEliminar = document.createElement("button");
          const imgBasura = document.createElement("img");
          imgBasura.classList.add("eliminarUbi");
          imgBasura.setAttribute("src", "images/basura.png");
          botonEliminar.appendChild(imgBasura);

          // Añadir un eventListener al botón
          botonEliminar.addEventListener("click", function () {
            eliminarHijos(hijo.id_ubicacion);
          });

          // Formulario para añadir una ubicación hija
          const formulario = document.createElement("form");
          formulario.setAttribute(
            "action",
            "index.php?controller=Vocabularios&action=crearUbicacionHija"
          );
          formulario.setAttribute("method", "POST");
          const inputHidden = document.createElement("input");
          inputHidden.setAttribute("type", "hidden");
          inputHidden.setAttribute("name", "id_ubicacion");
          inputHidden.setAttribute("value", hijo.id_ubicacion);
          const botonForm = document.createElement("button");
          botonForm.setAttribute("type", "submit");
          botonForm.setAttribute("title", "Afegir ubicació");
          const imgMas = document.createElement("img");
          imgMas.setAttribute("src", "images/mas.png");
          botonForm.appendChild(imgMas);
          formulario.appendChild(inputHidden);
          formulario.appendChild(botonForm);

          // Imagen del historial
          const imgHistorial = document.createElement("img");
          imgHistorial.classList.add("historial");
          imgHistorial.setAttribute("src", "images/history.png");
          imgHistorial.setAttribute("id", "historial");

          // Contenedor para hijos
          const divSubHijos = document.createElement("div");
          divSubHijos.setAttribute("id", `hijos-${hijo.id_ubicacion}`);
          divSubHijos.style.display = "none";
          divSubHijos.style.paddingLeft = "5vw";

          // Ensamblar el contenedor principal
          inputsDiv.appendChild(botonFlecha);
          inputsDiv.appendChild(inputTexto);
          inputsDiv.appendChild(botonEliminar);
          inputsDiv.appendChild(formulario);
          inputsDiv.appendChild(imgHistorial);

          // Agregar los elementos al contenedor principal
          divHijos.append(inputsDiv, divSubHijos);
        });
      }

      // Marcar como cargados y mostrar
      divHijos.data("loaded", true);
      divHijos.toggle();
      rotarImagen(boton, divHijos.is(":visible"));
    },
    complete: function () {
      $(boton).prop("disabled", false); // Reactivar el botón después de completar la solicitud
    },
  });
}

function rotarImagen(boton, mostrar) {
  const imagen = boton.querySelector("img");
  imagen.style.transition = "transform 0.3s ease";
  imagen.style.transform = mostrar ? "rotate(90deg)" : "rotate(0deg)";
}

function eliminarHijos(id_ubicacion) {
  let data = {
    id_ubicacion: id_ubicacion,
  };

  let dataJson = JSON.stringify(data);

  fetch("ajax.php?controller=Vocabularios&action=eliminarUbicacionHija", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: dataJson,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "no hay ubicacion") {
        document.getElementById(id_ubicacion).parentNode.remove();
        location.reload();
      } else if (data.status === "hay obra") {
        let popUp = document.getElementById("popUpUbicaciones");
        popUp.style.display = "flex";

        setTimeout(() => {
          popUp.style.display = "none";
        }, 3000);
      } else if (data.status === "hay ubicacion") {
        let popUp2 = document.getElementById("popUpUbicaciones2");
        console.log(popUp2);
        popUp2.style.display = "flex";

        setTimeout(() => {
          popUp2.style.display = "none";
        }, 3000);
      }
    });
}

function crearTabla() {
  const content = document.getElementById("content");

  const tabla = document.createElement("table");
  tabla.setAttribute("id", "table-ubicaciones");

  const thead = document.createElement("thead");
  thead.setAttribute("class", "thead");

  const trHead = document.createElement("tr");

  const th1 = document.createElement("th");
  th1.textContent = "Ubicació";
  trHead.appendChild(th1);

  const th2 = document.createElement("th");
  th2.textContent = "Nombre";
  trHead.appendChild(th2);

  const th3 = document.createElement("th");
  th3.textContent = "Data Inici";
  trHead.appendChild(th3);

  const th4 = document.createElement("th");
  th4.textContent = "Data Fin";
  trHead.appendChild(th4);

  thead.appendChild(trHead);
  tabla.appendChild(thead);
  content.appendChild(tabla);

  const tbody = document.createElement("tbody");
  tbody.setAttribute("id", "tbody");
  tabla.appendChild(tbody);
}

function mostrarPasadas(data) {
  const tbody = document.getElementById("tbody");

  if (tbody.hasChildNodes) {
    tbody.innerHTML = "";
  }

  if (data.obrasAntiguas.length > 0) {
    data.obrasAntiguas.forEach((obra) => {
      // Fila
      const row = document.createElement("tr");

      // Celdas
      const tdVoid = document.createElement("td");
      tdVoid.textContent = "";
      row.appendChild(tdVoid);

      const tdTitulo = document.createElement("td");
      tdTitulo.textContent = obra.nombre_obra;
      row.appendChild(tdTitulo);

      const tdInicio = document.createElement("td");
      tdInicio.textContent = obra.fecha_inicio;
      row.appendChild(tdInicio);

      const tdFin = document.createElement("td");
      tdFin.textContent = obra.fecha_fin;
      row.appendChild(tdFin);

      // Añadir
      tbody.appendChild(row);
    });
  } else {
    // No hay obras
    const row = document.createElement("tr");
    const tdEmpty = document.createElement("td");
    tdEmpty.colSpan = 4;
    tdEmpty.textContent = "No hay obras pasadas.";
    row.appendChild(tdEmpty);
    tbody.appendChild(row);
  }
}

function mostrarActuales(data) {
  const tbody = document.getElementById("tbody");

  if (tbody.hasChildNodes) {
    tbody.innerHTML = "";
  }

  if (data.obrasActuales.length > 0) {
    data.obrasActuales.forEach((obra) => {
      // Fila
      const row = document.createElement("tr");

      // Celdas
      const tdDescripcion = document.createElement("td");
      tdDescripcion.textContent = obra.descripcion_ubicacion;
      row.appendChild(tdDescripcion);

      const tdTitulo = document.createElement("td");
      tdTitulo.textContent = obra.titulo;
      row.appendChild(tdTitulo);

      const tdInicio = document.createElement("td");
      tdInicio.textContent = obra.fecha_inicio_ubicacion;
      row.appendChild(tdInicio);

      const tdFin = document.createElement("td");
      tdFin.textContent = obra.fecha_fin_ubicacion;
      row.appendChild(tdFin);

      // Añadir
      tbody.appendChild(row);
    });
  } else {
    // No hay obras
    const row = document.createElement("tr");
    const td = document.createElement("td");
    td.colSpan = 4;
    td.textContent = "No hay obras actuales.";
    row.appendChild(td);
    tbody.appendChild(row);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const botones = document.getElementsByClassName("historial");

  const overlay = document.querySelector(".overlay-ubicaciones");
  if (overlay) {
    overlay.style.display = "none";
  }

  Array.from(botones).forEach((boton) => {
    boton.addEventListener("click", function () {
      let div = document.getElementById("div_" + boton.id);
      let data = {
        id_ubicacion: boton.id,
      };
      let dataJson = JSON.stringify(data);
      overlay.style.display = "flex";

      fetch("ajax.php?controller=Vocabularios&action=mostrarHistorial", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
        body: dataJson,
      })
        .then((response) => response.json())
        .then((data) => {
          const pasadas = document.getElementById("past");
          const actuales = document.getElementById("current");
          console.log(data);
          crearTabla();
          console.log(data);
          mostrarPasadas(data);

          pasadas.addEventListener("mouseenter", () => {
            if (!pasadas.classList.contains("clicked")) {
              pasadas.classList.add("underline-hover");
            }
          });

          actuales.addEventListener("mouseenter", () => {
            if (!actuales.classList.contains("clicked")) {
              actuales.classList.add("underline-hover");
            }
          });

          pasadas.addEventListener("click", () => {
            actuales.classList.remove("clicked");
            pasadas.classList.add("clicked");
            mostrarPasadas(data);
          });

          actuales.addEventListener("click", () => {
            pasadas.classList.remove("clicked");
            actuales.classList.add("clicked");
            mostrarActuales(data);
          });
        })
        .catch((error) => {
          alert("Error al cargar los datos:" + error);
          console.error("Error al cargar los datos:", error);
        });
    });
  });
});
$id_ubicacion = $data["id_ubicacion"];
