<link href="https://fonts.cdnfonts.com/css/dear-story" rel="stylesheet">


<div class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <?php if (isAuth()): ?>
                <a href="<?php echo isAdmin() ? '/dashboard' : '/finalizar-registro'?>" class="header__enlace"> Administrar</a>
                <form method="POST" action="/sitioweb/logout" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>

            <?php else: ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/" class="header__enlace">Iniciar Sesión</a>
            <?php endif; ?>

        </nav>
        <div class="header__contenido">
            <a href="">
                <h1 class="header__logo">
                    MEGASTOCK
                </h1>
            </a>
            <p class="header__texto"> 16-10-2024</p>
            <p class="header__texto header__texto--modalidad"> EN-LINEA</p>
            <a href="https://serviacrilico.com/" class="header__boton"> SISTEMA</a>

        </div>
    </div>
</div>

<!-- <div class="barra">
    <div class="barra__contenido">
        <a href="">
            <h2 class="barra__logo"> Sitio Web </h2>
        </a>
        <nav class="navegacion">
            <a href="/sitioweb/evento" class="navegacion__enlace <?php echo pagina_actual('/evento') ? 'navegacion__enlace--actual' : ''; ?>">Evento</a>
            <a href="/sitioweb/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : ''; ?>">Paquetes</a>
            <a href="/sitioweb/conferencias" class="navegacion__enlace <?php echo pagina_actual('/conferencias') ? 'navegacion__enlace--actual' : ''; ?>">workshops / Conferencias</a>
            <a href="/sitioweb/registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : ''; ?>">Comprar Pases</a>
        </nav>
    </div>
</div> -->