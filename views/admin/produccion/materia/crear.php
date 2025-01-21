<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton-izquierdo">
    <a class="dashboard__boton" href="/admin/produccion/materia/graficas">
        <i class="fa-solid fa-arrow-right"></i>
        Ver Graficas
    </a>
</div>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/tabla">
        <i class="fa-solid fa-arrow-right"></i>
        Ver a Materia Prima
    </a>
</div>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/excel">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
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
                }elseif($area === 'materia prima'|| $area === 'MATERIA PRIMA') {
                    $url = "/admin/produccion/materia/crear?id=".$id;
                }elseif($area === 'pedidos proyectos'|| $area === 'PEDIDOS PROYECTOS') {
                    $url = "/admin/produccion/estadistica/crear?id=".$id;
                }

                echo $url;
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
                    } elseif($area === 'producto'|| $area === 'MATERIA PRIMA') {
                        $icono = '<i class="fa-solid fa-box"></i>'; // ícono de cotización
                    } elseif($area === 'pedidos proyectos'|| $area === 'PEDIDOS PROYECTOS') {
                        $icono = '<i class="fa-solid fa-file"></i>'; // Ícono de documento

                    }
                    // Muestra el ícono y el nombre del área
                    echo $icono . ' ' . $area;
                ?>
            </a>
        </li>
    <?php } ?>
</ul>



<?php  }?>













<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div>