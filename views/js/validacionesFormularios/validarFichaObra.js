document.addEventListener('DOMContentLoaded', function() {
    const fichaBasica = document.getElementById('fichaBasica');
    const fichaCompleta = document.getElementById('fichaCompleta');
    const btnFichaBasica = document.getElementById('btnFichaBasica');
    const btnFichaCompleta = document.getElementById('btnFichaCompleta');

    const camposNumeroRegistro = document.getElementById('camposNumeroRegistro');
    const campoLetra = document.getElementById('letra');
    const campoNumeroRegistro = document.getElementById('numero_registro');
    const campoDecimal = document.getElementById('decimales');

    if (fichaBasica) {
        fichaCompleta.style.display = 'none';
        btnFichaCompleta.addEventListener('click', () => {
            btnFichaCompleta.classList.add('pulsado');
            btnFichaBasica.classList.remove('pulsado');
            fichaBasica.style.display = 'none';
            fichaCompleta.style.display = 'block';
        });
    
        btnFichaBasica.addEventListener('click', () => { 
            btnFichaBasica.classList.add('pulsado');
            btnFichaCompleta.classList.remove('pulsado');
            fichaBasica.style.display = 'block';
            fichaCompleta.style.display = 'none';
        });
    }

    if (campoLetra) {
        campoLetra.addEventListener('input', function() {
            campoLetra.value = campoLetra.value.toUpperCase();
            if (campoLetra.value.length > 1) {
                campoLetra.value = campoLetra.value.slice(1);
            }
            if (!(/^[A-Z]+$/.test(campoLetra.value))) {
                campoLetra.value = campoLetra.value.slice(1);
            }
        });
    
        campoNumeroRegistro.addEventListener('input', function() {
            if (!(/^[0-9]*$/.test(campoNumeroRegistro.value)) || campoNumeroRegistro.value.length === 6) {
                let posicion = campoNumeroRegistro.value.length === 1 ? 0 : -1;
                campoNumeroRegistro.value = campoNumeroRegistro.value.slice(0, posicion);
            }
        });
    
        campoDecimal.addEventListener('input', function() {
            if (!(/^[0-9]*$/.test(campoDecimal.value)) || campoDecimal.value === '00' || campoDecimal.value.length === 3) {
                let posicion = campoDecimal.value.length === 1 ? 0 : -1;
                campoDecimal.value = campoDecimal.value.slice(0, posicion);
            }
        });
    
        campoLetra.onpaste = function(event) {
            event.preventDefault();
        }
    
        campoNumeroRegistro.onpaste = function(event) {
            event.preventDefault();
        }
    
        campoLetra.addEventListener('dragover', function(event) {
            event.preventDefault();
        });
    
        campoNumeroRegistro.addEventListener('dragover', function(event) {
            event.preventDefault();
        });
    
        campoLetra.autocomplete = 'off';
        campoNumeroRegistro.autocomplete = 'off';
    }
});