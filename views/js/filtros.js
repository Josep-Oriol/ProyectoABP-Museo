function mostrarDatos(dato, filters) {
  let paginacion = document.querySelector("#numeroResultados")
  console.log(paginacion.value)
  const url = window.location.href;
  let pagina = url.includes("Exposiciones")
    ? "exposiciones"
    : url.includes("Obras")
    ? "obras"
    : url.includes("Usuarios")
    ? "usuarios"
    : null;

  let data = {
    busqueda: dato,
    pagina: pagina,
    filtros: filters,
    lim_registros: paginacion.value,
  };
  let dataJson = JSON.stringify(data);

  loader = document.querySelector(".loader")
  noResults = document.querySelector(".noResultados")

  fetch("ajax.php?controller=Buscador&action=buscar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: dataJson,
  })
    .then((response) => response.json())
    .then((data) => {

      if(data.texto.length === 0){
        noResults.style.display = "block"
        loader.style.display = "none"
      }
      else{
        loader.style.display = "block"
        noResults.style.display = "none"
      }
      
      exposiciones = data.texto

      let popupImagen = document.getElementById('popupImagen');
      let vistaImagen = document.getElementById('vistaImagenAmpliada');
      const tbody = document.querySelector('tbody');
      const primer_tr = document.querySelector('tr')
      tbody.innerHTML = primer_tr.outerHTML
      
      exposiciones.forEach(exposicion => {
          let tr = document.createElement('tr')
          for(let dato in exposicion){
              let td = document.createElement('td')

              if(exposicion[dato] && typeof exposicion[dato] === 'string' && exposicion[dato].includes("images/")){
                  let img = document.createElement('img');
                  img.src = exposicion[dato];
                  img.alt = 'fotografia';
                  img.className += "fotografiaObjeto";
                  img.addEventListener('click', function() {
                    popupImagen.style.display = 'block';
                    let imagenAmpliada = vistaImagen.children[0]; //La imagen es el primer hijo de vistaImagenAmpliada
                    imagenAmpliada.src = img.src;
                  })
                  td.appendChild(img)
              }
              else{
                  td.textContent = exposicion[dato]
              }
              tr.appendChild(td);
          }
          td_botones = document.createElement('td')
          tr.appendChild(td_botones)

          link1 = document.createElement('a')
          img1 = document.createElement('img')
          img1.src = 'images/editarv2.png'
          link1.appendChild(img1)
          
          link2 = document.createElement('a')
          img2 = document.createElement('img')
          img2.src = 'images/fichav2.png'
          link2.appendChild(img2)

          link3 = document.createElement('a')
          img3 = document.createElement('img')
          img3.src = 'images/borrarv2.png'
          link3.appendChild(img3)

          id = pagina === "obras" ? exposicion.numero_registro : pagina === "exposiciones" ? exposicion.id_exposicion : pagina === "usuarios" ? exposicion.id_usuario : null

          tr.setAttribute('id', id);
          link1.href = data.url[0] + id
          link2.href = data.url[1] + id
          link3.classList.add('eliminarRegistro');
          link3.setAttribute('id', id);

          td_botones.appendChild(link2)
          td_botones.appendChild(link1)
          td_botones.appendChild(link3)

          tr.appendChild(td_botones)
          tbody.appendChild(tr);

          loader.style.display = "none"
      });

      // Llamar a la función que maneja los eventos de eliminación después de que se agregaron los botones
      agregarEventosEliminar();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Obtener el controller desde la URL
const params = new URLSearchParams(window.location.search);
const controller = params.get("controller");

let dic = new Map();

// Función para obtener el JSON según el controller
async function obtenerDatos(controller) {
  try {
    const response = await fetch(`views/js/json/${controller}.json`);
    const data = await response.json();

    for (const [key, value] of Object.entries(data)) {
      dic.set(key, value);
    }
  } catch (error) {
    console.error("Error al obtener el JSON:", error);
  }
}

// Cargar los selects del formulario
function cargarSelect() {
  const andSelectField = document.getElementById("and-select-value");
  const orSelectField = document.getElementById("or-select-value");

  andSelectField.innerHTML = "";
  orSelectField.innerHTML = "";

  dic.forEach((value, key) => {
    const option = document.createElement("option");
    option.value = key;
    option.textContent = value.label;
    andSelectField.appendChild(option);
    // Clonar la opción para el otro select
    orSelectField.appendChild(option.cloneNode(true));
  });
}

// Agregar un filtro
function agregarFiltro(section) {
    const selectElement = document.getElementById(`${section}-select-value`);
    const selectedValue = selectElement.value;
    const selectedText = selectElement.options[selectElement.selectedIndex].text;
    const filtersContainer = document.getElementById(`${section}-filters-inputs`);
    let exist = false;

    // Verificar si ya existe un campo con el mismo label
    const existingFields = filtersContainer.querySelectorAll("label");
    for (let field of existingFields) {
        if (field.textContent === selectedText) {
            alert(`Ya existe un filtro para "${selectedText}" en la sección "${section.toUpperCase()}"`);
            exist = true;
          }
    }

    // Crear el nuevo input
    const fieldConfig = dic.get(selectedValue);
    if (fieldConfig && !exist) {
        const div = document.createElement("div");
        div.className = "filter-item";

    // Crear el label
    const label = document.createElement("label");
    label.setAttribute("for", `${section}-${selectedValue}`);
    label.textContent = fieldConfig.label;

    // Crear el input o select en funcion del tipo
    let inputElement;
    if (fieldConfig.type === "select") {
      inputElement = document.createElement("select");
      inputElement.className = "filter-input";
      inputElement.name = `${section}-${selectedValue}`;
      fieldConfig.options.forEach((option) => {
        const optionElement = document.createElement("option");
        optionElement.value = option;
        optionElement.textContent = option;
        inputElement.appendChild(optionElement);
      });
    } else {
      inputElement = document.createElement("input");
      inputElement.type = fieldConfig.type;
      inputElement.placeholder = fieldConfig.placeholder;
      inputElement.name = `${section}-${selectedValue}`;
      inputElement.className = "filter-input";
    }

    const divFilterItemGroup = document.createElement("div");
    divFilterItemGroup.className = "filterItemGroup";

    const divPlusInputs = document.createElement("div");
    divPlusInputs.className = "plusInputs";
    divPlusInputs.id = `${section}-${selectedValue}-plusInputs`;

    // Crear el botón de eliminar
    const trashIcon = document.createElement("img");
    trashIcon.src = "images/svg/trash.svg";
    trashIcon.alt = "Eliminar filtre";
    trashIcon.className = "trashIcon";
    trashIcon.addEventListener("click", () => {
      div.remove();
    });

    // Crear el botón de añadir
    const plusIcon = document.createElement("img");
    plusIcon.src = "./images/svg/plus.svg";
    plusIcon.alt = "Afegir un altre input";
    plusIcon.className = "plusIcon";
    plusIcon.addEventListener("click", () => {
      agregarNuevoInput(div, fieldConfig, section, divPlusInputs);
    });

    // Añadir los elementos al div correspondiente
    divFilterItemGroup.appendChild(label);
    divFilterItemGroup.appendChild(inputElement);
    divFilterItemGroup.appendChild(trashIcon);
    divFilterItemGroup.appendChild(plusIcon);
    div.appendChild(divFilterItemGroup);
    div.appendChild(divPlusInputs);

    // Añadir el div al contenedor de filtros
    filtersContainer.appendChild(div);
  }
}

// Añadir un nuevo input dentro del mismo filter-item
function agregarNuevoInput(parentDiv, fieldConfig, section, plusInputs) {
  let newInputElement;
  if (fieldConfig.type === "select") {
    newInputElement = document.createElement("select");
    newInputElement.className = "filter-input";
    newInputElement.name = `${section}-${fieldConfig.label}-extra`;
    fieldConfig.options.forEach((option) => {
      const optionElement = document.createElement("option");
      optionElement.value = option;
      optionElement.textContent = option;
      newInputElement.appendChild(optionElement);
    });
  } else {
    newInputElement = document.createElement("input");
    newInputElement.type = fieldConfig.type;
    newInputElement.placeholder = fieldConfig.placeholder;
    newInputElement.name = `${section}-${fieldConfig.label}-extra`;
    newInputElement.className = "filter-input";
  }

  // Crear el boton par eliminar el plus input
  const minusIcon = document.createElement("img");
  minusIcon.src = "images/svg/minus.svg";
  minusIcon.alt = "Treure filtre extra";
  minusIcon.className = "minusIcon";
  minusIcon.addEventListener("click", () => {
    plusInput.remove();
  });

  const plusInput = document.createElement("div");
  plusInput.className = "plusInput";

  plusInput.appendChild(newInputElement);
  plusInput.appendChild(minusIcon);

  plusInputs.appendChild(plusInput);
  parentDiv.appendChild(plusInputs);
}

function datosForm() {
  // Selecciona todos los contenedores con clase 'filter-item'
  const filterItems = document.querySelectorAll(".filter-item");

  const filters = { and: {}, or: {} };

  // Itero sobre el div que contiene el div con el input principal y los plus inputs
  filterItems.forEach((item) => {
    const groupValues = [];

    // Div que contiene el input principal
    const filterGroup = item.querySelector(".filterItemGroup");
    if (filterGroup) {
      const input = filterGroup.querySelector("input");
      const select = filterGroup.querySelector("select");

      // Assigna un valor o otro si no existe
      const element = input || select;

      if (element) {
        groupValues.push(element.value);
      }
    }

    // Div inputs adicionales
    const plusInputsContainer = item.querySelector(".plusInputs");
    if (plusInputsContainer) {
      // Seleccionar los elementos input y select dentro de un div con classe .plusInput
      const additionalInputs = plusInputsContainer.querySelectorAll(
        ".plusInput input, .plusInput select"
      );

      // Añadir los valores de los inputs adicionales
      additionalInputs.forEach((plusInput) => {
        groupValues.push(plusInput.value);
      });
    }

    if (groupValues.length > 0) {
      // Si existe toma el name del primer input o select si no le quita de el id -plusInputs
      const baseName = filterGroup
        ? filterGroup.querySelector("input, select").name
        : plusInputsContainer.id.replace("-plusInputs", "");

      if (baseName.startsWith("and-")) {
        // Si solo hay un valor los asignamos si hay mas añadimos el array
        filters.and[baseName] =
          groupValues.length === 1 ? groupValues[0] : groupValues;
      } else if (baseName.startsWith("or-")) {
        // Si solo hay un valor los asignamos si hay mas añadimos el array
        filters.or[baseName] =
          groupValues.length === 1 ? groupValues[0] : groupValues;
      }
    }
  });

  // Muestra los valores obtenidos
  return filters;
}

async function enviarDatos() {
  try {
    const filters = datosForm();
    const response = await fetch(
      `index.php?controller=Buscador&action=buscar`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(filters),
      }
    );
  } catch (error) {
    console.error("Error al obtener el JSON:", error);
  }
}

function exportar(datos){
  const worksheet = XLSX.utils.json_to_sheet(datos); // Crear la hoja de cálculo
  const workbook = XLSX.utils.book_new();            // Crear el libro de trabajo
  XLSX.utils.book_append_sheet(workbook, worksheet, "Datos"); // Agregar la hoja al libro

  // Generar y descargar el archivo Excel
  XLSX.writeFile(workbook, "datos.xlsx");
}

// Inicializar eventos
function inicializarEventos() {
  const inputExposiciones = document.getElementById("busqueda");

  const addAndFilterBtn = document.getElementById("add-and-filter");
  const addOrFilterBtn = document.getElementById("add-or-filter");

  const resetBtn = document.getElementById("btn-reset");

  const submit = document.getElementById("btn-apply");

  const botonExportar = document.querySelector("#exportarExcel")

  addAndFilterBtn.addEventListener("click", () => {
    agregarFiltro("and");
  });

  addOrFilterBtn.addEventListener("click", () => {
    agregarFiltro("or");
  });

  resetBtn.addEventListener("click", () => {
    const orFiltersInputs = document.getElementById("or-filters-inputs");
    const andFiltersInputs = document.getElementById("and-filters-inputs");

    orFiltersInputs.innerHTML = "";
    andFiltersInputs.innerHTML = "";
  });

  submit.addEventListener("click", function (event) {
    event.preventDefault();
    let filters = datosForm();
    let dato = inputExposiciones.value;
    mostrarDatos(inputExposiciones.value, filters);
  });

  inputExposiciones.addEventListener("input", function (event) {
    let filters = datosForm();
    let dato = inputExposiciones.value;
    mostrarDatos(inputExposiciones.value, filters);
  });

  let paginacion = document.querySelector("#numeroResultados")
  paginacion.addEventListener("change", function(event){
    mostrarDatos(inputExposiciones.value, datosForm())
  })
  botonExportar.addEventListener("click", function(event){
    let filters = datosForm()
    let dato = inputExposiciones.value;
    const url = window.location.href;
    let pagina = url.includes("Exposiciones")
      ? "exposiciones"
      : url.includes("Obras")
      ? "obras"
      : url.includes("Usuarios")
      ? "usuarios"
      : null;
    let data = {
      busqueda: dato,
      pagina: pagina,
      filtros: filters,
    };
    let dataJson = JSON.stringify(data);
  
    fetch("ajax.php?controller=Buscador&action=exportarTablas", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: dataJson,
    })
      .then((response) => response.json())
      .then((data) => {
  
        exportar(data.texto)

      })
      .catch((error) => {
        console.error("Error:", error);
      });
  })  

}


document.addEventListener("DOMContentLoaded", async () => {
  await obtenerDatos(controller);
  cargarSelect();
  inicializarEventos();
  mostrarDatos("", { and: {}, or: {} });
});
