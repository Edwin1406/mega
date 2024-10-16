<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/index" class="dashboard__enlace <?php echo pagina_actual('/index') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>
        </a>

       

        <a href="/admin/proveedores" class="dashboard__enlace <?php echo pagina_actual('/proveedores') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
            Proveedores
            </span>
        </a>

       
       
    </nav>

</aside>