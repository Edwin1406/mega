<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>


        <style>
            .nombre_header {
                color: white;
                font-size: 1.8rem;
                margin-right: 3rem;
            }
        </style>
        <nav class="dashboard__nav">
                <!-- nombre usuario -->

                <form method="POST" action="/logout" class="dashboard__form">
               <p class="enlace_header" ><?php 
                session_start();
                echo $_SESSION['nombre'] ?> </p> 
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>