<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav">
            <a href="/admin/index" class="dashboard__enlace <?php echo pagina_actual_admin('/index') ? 'dashboard__enlace--actual' :'' ?>">
                <i class="fa-solid fa-house dashboard__icono"></i>
                <span class="dashboard__menu--texto">
                    Inicio
                </span>
            <form method="POST" action="/logout" class="dashboard__form">
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>