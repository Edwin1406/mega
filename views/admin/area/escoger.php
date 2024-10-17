<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="lista-areas">
    <?php foreach($escoger as $escoger) { ?>
        <li class="areas">
            <a href="/admin/area/paginaArea?id=<?php echo $escoger->url ?>">
                <?php 
                    // Eliminar los espacios en blanco alrededor del valor del área
                    $area = trim($escoger->area);

                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($area === 'PRODUCCION') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($area === 'BODEGA') {
                        $icono = '<i class="fas fa-shopping-cart"></i>'; // ícono de ventas
                    } elseif($area === 'ADMINISTRACION') {
                        $icono = '<i class="fas fa-chart-line"></i>'; // ícono de administración
                    } elseif($area === 'COMPRAS') {
                        $icono = '<i class="fas fa-shopping-basket"></i>'; // ícono de compras
                    } elseif($area === 'VENTAS') {
                        $icono = '<i class="fas fa-handshake"></i>'; // ícono de ventas
                    } elseif($area === 'CONTABILIDAD') {
                        $icono = '<i class="fas fa-calculator"></i>'; // ícono de contabilidad
                    } elseif($area === 'RECURSOS HUMANOS') {
                        $icono = '<i class="fas fa-users"></i>'; // ícono de recursos humanos
                    } elseif($area === 'SISTEMAS') {
                        $icono = '<i class="fas fa-laptop-code"></i>'; // ícono de sistemas
                    } elseif($area === 'MARKETING') {
                        $icono = '<i class="fas fa-bullhorn"></i>'; // ícono de marketing
                    } elseif($area === 'PRODUCTO TERMINADO') {
                        $icono = '<i class="fas fa-truck"></i>'; // ícono de logística
                    } elseif($area === 'CALIDAD') {
                        $icono = '<i class="fas fa-check-circle"></i>'; // ícono de calidad
                    } elseif($area === 'SEGURIDAD') {
                        $icono = '<i class="fas fa-shield-alt"></i>'; // ícono de seguridad
                    } elseif($area === 'MANTENIMIENTO') {
                        $icono = '<i class="fas fa-tools"></i>'; // ícono de mantenimiento
                    } elseif($area === 'ALMACEN') {
                        $icono = '<i class="fas fa-boxes"></i>'; // ícono de almacén
                    } elseif($area === 'COMEDOR') {
                        $icono = '<i class="fas fa-utensils"></i>'; // ícono de comedor
                    } elseif($area === 'LIMPIEZA') {
                        $icono = '<i class="fas fa-broom"></i>'; // ícono de limpieza
                    } 

                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>


<?php  }?>







