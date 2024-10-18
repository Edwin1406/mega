<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<?php if(count($escoger_produccion)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
   <ul class="lista-areas-produccion">
    <?php foreach($escoger_produccion as $produccionA) { ?>
        <li class="areas-produccion">
            <a href="<?php 
                $area = trim($produccionA->area_produccion);
                $url = ''; // Inicializa la variable para la URL específica
                $id = $produccionA->url; // Obtiene el ID del área

                // Asigna una URL específica basada en el área
                if($area === 'seccion de registros'|| $area === 'SECCION DE REGISTROS') {
                    $url = "/admin/produccion/registro_produccion?id=".$id;
                } elseif($area === 'COTIZADOR'|| $area === 'cotizador') {
                    $url = "/admin/produccion/cotizador/index?id=".$id;
                } 

                echo $url; // Muestra la URL específica
            ?>">
                <?php 
                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($area === 'SECCION DE REGISTROS'|| $area === 'seccion de registros') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($area === 'COTIZADOR'|| $area === 'cotizador') {
                        $icono = '<i class="fas fa-dollar-sign"></i>'; // ícono de cotización
                    }

                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>









