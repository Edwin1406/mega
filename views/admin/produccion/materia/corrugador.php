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











<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



<h1>Dashboard Corrugador</h1>

<!-- Filtros -->
<div>
    <label for="filterGramaje">Filtrar por Gramaje:</label>
    <select id="filterGramaje">
        <option value="">Todos</option>
    </select>

    <label for="filterAncho">Filtrar por Ancho:</label>
    <select id="filterAncho">
        <option value="">Todos</option>
    </select>
</div>

<!-- Gráfica -->
<div id="chart"></div>

<script>
    // Variables globales
    let chart; // Gráfico de ApexCharts
    let originalData; // Datos originales desde el backend

    // Cargar datos desde el backend
    fetch('https://megawebsistem.com/admin/api/apicorrugador')
        .then(response => response.json())
        .then(data => {
            originalData = data; // Guardar datos originales
            initializeFilters(data); // Inicializar filtros dinámicos
            renderChart(data); // Renderizar gráfico inicial
        });

    // Inicializar los filtros
    function initializeFilters(data) {
        const gramajes = new Set();
        const anchos = new Set();

        Object.values(data).forEach(linea => {
            linea.gramajes.forEach(g => gramajes.add(g));
            linea.anchos.forEach(a => anchos.add(a));
        });

        populateFilter('filterGramaje', Array.from(gramajes));
        populateFilter('filterAncho', Array.from(anchos));
    }

    function populateFilter(filterId, values) {
        const select = document.getElementById(filterId);
        values.forEach(value => {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = value;
            select.appendChild(option);
        });
    }

    function renderChart(data) {
    const series = Object.keys(data).map(linea => ({
        name: linea,
        data: data[linea].data
    }));

    const labels = data[Object.keys(data)[0]]?.labels || [];

    // Verificar si hay datos
    const hasData = series.some(serie => serie.data.length > 0);

    // Si no hay datos, mostrar mensaje
    if (!hasData) {
        if (chart) {
            chart.destroy(); // Destruir gráfico previo si existe
        }
        document.querySelector("#chart").innerHTML = "<p style='text-align: center; color: red;'>No hay datos para cargar</p>";
        return;
    }

    // Opciones del gráfico
    const options = {
        series: series,
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: labels
        },
        title: {
            text: 'Existencias por Línea y Gramaje'
        }
    };

    // Renderizar gráfico
    if (chart) {
        chart.destroy(); // Destruir gráfico previo si existe
    }

    document.querySelector("#chart").innerHTML = ""; // Limpiar contenido previo
    chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}


    // Filtros dinámicos
    document.getElementById('filterGramaje').addEventListener('change', applyFilters);
    document.getElementById('filterAncho').addEventListener('change', applyFilters);

    function applyFilters() {
        const selectedGramaje = document.getElementById('filterGramaje').value;
        const selectedAncho = document.getElementById('filterAncho').value;

        const filteredData = {};

        Object.keys(originalData).forEach(linea => {
            const labels = [];
            const data = [];

            originalData[linea].labels.forEach((gramaje, index) => {
                const ancho = originalData[linea].anchos[index];
                if (
                    (selectedGramaje === '' || gramaje == selectedGramaje) &&
                    (selectedAncho === '' || ancho == selectedAncho)
                ) {
                    labels.push(gramaje);
                    data.push(originalData[linea].data[index]);
                }
            });

            if (data.length > 0) {
                filteredData[linea] = { labels, data };
            }
        });

        renderChart(filteredData);
    }
</script>