<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/index" class="dashboard__enlace <?php echo pagina_actual('/index') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>
        </a>

       

        <a href="/admin/area/crear" class="dashboard__enlace <?php echo pagina_actual('/area') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
            Area
            </span>
        </a>

        <a href="/admin/areas" class="dashboard__enlace <?php echo pagina_actual('/areas') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
             Escoger Areas 
            </span>
        </a>

       
       
    </nav>

</aside>