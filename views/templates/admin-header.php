<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav"> 
            
        <?php if (isset($_SESSION['email'])): ?>

            <form method="POST" action="/logout" class="dashboard__form">
            <p class="dashboard__submit--name fa fa-user"> <?php repeatSession(); ?> </p>
            <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        <?php endif; ?>
        </nav>
    </div>

</header>