<div id="login"> 
    <div>
        <img src="images/logo.png" alt="">
    </div>
    <div>
        <div>
            <img src="images/casita.png" alt="">
            <img src="images/volver.png" alt="">
        </div>
        
        <div>
            <img src="images/login_icon.png" alt="">
        </div>
        <div>
            <form action="index.php?controller=Usuarios&action=validarUser" method="POST">
                <input type="text" placeholder=" Usuari" name="username">
                <input type="password" placeholder=" Contrasenya" name="password">

                <input type="submit" id="submit" value="Accedir">
            </form>
        </div>
    </div>
</div>



