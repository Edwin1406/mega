<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav"> 
            <p class="dashboard__submit--name" class="fa fa-user" ><?php session_start(); echo $_SESSION['nombre'] ?> </p> 

                <form method="POST" action="/logout" class="dashboard__form">
             
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>