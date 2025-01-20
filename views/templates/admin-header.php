<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="">
            <h2 class="dashboard__logo">
                
               MEGASTOCK
            </h2>
        </a>
        <nav class="dashboard__nav"> 

            <?php
session_start();
$nombre = $_SESSION['nombre'] ?? '';

// Determina el ícono según el nombre
$icono = '';
if ($nombre === 'ventas') {
    $icono = '<i class="fa fa-shopping-cart" aria-hidden="true"></i>'; // Ícono para ventas
} elseif ($nombre === 'produccion') {
    $icono = '<i class="fa fa-industry" aria-hidden="true"></i>'; // Ícono para producción
} else {
    $icono = '<i class="fa fa-question-circle" aria-hidden="true"></i>'; // Ícono por defecto
}
?>
<p class="dashboard__submit--name">
    <?php echo $icono; ?>
    <?php echo htmlspecialchars($nombre); ?>
</p>


                <form method="POST" action="/logout" class="dashboard__form">
             
                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
            </form>
        </nav>
    </div>

</header>