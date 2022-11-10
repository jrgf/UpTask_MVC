<div class="contenedor restablecer">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
            Coloca tu nueva contraseña
        </p>
        <?php include_once __DIR__.'/../templates/alertas.php'?>
        <?php if($mostrar){?>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Nueva Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Nueva Contraseña">
            </div>
            <div class="campo">
                <label for="password2">Comfirma Tu Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Confirma Contraseña">
            </div>
            <input type="submit" value="Guardar Contraseña" class="boton">
        </form>
        <?php } ?>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            
        </div>
    </div><!--Contenedor SM -->
</div>