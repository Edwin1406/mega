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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Corrugador</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-top: 20px;
            font-size: 2rem;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filters select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #fff;
        }

        .filters label {
            font-size: 1rem;
            font-weight: bold;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .chart-container {
            width: 45%;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-container h2 {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Dashboard Corrugador</h1>

    <div class="dashboard-container">
        <!-- Filtros -->
        <div class="filters">
            <div>
                <label for="filterGramaje">Filtrar por Gramaje:</label>
                <select id="filterGramaje">
                    <option value="">Todos</option>
                </select>
            </div>

            <div>
                <label for="filterAncho">Filtrar por Ancho:</label>
                <select id="filterAncho">
                    <option value="">Todos</option>
                </select>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="charts">
            <!-- Gráfico de Barras -->
            <div class="chart-container">
                <h2>Existencias por Línea</h2>
                <div id="chart-bar"></div>
            </div>

            <!-- Gráfico de Pastel CAJA-KRAFT -->
            <div class="chart-container">
                <h2>Existencias de CAJA-KRAFT</h2>
                <div id="chart-pie-kraft"></div>
            </div>

            <!-- Gráfico de Pastel CAJA-BLANCO -->
            <div class="chart-container">
                <h2>Existencias de CAJA-BLANCO</h2>
                <div id="chart-pie-blanco"></div>
            </div>
        </div>
    </div>

    <script>
        let barChart, pieChartKraft, pieChartBlanco;
        let originalData;

        // Cargar datos desde el backend
        fetch('https://megawebsistem.com/admin/api/apicorrugador')
            .then(response => response.json())
            .then(data => {
                originalData = data;
                initializeFilters(data);
                renderCharts(data);
            })
            .catch(error => console.error('Error al cargar datos:', error));

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

        // Llenar los selectores con opciones
        function populateFilter(filterId, values) {
            const select = document.getElementById(filterId);
            values.forEach(value => {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value;
                select.appendChild(option);
            });
        }

        // Renderizar las gráficas
        function renderCharts(data) {
            // Gráfico de Barras
            const barSeries = Object.keys(data).map(linea => ({
                name: linea,
                data: data[linea].data
            }));

            const labels = Array.from(new Set(Object.values(data).flatMap(linea => linea.labels)));

            const barOptions = {
                series: barSeries,
                chart: { type: 'bar', height: 400 },
                xaxis: { categories: labels },
                title: { text: 'Existencias por Línea y Gramaje/Ancho', align: 'center' },
                colors: ['#1E90FF', '#28B463', '#F39C12']
            };

            if (barChart) barChart.destroy();
            barChart = new ApexCharts(document.querySelector("#chart-bar"), barOptions);
            barChart.render();

            // Gráfico de Pastel CAJA-KRAFT
            renderPieChart('CAJA-KRAFT', data, '#chart-pie-kraft');

            // Gráfico de Pastel CAJA-BLANCO
            renderPieChart('CAJA-BLANCO', data, '#chart-pie-blanco');
        }

        // Función para renderizar gráficos de pastel
        function renderPieChart(linea, data, chartId) {
            const lineaData = data[linea] || { labels: [], data: [] };

            const options = {
                series: lineaData.data,
                chart: { type: 'pie', height: 300 },
                labels: lineaData.labels,
                title: { text: `Existencias de ${linea}`, align: 'center' },
                colors: linea === 'CAJA-KRAFT' ? ['#3498db', '#e67e22', '#2ecc71'] : ['#9b59b6', '#e74c3c', '#1abc9c']
            };

            if (linea === 'CAJA-KRAFT') {
                if (pieChartKraft) pieChartKraft.destroy();
                pieChartKraft = new ApexCharts(document.querySelector(chartId), options);
                pieChartKraft.render();
            } else if (linea === 'CAJA-BLANCO') {
                if (pieChartBlanco) pieChartBlanco.destroy();
                pieChartBlanco = new ApexCharts(document.querySelector(chartId), options);
                pieChartBlanco.render();
            }
        }

        // Aplicar filtros
        function applyFilters() {
            const selectedGramaje = document.getElementById('filterGramaje').value;
            const selectedAncho = document.getElementById('filterAncho').value;

            const filteredData = {};

            Object.keys(originalData).forEach(linea => {
                const labels = [];
                const data = [];

                originalData[linea].labels.forEach((etiqueta, index) => {
                    const gramaje = originalData[linea].gramajes[index];
                    const ancho = originalData[linea].anchos[index];

                    if (
                        (selectedGramaje === '' || gramaje == selectedGramaje) &&
                        (selectedAncho === '' || ancho == selectedAncho)
                    ) {
                        labels.push(etiqueta);
                        data.push(originalData[linea].data[index]);
                    }
                });

                if (data.length > 0) {
                    filteredData[linea] = { labels, data };
                }
            });

            renderCharts(filteredData);
        }

        document.getElementById('filterGramaje').addEventListener('change', applyFilters);
        document.getElementById('filterAncho').addEventListener('change', applyFilters);
    </script>
</body>
</html>