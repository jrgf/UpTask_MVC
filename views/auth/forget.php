<div class="contenedor recuperar">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
            ¿Olvidaste tu contraseña?.Sigue las instrucciones que se te enviaran a tu correo.
            Para recuperarla

        </p>
        <?php include_once __DIR__.'/../templates/alertas.php'?>
        <form action="/recuperar-cuenta" class="formulario" method="POST" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email" value="<?php echo $_POST['email'] ?>" >
            </div>
            
            <input type="submit" value="Recuperar Contraseña" class="boton">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/crear-cuenta">¿No tienes una cuenta?. Crea una aquí</a>
        </div>
    </div><!--Contenedor SM -->
</div>