<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/sitioweb/admin/index" class="dashboard__enlace <?php echo pagina_actual('/index') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>
        </a>

        <a href="/sitioweb/admin/ponentes" class="dashboard__enlace <?php echo pagina_actual('/ponentes') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Ponentes
            </span>
        </a>

        <a href="/sitioweb/admin/eventos" class="dashboard__enlace <?php echo pagina_actual('/eventos') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Eventos
            </span>
        </a>

        <a href="/sitioweb/admin/registrados" class="dashboard__enlace <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Registrados
            </span>
        </a>
        <a href="/sitioweb/admin/regalos" class="dashboard__enlace <?php echo pagina_actual('/regalos') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-gift dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Regalos
            </span>
        </a>
    </nav>

</aside>