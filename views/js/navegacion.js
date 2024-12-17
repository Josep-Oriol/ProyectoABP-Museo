document.addEventListener('DOMContentLoaded', function() {
    const rutaNavegacion = document.getElementById('rutaNavegacion')

    if (rutaNavegacion){
        let urlActual = new URL(window.location.href);

        if (urlActual.href.includes('Obras') && urlActual.href.includes('mostrarObras')){
            rutaNavegacion.innerHTML = '<div><a href="index.php?controller=Obras&action=mostrarObras">Obras</a></div>'
        }else if (urlActual.href.includes('Obras') && urlActual.href.includes('mostrarFicha')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Obras&action=mostrarObras">Obras</a> ->
                    Fichas obra
                </div>
            `;
        }else if (urlActual.href.includes('Obras') && urlActual.href.includes('editar')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Obras&action=mostrarObras">Obras</a> ->
                    Editar obra
                </div>
            `;
        }else if (urlActual.href.includes('Obras') && urlActual.href.includes('crear')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Obras&action=mostrarObras">Obras</a> ->
                    Crear obra
                </div>
            `;
        }else if (urlActual.href.includes('Exposiciones') && urlActual.href.includes('mostrarExposiciones')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a>
                </div>
            `;
        }else if (urlActual.href.includes('Exposiciones') && urlActual.href.includes('fichaExposiciones')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a> ->
                    Ficha exposició
                </div>
            `;
        }else if (urlActual.href.includes('Exposiciones') && urlActual.href.includes('relacionarObras')){
            let id = urlActual.searchParams.get("id");
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a> ->
                    <a href="index.php?controller=Exposiciones&action=fichaExposiciones&id=${id}">Ficha exposició</a> ->
                    Relacionar obras
                </div>
            `;
        }else if (urlActual.href.includes('Exposiciones') && urlActual.href.includes('Pantallaeditar')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a> ->
                    Editar exposició
                </div>
            `;
        }else if (urlActual.href.includes('Exposiciones') && urlActual.href.includes('pantallaCrear')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Exposiciones&action=mostrarExposiciones">Exposicions</a> ->
                    Crear exposició
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('mostrarUbicaciones')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones">Ubicacions</a>
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('crearUbicacionHija')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Vocabularios&action=mostrarUbicaciones">Ubicacions</a>->
                    Crear ubicació
                </div>
            `;
        }else if (urlActual.href.includes('Usuarios') && urlActual.href.includes('mostrarUsuarios')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Usuaris</a>
                </div>
            `;
        }else if (urlActual.href.includes('Usuarios') && urlActual.href.includes('crear')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Usuaris</a>->
                    Crear usuari
                </div>
            `;
        }else if (urlActual.href.includes('Usuarios') && urlActual.href.includes('mostrarFicha')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Usuaris</a>->
                    Ficha usuari
                </div>
            `;
        }else if (urlActual.href.includes('Usuarios') && urlActual.href.includes('editar')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Usuarios&action=mostrarUsuarios">Usuaris</a>->
                    Editar usuari
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('enviarAVocabularios')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('mostrarCamposVocabulario&id=12')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    Autories
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('mostrarVocabularios')){
            rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    Camps llista
                </div>
            `;
        }else if (urlActual.href.includes('Vocabularios') && urlActual.href.includes('mostrarCamposVocabulario')){
            let id = urlActual.searchParams.get("id");
            if (id === '8'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Baixa
                </div>
                `;
            }if (id === '9'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Causa de baixa
                </div>
                `;
            }if (id === '1'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Classificació genèrica
                </div>
                `;
            }if (id === '6'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Codi Autor
                </div>
                `;
            }if (id === '3'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Codi Getty Material
                </div>
                `;
            }if (id === '5'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Codi Getty Tècnica
                </div>
                `;
            }if (id === '10'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Estat de conservació
                </div>
                `;
            }if (id === '7'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Forma d'ingrés
                </div>
                `;
            }if (id === '2'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Material
                </div>
                `;
            }if (id === '4'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Tècnica
                </div>
                `;
            }if (id === '11'){
                rutaNavegacion.innerHTML = `
                <div>
                    Administració->
                    <a href="index.php?controller=Vocabularios&action=enviarAVocabularios">Vocabularis</a>->
                    <a href="index.php?controller=Vocabularios&action=mostrarVocabularios">Camps llista</a>->
                    Tipus Exposició
                </div>
                `;
            }
        }else if (urlActual.href.includes('Copias') && urlActual.href.includes('mostrarCopias')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Copias&action=mostrarCopias">Copies de seguretat</a>
                </div>
            `;
        }else if (urlActual.href.includes('Copias') && urlActual.href.includes('mostrarCopia')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Copias&action=mostrarCopias">Copies de seguretat</a>->
                    Ficha copia de seguretat
                </div>
            `;
        }else if (urlActual.href.includes('Copias') && urlActual.href.includes('editar')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Copias&action=mostrarCopias">Copies de seguretat</a>->
                    Editar copia de seguretat
                </div>
            `;
        }else if (urlActual.href.includes('Copias') && urlActual.href.includes('crear')){
            rutaNavegacion.innerHTML = `
                <div>
                    <a href="index.php?controller=Copias&action=mostrarCopias">Copies de seguretat</a>->
                    Crear copia de seguretat
                </div>
            `;
        }
    }
})