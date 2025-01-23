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


<ul class="lista-areas-produccion">
    <li class="areas-produccion">
        <a href="/admin/produccion/materia/corrugador">
            <i class="fas fa-industry"></i> CORRUGADOR
        </a>
    </li>
    <li class="areas-produccion">
        <a href="/admin/produccion/materia/microcorrugador">
            <i class="fas fa-scroll"></i> MICRO CORRUGADOR
        </a>
    </li>
    <li class="areas-produccion">
        <a href="/admin/produccion/materia/periodico">
            <i class="fas fa-newspaper"></i> PERIODICO 
        </a>
    </li>
</ul>





<ul class="lista-areas-produccion">
    <li class="areas-produccion-craft">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CORRUGADOR :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-craft">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA MICRO CORRUGADOR :
            <?php if ($totalExistenciaMicro > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaMicro ?> KG</span>
            <?php endif; ?>
        </a>

    </li>

    <li class="areas-produccion-craft">
        <a>
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA PERIODICO :
            <?php if ($totalExistenciaPeriodico > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaPeriodico ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

</ul>


<!-- 

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div> -->