<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/index" class="dashboard__enlace <?php echo pagina_actual_admin('/index') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu--texto">
                Inicio
            </span>
        </a>

       
        <?php 
        
        if($_SESSION['email'] === 'produccion@megaecuador.com'): ?>
        <a href="/admin/area/crear" class="dashboard__enlace <?php echo pagina_actual_admin('/crear') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
            Area
            </span>
        </a>
        <?php endif; ?>

        <a href="/admin/area/escoger" class="dashboard__enlace <?php echo pagina_actual_admin('/escoger') ? 'dashboard__enlace--actual' :'' ?>">
            <i class="fa-duotone fa-solid fa-calendar-days dashboard__icono"></i>
            <span class="dashboard__menu--texto">
             Escoger Areas 
            </span>
        </a>

       
       
    </nav>

</aside>