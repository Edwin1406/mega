<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<ul class="lista-areas-produccion">
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-industry">  </i> TOTAL REGISTROS :
            <?php if($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?> 
        </a>
    </li>
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA GENERAL :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>

    
    <li class="areas-produccion">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO GENERAL :
            <?php if($totalCosto > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCosto ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>





<ul class="lista-areas-produccion">



<li class="areas-produccion-craft">
        <a href="/admin/produccion/materia/cajacraft">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-KRAFT :
            <?php if($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?> 
        </a>
    </li>
    
    <li class="areas-produccion-craft">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO KRAFT :
            <?php if($totalCostoK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoK ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>

</ul>

<ul class="lista-areas-produccion">

<li class="areas-produccion-blanco">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-BLANCO :
            <?php if($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
    
    <li class="areas-produccion-blanco">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO BLANCO :
            <?php if($totalCostoB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoB ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>


</ul>
<ul class="lista-areas-produccion">

   
<li class="areas-produccion-medium">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-MEDIUM :
            <?php if($totalExistenciaM > 0): ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> KG</span>
            <?php endif; ?> 
        </a>
    </li>
    <li class="areas-produccion-medium">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO MEDIUM :
            <?php if($totalCostoM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoM ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>