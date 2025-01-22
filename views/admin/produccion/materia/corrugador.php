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
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>








<form action="/admin/produccion/materia/corrugador" method="POST">
    <div>
        <label for="gramaje">Gramaje:</label>
        <input type="number" name="gramaje" id="gramaje" placeholder="Ingrese el gramaje">
    </div>
    <div>
        <label for="ancho">Ancho:</label>
        <input type="number" name="ancho" id="ancho" placeholder="Ingrese el ancho">
    </div>
    <div>
        <button type="submit">Filtrar</button>
    </div>
</form>
