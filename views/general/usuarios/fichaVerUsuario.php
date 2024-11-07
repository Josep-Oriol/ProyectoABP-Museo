<?php
    if(isset($_SESSION['Rol'])) {
        print_r($datos);
    ?>
    <section id="fichaVerUsuario">
        <div>
            <div>
                <h2>Dades Principals</h2>
                <div>
                    <div>
                        <div>
                            <label for="fotografia">Fotografia</label>
                            <img src="<?php echo $datos['foto_usuario'] ?>" alt="" id="fotografia">
                        </div>  
                    </div>
                    <div>
                        <div>
                            <label for="usuario">Títol</label>
                            <input type="text" id="usuario" value="<?php echo $datos['usuario'];?>">
                        </div>
                        <div>
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" value="<?php echo $datos['nombre'];?>">
                        </div>
                        <div>
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="nombre" value="<?php echo $datos['apellidos'];?>">
                        </div>
                        <div>
                            <label for="correo">Correo electronico</label>
                            <input type="text" id="correo" value="<?php echo $datos['correo_electronico'];?>">
                        </div>
                        <div>
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" value="<?php echo $datos['telefono'];?>">
                        </div>
                        <div>
                            <label for="rol">Rol</label>
                            <input type="text" id="rol" value="<?php echo $datos['rol'];?>">
                        </div>
                        <div>
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" value="<?php echo $datos['estado'];?>">
                        </div>
                        <div> 
                                <a href=""><img src="images/download.png" alt="icono descargar"></a>
                            <?php
                            switch ($_SESSION['Rol']) {
                                case 'Administració':
                                    ?>
                                        
                                            <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
                                        
                                            <a href="index.php?controller=Obras&action=eliminar&id=<?php echo $id; ?>"><img src="images/borrarv2.png" alt="icono eliminar"></a>
                                    <?php
                                    break;
                                case 'Tècnic':
                                    ?>
                                        
                                            <a href="index.php?controller=Obras&action=editar&id=<?php echo $id; ?>"><img src="images/editarv2.png" alt="icono editar"></a>
                                        
                                    <?php
                                    break;
                            }
                            ?>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    else {
        echo "<meta http-equiv='refresh' content='0; URL=index.php'/>";
    }