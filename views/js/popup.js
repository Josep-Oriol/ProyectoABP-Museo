function agregarEventosEliminar() {
  const btnEliminar = document.getElementsByClassName("eliminarRegistro");
  const popUp = document.getElementById("popUpEliminar");
  const fondo = document.getElementById("fondoPopUp");
  const btnConfirmar = document.getElementById("btnConfirmar");
  const btnCancelar = document.getElementById("btnCancelar");
  let idRegistro = null;
  let filaEliminar = null;

  const url = window.location.href;
  let pagina = url.includes("Exposiciones")
    ? "exposiciones"
    : url.includes("Obras")
    ? "obras"
    : url.includes("Usuarios")
    ? "usuarios"
    : url.inculed("Copias")
    ? "copias_seguridad"
    : null;
  let nombreColumna =
    pagina === "exposiciones"
      ? "exposicion"
      : pagina === "obras"
      ? "numero_registro"
      : pagina === "usuarios"
      ? "usuario"
      : pagina === "copias_seguridad"
      ? "copia"
      : null;

  // MOSTRAR POPUP
  Array.from(btnEliminar).forEach((btn) => {
    btn.addEventListener("click", function () {
      popUp.style.display = "block";
      fondo.style.display = "block";

      idRegistro = btn.id;
    });
  });

  btnConfirmar.addEventListener("click", function () {
    console.log(idRegistro);

    let data = {
      id: idRegistro,
      apartado: pagina,
      columna: nombreColumna,
    };

    let dataJson = JSON.stringify(data);

    fetch("ajax.php?controller=Eliminar&action=eliminarRegistro", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: dataJson,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status == "success") {
          popUp.style.display = "none";
          fondo.style.display = "none";
          filaEliminar = document.querySelector('tr[id="' + idRegistro + '"]');
          filaEliminar.remove();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  });

  // CERRAR POPUP
  btnCancelar.addEventListener("click", function () {
    popUp.style.display = "none";
    fondo.style.display = "none";
  });
}

function filtrosAvanzados() {
  const openBtn = document.getElementById("filtro");
  const cerrar = document.querySelector(".close-btn");
  const popup = document.querySelector(".popup-overlay");
  const apply = document.getElementById("btn-apply");

  if (openBtn) {
    openBtn.addEventListener("click", function () {
      popup.style.display = "flex";
    });

    cerrar.addEventListener("click", function () {
      popup.style.display = "none";
    });

    apply.addEventListener("click", function () {
      popup.style.display = "none";
    });

    if (popup) {
      document.addEventListener("keydown", (e) => {
        if (e.key == "Escape") {
          popup.style.display = "none";
        }
      });
    }
  }
}

function ubicacionesHistory() {
  const cerrar = document.querySelector(".close-btn");
  const popup = document.querySelector(".overlay-ubicaciones");
  const content = document.getElementById("content");

  if (popup) {
    cerrar.addEventListener("click", function () {
      content.innerHTML = "";
      popup.style.display = "none";
    });

    document.addEventListener("keydown", (e) => {
      if (e.key == "Escape") {
        content.innerHTML = "";
        popup.style.display = "none";
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", function () {
  agregarEventosEliminar();
  filtrosAvanzados();
  ubicacionesHistory();
});
