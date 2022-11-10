<div class="contenedor  crear">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
            Crea tu cuenta en UpTask
        </p>
        <?php include_once __DIR__.'/../templates/alertas.php'?>
        <form action="/crear-cuenta" class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre"
                    value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email"
                    value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Tu contraseña">
            </div>
            <div class="campo">
                <label for="password2">Confirma Tu Contraseña</label>
                <input type="password" name="password2" id="password2" placeholder="Confirma la contraseña">
            </div>
            <input type="submit" value="Crea Tu Cuenta" class="boton">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/recuperar-cuenta">¿Olvidaste tu contraseña?. Recupera tu cuenta aquí </a>
        </div>
    </div>
    <!--Contenedor SM -->
</div>