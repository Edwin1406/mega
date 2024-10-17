<h1 class="titulo__heading"> <?php echo $titulo ?> </h1>

<?php if(count($escoger)===0) {?>
    <p class="no-areas">NO HAY AREAS ASIGNADAS </p>

<?php  }else {?>
    <ul class="lista-areas">
    <?php foreach($escoger as $escoger) { ?>
        <li class="areas">
            <a href="/admin/area/paginaArea?id=<?php echo $escoger->url ?>">
                <?php 
                    // Asigna un ícono basado en el área
                    $icono = '';
                    if($escoger->area === 'produccion') {
                        $icono = '<i class="fas fa-industry"></i>'; // ícono de producción
                    } elseif($escoger->area === 'ventas') {
                        $icono = '<i class="fas fa-shopping-cart"></i>'; // ícono de ventas
                    } else {
                        $icono = '<i class="fas fa-briefcase"></i>'; // ícono por defecto
                    }

                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $escoger->area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>


<?php  }?>







