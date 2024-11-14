document.addEventListener('DOMContentLoaded', function() {
    const formLogin = document.getElementById('formLogin');

    if (formLogin) {
        formLogin.addEventListener('submit', function(event) {
            event.preventDefault();
    
            let user = document.getElementsByName('username')[0].value;
            let password = document.getElementsByName('password')[0].value;
    
            let data = {
                username: user,
                password: password
            };
    
            let dataJson = JSON.stringify(data);
    
            fetch('index.php?controller=Usuarios&action=validarUser', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: dataJson
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success'){
                    console.log('funciona')
                    window.location.href = 'index.php?controller=Obras&action=mostrarObras';
                }else if (data.status === 'error'){
                    const errorDiv = document.getElementById('error');
                    errorDiv.innerHTML ="Usuari o contrasenya incorrectes";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
        })
    }
})
