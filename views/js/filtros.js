// Obtener el controller desde la URL
const params = new URLSearchParams(window.location.search);
const controller = params.get('controller');

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
    console.error('Error al obtener el JSON:', error);
  }
}

// Cargar los selects del formulario
function cargarSelect() {
  const andSelectField = document.getElementById('and-select-value');
  const orSelectField = document.getElementById('or-select-value');
  
  andSelectField.innerHTML = '';
  orSelectField.innerHTML = '';

  dic.forEach((value, key) => {
    const option = document.createElement('option');
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

    // Verificar si ya existe un campo con el mismo label
    const existingFields = filtersContainer.querySelectorAll("label");
    for (let field of existingFields) {
        if (field.textContent === selectedText) {
            alert(`Ya existe un filtro para "${selectedText}" en la sección "${section.toUpperCase()}"`);
        }
    }

    // Crear el nuevo input
    const fieldConfig = dic.get(selectedValue);
    if (fieldConfig) {
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
            fieldConfig.options.forEach(option => {
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
        div.appendChild(divFilterItemGroup)
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
      fieldConfig.options.forEach(option => {
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

function datosForm(){
  // Selecciona todos los contenedores con clase 'filter-item'
  const filterItems = document.querySelectorAll('.filter-item');

  const filters = { and: {}, or: {} };

  // Itero sobre el div que contiene el div con el input principal y los plus inputs
  filterItems.forEach(item => {
    const groupValues = [];

    // Div que contiene el input principal
    const filterGroup = item.querySelector('.filterItemGroup');
    if (filterGroup) {
      const input = filterGroup.querySelector('input');
      const select = filterGroup.querySelector('select');

      // Assigna un valor o otro si no existe
      const element = input || select;

      if (element) {
        groupValues.push(element.value);
      }
    }

    // Div inputs adicionales
    const plusInputsContainer = item.querySelector('.plusInputs');
    if (plusInputsContainer) {
      // Seleccionar los elementos input y select dentro de un div con classe .plusInput
      const additionalInputs = plusInputsContainer.querySelectorAll('.plusInput input, .plusInput select');

      // Añadir los valores de los inputs adicionales
      additionalInputs.forEach(plusInput => {
          groupValues.push(plusInput.value);
      });
    }

    if (groupValues.length > 0) {
      // Si existe toma el name del primer input o select si no le quita de el id -plusInputs
      const baseName = filterGroup ? filterGroup.querySelector('input, select').name : plusInputsContainer.id.replace('-plusInputs', '');

      if (baseName.startsWith('and-')) {
        // Si solo hay un valor los asignamos si hay mas añadimos el array
        filters.and[baseName] = groupValues.length === 1 ? groupValues[0] : groupValues;
      } 
      else if (baseName.startsWith('or-')) {
        // Si solo hay un valor los asignamos si hay mas añadimos el array
        filters.or[baseName] = groupValues.length === 1 ? groupValues[0] : groupValues;
      }
    }
  });

  // Muestra los valores obtenidos
  console.log(filters);
  return filters;
}

async function enviarDatos(){
  try {
    const filters = datosForm();

    const response = await fetch(`index.php?controller=Buscador&action=buscar`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(filters),
    });


    
  } catch (error) {
    console.error('Error al obtener el JSON:', error);
  }
}

// Inicializar eventos
function inicializarEventos() {
  const addAndFilterBtn = document.getElementById('add-and-filter');
  const addOrFilterBtn = document.getElementById('add-or-filter');

  const resetBtn = document.getElementById('btn-reset');

 const submit = document.getElementById("btn-apply");
  
  addAndFilterBtn.addEventListener('click', () => {
    agregarFiltro('and');
  });

  addOrFilterBtn.addEventListener('click', () => {
    agregarFiltro('or');
  });

  submit.addEventListener('click' , () => {
    const orFiltersInputs = document.getElementById("or-filters-inputs");
    const andFiltersInputs = document.getElementById("and-filters-inputs");

    orFiltersInputs.innerHTML =  '';
    andFiltersInputs.innerHTML = '';
  });

  resetBtn.addEventListener('click', function(event){
    event.preventDefault();
    //enviarDatos();
    datosForm();
  })

}

document.addEventListener('DOMContentLoaded', async () => {
  await obtenerDatos(controller);
  cargarSelect();
  inicializarEventos();
});