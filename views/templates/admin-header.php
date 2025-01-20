<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav"> 
            


            <form method="POST" action="/logout" class="dashboard__form">
            <p class="dashboard__submit--name fa fa-user">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';
    ?>
</p>

             
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>