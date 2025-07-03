<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/subirexcelreclamos">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div>


<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
   <ul class="lista-areas">
    <?php foreach($escoger as $escoger) { ?>
        <li class="areas">
            <a href="<?php 
                $area = trim($escoger->area);
                $url = ''; // Inicializa la variable para la URL específica
                $id = $escoger->url; // Obtiene el ID del área

                // Asigna una URL específica basada en el área
                if($area === 'PRODUCCION') {
                    $url = "/admin/produccion/index?id=".$id;
                } elseif($area === 'BODEGA') {
                    $url = "/admin/bodega/index?id=".$id;
                } elseif($area === 'COMPRAS') {
                    $url = "/admin/compras/index?id=".$id;
                } elseif($area === 'VENTAS') {
                    $url = "/admin/vendedor/cliente/cotizador?id=".$id;
                } elseif($area === 'RECURSOS HUMANOS') {
                    $url = "/admin/recursos-humanos/index?id=".$id;
                } elseif($area === 'SISTEMAS') {
                    $url = "/admin/sistemas/index?id=".$id;
                } elseif($area === 'PRODUCTO TERMINADO') {
                    $url = "/admin/producto-terminado/index?id=".$id;
                }elseif($area === 'ARTES') {
                    $url = "/admin/vendedor/cliente/crear?id=".$id;
                } elseif($area === 'COMERCIAL') {
                    $url = "/admin/comercial/crear?id=".$id;
                } elseif($area === 'FINANCIERO') {
                    $url = "/admin/financiero/tabla?id=".$id;
                }elseif($area === 'CONTROL') {
                    $url = "/admin/control/crear?id=".$id;
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
                    }elseif($area === 'ARTES') {
                        $icono = '<i class="fas fa-user-tie"></i>'; // ícono de vendedor
                    } elseif($area === 'COMERCIAL') {
                        $icono = '<i class="fas fa-user-tie"></i>'; // ícono de comercial
                    } elseif($area === 'FINANCIERO') {
                        $icono = '<i class="fas fa-money-check-alt"></i>'; // ícono de financiero
                    }elseif($area === 'CONTROL') {
                        $icono = '<i class="fas fa-shield-alt"></i>'; // ícono de control
                    }
                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>














