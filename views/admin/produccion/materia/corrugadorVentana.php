<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>




<ul class="lista-areas-produccion">
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> TOTAL EN EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>

</ul>




<ul class="lista-areas-produccion">
    <li class="areas-produccion-craft" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajacraft">
            <i class="fas fa-scroll"></i> TOTAL CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajamedium">
            <i class="fas fa-shopping-cart"></i> TOTAL CAJA-MEDIUM :
            <?php if (isset($totalExistenciaM) && $totalExistenciaM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> KG </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> 0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>

<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->




















