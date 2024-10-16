<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/index" class="dashboard__enlace <?php echo pagina_actual('/index') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>
        </a>

       

        <a href="/admin/proveedor" class="dashboard__enlace <?php echo pagina_actual('/proveedor') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
            Proveedores
            </span>
        </a>

        <a href="/admin/ancho" class="dashboard__enlace <?php echo pagina_actual('/ancho') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
            Ancho
            </span>
        </a>

       
       
    </nav>

</aside>