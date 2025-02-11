<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


    <style>
        .body {
            background-image: linear-gradient(to right, #94a1b5, #7ea6b5, #72aaa8, #7baa90, #97a676) !important;
            font-family: Arial, sans-serif;
        }

        .header {
            width: 100%;
            padding: 10px;
            background-color: #24292d;
            color: #f8f2f2;
            text-align: center;
            position: relative;
        }

        .menu-toggle {
            background: none;
            border: none;
            color: #f8f2f2;
            font-size: 2rem;
            cursor: pointer;
            display: none;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .item {
            background-color: #24292d;
            color: #f8f2f2;
            padding: 10px 15px;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 10%;
        }

        .item:hover {
            background-color: #d6eaf8;
            scale: 1.1;
            color: #24292d;
            border-radius: 1rem;
        }

        .item a {
            color: inherit;
            text-decoration: none;
            display: block;
            text-align: center;
            font-size: 1.6rem;
        }

        .mobile-menu {
            display: none;
            flex-direction: column;
            background-color: #24292d;
            position: absolute;
            top: 60px;
            right: 0;
            left: 0;
            padding: 10px;
        }

        .mobile-menu .item {
            width: 100%;
            padding: 15px 0;
        }

        @media (min-width: 1024px) {
            .menu-toggle1 {
                display: none;
            }

            .container {
                display: flex;
            }

            .mobile-menu {
                display: none;
            }

            .item {
                width: 20%;
            }
        }

        @media (max-width: 1024px) {
            .menu-toggle1 {
                display: block;
            }

            .container {
                display: none;
            }

            .mobile-menu.active {
                display: flex;
            }
        }
    </style>


    <div class="header">
        <button class="menu-toggle1" aria-label="Abrir menú">☰</button>
        <nav class="mobile-menu">
            <div class="item"><a href="/admin/produccion/estimar/index"> <i class="fas fa-home"></i> INICIO</a></div>
            <div class="item"><a href="/admin/produccion/estimar/micro"> <i class="fas fa-industry"></i> MATERIA PRIMA</a></div>
            <div class="item"><a href="/admin/produccion/estimar/cajas"> <i class="fas fa-scroll"></i> INSUMOS</a></div>
            <div class="item"><a href="/admin/produccion/estimar/separadores"> <i class="fas fa-newspaper"></i> RUBROS</a></div>
        </nav>
    </div>

    <div class="container">
        <div class="item"><a href="/admin/produccion/estimar/index"> <i class="fas fa-home"></i> INICIO</a></div>
        <div class="item"><a href="/admin/produccion/estimar/micro"> <i class="fas fa-industry"></i> MATERIA PRIMA</a></div>
        <div class="item"><a href="/admin/produccion/estimar/cajas"> <i class="fas fa-scroll"></i> INSUMOS</a></div>
        <div class="item"><a href="/admin/produccion/estimar/separadores"> <i class="fas fa-newspaper"></i> RUBROS</a></div>
    </div>

    <script>
        document.querySelector('.menu-toggle1').addEventListener('click', function() {
            const menu = document.querySelector('.mobile-menu');
            menu.classList.toggle('active');
        });
    </script>
    






