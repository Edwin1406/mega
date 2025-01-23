<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<ul class="lista-areas-produccion">
    <li class="areas-produccion-medium">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO MEDIUM :
            <?php if (isset($totalCostoM) && $totalCostoM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoM ?> $ </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> $ 0  </span>
            <?php endif; ?>
        </a>
    </li>

</ul>