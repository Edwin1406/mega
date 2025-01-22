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


<!-- Formulario de filtro -->
<form action="/admin/produccion/materia/corrugador" method="POST">
    <div>
        <label for="gramajeMin">Gramaje Mínimo:</label>
        <input type="number" name="gramajeMin" id="gramajeMin" placeholder="Mínimo">
    </div>
    <div>
        <label for="gramajeMax">Gramaje Máximo:</label>
        <input type="number" name="gramajeMax" id="gramajeMax" placeholder="Máximo">
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
    // Obtener datos desde PHP
    const materias = <?php echo $jsonMaterias; ?>;

    // Formatear datos para el gráfico
    const labels = materias.map(materia => materia.descripcion);
    const data = materias.map(materia => parseFloat(materia.existencia));

    // Crear el gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // Descripciones de las materias
            datasets: [{
                label: 'Existencia',
                data: data, // Existencia de cada materia
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
