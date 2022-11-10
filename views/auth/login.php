<div class="contenedor  login">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
            Iniciar Sesión
        </p>
        <?php include_once __DIR__.'/../templates/alertas.php'?>
        <form action="/" class="formulario" method="POST" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email">
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Tu contraseña">
            </div>
            <input type="submit" value="Iniciar Sesión" class="boton">
        </form>
        <div class="acciones">
            <a href="/crear-cuenta">¿No tienes una cuenta?. Crea una aquí</a>
            <a href="/recuperar-cuenta">¿Olvidaste tu contraseña?. Recupera tu cuenta aquí </a>
        </div>
    </div><!--Contenedor SM -->
</div>