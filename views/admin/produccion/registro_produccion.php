<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/index" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>




<?php if(count($escoge_registro)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
   <ul class="lista-areas-produccion">
    <?php foreach($escoge_registro as $produccionA) { ?>
        <li class="areas-produccion">
            <a href="<?php 
                $area = trim($produccionA->area_registro);
                $url = ''; // Inicializa la variable para la URL específica
                $id = $produccionA->url; // Obtiene el ID del área

                // Asigna una URL específica basada en el área
                if($area === 'maquinas'|| $area === 'MAQUINAS') {
                    $url = "/admin/produccion/maquinas/crear?id=".$id;
                } elseif($area === 'papel'|| $area === 'PAPEL') {
                    $url = "/admin/produccion/papel/crear?id=".$id;
                }elseif($area === 'proveedor'|| $area === 'PROVEEDOR') {
                    $url = "/admin/produccion/subirexcel/crear?id=".$id;
                }

                echo $url; // Muestra la URL específica
            ?>">
                <?php 
                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($area === 'maquinas'|| $area === 'MAQUINAS') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($area === 'papel'|| $area === 'PAPEL') {
                        $icono = '<i class="fa-solid fa-scroll"></i>'; // ícono de cotizació  
                    } elseif($area === 'proveedor'|| $area === 'PROVEEDOR') {
                        $icono = '<i class="fa-solid fa-users"></i>'; // ícono de cotización
                    }
                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>









