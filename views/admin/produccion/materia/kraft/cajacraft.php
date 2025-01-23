<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>





<ul class="lista-areas-produccion">
    <li class="areas-produccion-craft">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO KRAFT :
            <?php if ($totalCostoK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoK ?> $ </span>
            <?php endif; ?>
        </a>
    </li>
</ul>
