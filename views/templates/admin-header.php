<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav">
                <!-- nombre usuario -->
             
                <form method="POST" action="/logout" class="dashboard__form">
                <span class="dashboard__usuario">
                    <?php echo $_SESSION['email'] ?>
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>