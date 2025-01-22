<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<ul class="lista-areas-produccion">
    <li class="areas-produccion">
        <a href="/admin/produccion/materia/corrugador">
            <i class="fas fa-industry">  </i> Total Corrugador :
            <?php if($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?> 
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
