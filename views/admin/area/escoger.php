<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="lista-areas">
    <?php foreach ($escoger as $escoger) : ?>
        <li class="areas">
            <a href="<?= '/admin/' . strtolower(str_replace(' ', '-', $escoger->area)) . '/index?id=' . htmlspecialchars($escoger->url) ?>">
                <?= '<i class="' . getIcon($escoger->area) . '"></i> ' . htmlspecialchars($escoger->area) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
function getIcon($area) {
    $icons = [
        'PRODUCCION' => 'fas fa-industry',
        'BODEGA' => 'fas fa-shopping-cart',
        'COMPRAS' => 'fas fa-shopping-basket',
        'VENTAS' => 'fas fa-handshake',
        'RECURSOS HUMANOS' => 'fas fa-users',
        'SISTEMAS' => 'fas fa-laptop-code',
        'PRODUCTO TERMINADO' => 'fas fa-box-open',
    ];
    return $icons[$area] ?? 'fas fa-question'; // Retorna un ícono por defecto si el área no está en el mapeo
}
?>




<?php  }?>







