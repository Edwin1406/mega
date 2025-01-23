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

        /* Contenedor del Dashboard */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Filtros */
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

        /* Contenedor del Gráfico */
        #chart {
            margin: 0 auto;
        }

        /* Estilo de Mensajes */
        .message {
            text-align: center;
            color: #e74c3c;
            font-size: 1.2rem;
            font-weight: bold;
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

        <!-- Gráfico -->
        <div id="chart"></div>
    </div>

    <script>
        let chart; // Variable para el gráfico
        let originalData; // Datos originales desde el backend

        // Cargar datos desde el backend
        fetch('https://megawebsistem.com/admin/api/apicorrugador') // Cambia a la ruta correcta de tu API
            .then(response => response.json())
            .then(data => {
                originalData = data; // Guardar datos originales
                initializeFilters(data); // Inicializar filtros
                renderChart(data); // Renderizar gráfica inicial
            })
            .catch(error => console.error('Error al cargar datos:', error));

        // Inicializar los filtros con valores únicos
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

        // Renderizar la gráfica
        function renderChart(data) {
            const series = Object.keys(data).map(linea => ({
                name: linea,
                data: data[linea].data
            }));

            const labels = [];
            Object.values(data).forEach(linea => {
                linea.labels.forEach(label => {
                    if (!labels.includes(label)) {
                        labels.push(label); // Evitar duplicados
                    }
                });
            });

            const hasData = series.some(serie => serie.data.length > 0);

            if (!hasData) {
                if (chart) chart.destroy();
                document.querySelector("#chart").innerHTML = "<div class='message'>No hay datos para cargar</div>";
                return;
            }

            const options = {
                series: series,
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: true
                    }
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
                    text: 'Existencias por Línea y Gramaje/Ancho',
                    align: 'center',
                    style: {
                        fontSize: '18px',
                        color: '#333'
                    }
                },
                colors: ['#1E90FF', '#28B463', '#F39C12'], // Colores modernos
                tooltip: {
                    theme: 'dark'
                }
            };

            if (chart) chart.destroy();
            document.querySelector("#chart").innerHTML = "";
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        // Aplicar filtros dinámicos
        document.getElementById('filterGramaje').addEventListener('change', applyFilters);
        document.getElementById('filterAncho').addEventListener('change', applyFilters);

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

            renderChart(filteredData);
        }











 // Inicializar los filtros con valores únicos
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

        // Renderizar los gráficos
        function renderCharts(data) {
            // Filtrar y procesar datos para cada línea
            const kraftData = processData(data['CAJA-KRAFT']);
            const blancoData = processData(data['CAJA-BLANCO']);

            // Configuración y renderización del gráfico de CAJA-KRAFT
            const optionsKraft = {
                series: kraftData.series,
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: kraftData.labels,
                title: {
                    text: 'CAJA-KRAFT: Existencias por Gramaje/Ancho',
                    align: 'center',
                    style: {
                        fontSize: '16px',
                        color: '#fff'
                    }
                },
                colors: ['#3498db', '#1abc9c', '#e67e22', '#9b59b6'],
                tooltip: {
                    theme: 'dark',
                }
            };

            if (chartKraft) chartKraft.destroy();
            chartKraft = new ApexCharts(document.querySelector("#chartKraft"), optionsKraft);
            chartKraft.render();

            // Configuración y renderización del gráfico de CAJA-BLANCO
            const optionsBlanco = {
                series: blancoData.series,
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: blancoData.labels,
                title: {
                    text: 'CAJA-BLANCO: Existencias por Gramaje/Ancho',
                    align: 'center',
                    style: {
                        fontSize: '16px',
                        color: '#fff'
                    }
                },
                colors: ['#e74c3c', '#f1c40f', '#2ecc71', '#8e44ad'],
                tooltip: {
                    theme: 'dark',
                }
            };

            if (chartBlanco) chartBlanco.destroy();
            chartBlanco = new ApexCharts(document.querySelector("#chartBlanco"), optionsBlanco);
            chartBlanco.render();
        }

        // Procesar datos para gráficos de pastel
        function processData(data) {
            const labels = [];
            const series = [];

            if (data) {
                data.labels.forEach((label, index) => {
                    labels.push(label);
                    series.push(parseInt(data.data[index])); // Sumar la existencia
                });
            }

            return { labels, series };
        }

        // Aplicar filtros dinámicos
        document.getElementById('filterGramaje').addEventListener('change', applyFilters);
        document.getElementById('filterAncho').addEventListener('change', applyFilters);

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







    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Pastel - Existencias</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        h1 {
            text-align: center;
            color: #1abc9c;
            margin: 20px 0;
        }

        .chart-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #34495e;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .chart {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
        }

        .filters {
            text-align: center;
            margin-bottom: 20px;
        }

        .filters select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            font-size: 1rem;
            color: #333;
        }

        .filters label {
            font-size: 1rem;
            color: #ecf0f1;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>

