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
        <label for="gramaje">Rango de Gramaje:</label>
        <select name="gramaje" id="gramaje">
            <option value="0-0">Seleccione</option>
            <option value="0-100">0 - 100</option>
            <option value="100-200">100 - 200</option>
            <option value="200-300">200 - 300</option>
        </select>
    </div>
    <br>
    <div>
        <label for="ancho">Ancho:</label>
        <input type="number" name="ancho" id="ancho" placeholder="Ingrese el ancho">
    </div>
    <div>
        <button type="submit">Filtrar</button>
    </div>
</form>
<!-- Canvas para el gráfico -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const materias = <?php echo json_encode($materias); ?>;

    const labels = materias.map(materia => materia.descripcion);
    const data = materias.map(materia => parseFloat(materia.existencia));

    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Existencia',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });



      // Manejar envío del formulario
      document.getElementById('filterForm').addEventListener('submit', function (e) {
        // Permitir recarga para obtener datos actualizados desde PHP
    });
</script>
