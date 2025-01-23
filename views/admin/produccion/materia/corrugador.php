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
    <title>Gráfico de Área - Existencias</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .chart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #34495e;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        #chart {
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #1abc9c;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 20px;
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
        }
    </style>
</head>
<body>
    <h1>Dashboard - Existencias por Gramaje y Ancho</h1>
    <div class="chart-container">
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
                name: linea, // Nombre de la línea (e.g., CAJA-KRAFT, CAJA-BLANCO)
                data: data[linea].data // Datos de existencias para cada etiqueta
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
                    height: 400,
                    type: 'area',
                    toolbar: {
                        show: true
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: labels, // Etiquetas únicas combinadas
                    labels: {
                        style: {
                            colors: '#fff'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#fff'
                        }
                    }
                },
                title: {
                    text: 'Existencias por Línea y Gramaje/Ancho',
                    align: 'center',
                    style: {
                        fontSize: '18px',
                        color: '#fff'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#1abc9c'], // Color de degradado
                        inverseColors: false,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                colors: ['#3498db', '#e67e22'], // Colores de las líneas y áreas
                tooltip: {
                    theme: 'dark',
                },
                grid: {
                    borderColor: '#34495e',
                    strokeDashArray: 4
                }
            };

            if (chart) chart.destroy();
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
    </script>
</body>
</html>
