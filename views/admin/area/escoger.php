<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
   <ul class="lista-areas">
    <?php foreach($escoger as $escoger) { ?>
        <li class="areas">
            <a href="<?php 
                $area = trim($escoger->area);
                $url = ''; // Inicializa la variable para la URL específica

                // Asigna una URL específica basada en el área
                if($area === 'PRODUCCION') {
                    $url = "/admin/produccion/index?id=<?php echo $escoger->url ?>";
                } elseif($area === 'BODEGA') {
                    $url = "/admin/bodega?id=<?php echo $escoger->url ?>";
                } elseif($area === 'COMPRAS') {
                    $url = "/admin/compras?id=<?php echo $escoger->url ?>";
                } elseif($area === 'VENTAS') {
                    $url = "/admin/ventas?id=<?php echo $escoger->url ?>";
                } elseif($area === 'RECURSOS HUMANOS') {
                    $url = "/admin/recursos-humanos?id=<?php echo $escoger->url ?>";
                } elseif($area === 'SISTEMAS') {
                    $url = "/admin/sistemas?id=<?php echo $escoger->url ?>";
                } elseif($area === 'PRODUCTO TERMINADO') {
                    $url = "/admin/producto-terminado?id=<?php echo $escoger->url ?>";
                }

                echo $url; // Muestra la URL específica
            ?>">
                <?php 
                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($area === 'PRODUCCION') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($area === 'BODEGA') {
                        $icono = '<i class="fas fa-shopping-cart"></i>'; // ícono de BODEGA
                    } elseif($area === 'COMPRAS') {
                        $icono = '<i class="fas fa-shopping-basket"></i>'; // ícono de compras
                    } elseif($area === 'VENTAS') {
                        $icono = '<i class="fas fa-handshake"></i>'; // ícono de ventas
                    } elseif($area === 'RECURSOS HUMANOS') {
                        $icono = '<i class="fas fa-users"></i>'; // ícono de recursos humanos
                    } elseif($area === 'SISTEMAS') {
                        $icono = '<i class="fas fa-laptop-code"></i>'; // ícono de sistemas
                    } elseif($area === 'PRODUCTO TERMINADO') {
                        $icono = '<i class="fas fa-box-open"></i>'; // ícono de producto terminado
                    }

                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>







