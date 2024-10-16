<footer class="footer">
    <div class="footer__grid">
        <div class="footer__contenido">
            <h3 class="footer__logo">
                MEGASTOCK
            </h3>
            <p class="footer__texto">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget nunc. Nullam nec
                ultricies
                nunc. Nullam nec ultricies nunc.
            </p>
        </div>

        <nav class="menu-redes">
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://facebook.com/">
                <span class="menu-redes__ocultar">Facebook</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://twitter.com/">
                <span class="menu-redes__ocultar">Twitter</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://youtube.com/">
                <span class="menu-redes__ocultar">YouTube</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://instagram.com/">
                <span class="menu-redes__ocultar">Instagram</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://tiktok.com/">
                <span class="menu-redes__ocultar">Tiktok</span>
            </a>
            <a class="menu-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://github.com/">
                <span class="menu-redes__ocultar">Tiktok</span>
            </a>
        </nav>

    </div>
    
    <p class="footer__copyright">
        <span class="footer__copyright--regular">
            -Todos los derechos reservados 

            <?php
// Crear un array con los nombres de los meses en español
$meses = [
    1 => 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 
    'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
];

// Crear un array con los nombres de los días en español
$dias = [
    'Sunday' => 'domingo', 'Monday' => 'lunes', 'Tuesday' => 'martes',
    'Wednesday' => 'miércoles', 'Thursday' => 'jueves', 
    'Friday' => 'viernes', 'Saturday' => 'sábado'
];

// Obtener la fecha actual o especificar una fecha particular
$fecha = new DateTime('2024-10-16');

// Obtener el día de la semana y el mes en números
$diaSemana = $dias[$fecha->format('l')]; // Día de la semana en español
$dia = $fecha->format('d'); // Día del mes
$mes = $meses[(int)$fecha->format('m')]; // Mes en español
$anio = $fecha->format('Y'); // Año

// Imprimir la fecha en el formato deseado
echo "$diaSemana $dia de $mes del $anio";
?>


        </span>

    </p>

</footer>