<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<ul class="lista-areas-produccion">
    <li class="areas-produccion-blanco">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO BLANCO :
            <?php if ($totalCostoB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoB ?> $ </span>
            <?php endif; ?>
        </a>
    </li>


</ul>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico Filtrado</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .message {
            text-align: center;
            color: #666;
            font-size: 18px;
        }
        .chart-container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="filters">
        <label for="filterGramaje">Filtrar por Gramaje:</label>
        <select id="filterGramaje">
            <option value="Todos">Todos</option>
        </select>

        <label for="filterAncho">Filtrar por Ancho:</label>
        <select id="filterAncho">
            <option value="Todos">Todos</option>
        </select>
    </div>

    <div id="message" class="message">Seleccione gramaje y/o ancho para visualizar los datos.</div>

    <div class="chart-container" id="chartContainer" style="display: none;">
        <div id="chart"></div>
    </div>

    <script>
        const apiUrl = 'https://megawebsistem.com/admin/api/apicajablanco'; // Reemplaza con la URL real de tu API

        let originalData; // Datos originales de la API
        let chart; // Referencia al gráfico

        // Cargar datos de la API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                originalData = data;
                populateFilters(data);
            })
            .catch(error => console.error('Error al cargar los datos:', error));

        // Poblar los filtros de gramaje y ancho
        function populateFilters(data) {
            const gramajes = new Set();
            const anchos = new Set();

            Object.values(data).forEach(lineaData => {
                lineaData.gramajes.forEach(gramaje => gramajes.add(gramaje));
                lineaData.anchos.forEach(ancho => anchos.add(ancho));
            });

            const filterGramaje = document.getElementById('filterGramaje');
            const filterAncho = document.getElementById('filterAncho');

            gramajes.forEach(gramaje => {
                const option = document.createElement('option');
                option.value = gramaje;
                option.textContent = gramaje;
                filterGramaje.appendChild(option);
            });

            anchos.forEach(ancho => {
                const option = document.createElement('option');
                option.value = ancho;
                option.textContent = ancho;
                filterAncho.appendChild(option);
            });

            filterGramaje.addEventListener('change', applyFilters);
            filterAncho.addEventListener('change', applyFilters);
        }

        // Aplicar filtros y actualizar el gráfico
        function applyFilters() {
            const selectedGramaje = document.getElementById('filterGramaje').value;
            const selectedAncho = document.getElementById('filterAncho').value;

            const filteredData = [];
            const labels = [];
            const gramajeData = [];
            const anchoData = [];

            Object.keys(originalData).forEach(linea => {
                const lineaData = originalData[linea];

                lineaData.labels.forEach((label, index) => {
                    const gramaje = lineaData.gramajes[index];
                    const ancho = lineaData.anchos[index];

                    // Filtrar por gramaje y ancho
                    if ((selectedGramaje === 'Todos' || gramaje == selectedGramaje) &&
                        (selectedAncho === 'Todos' || ancho == selectedAncho)) {
                        labels.push(`${linea} (${label})`);
                        gramajeData.push(gramaje);
                        anchoData.push(ancho);
                    }
                });
            });

            if (labels.length === 0) {
                document.getElementById('message').style.display = 'block';
                document.getElementById('chartContainer').style.display = 'none';
            } else {
                document.getElementById('message').style.display = 'none';
                document.getElementById('chartContainer').style.display = 'block';
                renderChart(labels, gramajeData, anchoData);
            }
        }

        // Renderizar el gráfico
        function renderChart(labels, gramajeData, anchoData) {
            const options = {
                series: [
                    {
                        name: 'Gramaje',
                        data: gramajeData
                    },
                    {
                        name: 'Ancho',
                        data: anchoData
                    }
                ],
                chart: {
                    type: 'bar',
                    height: Math.max(400, labels.length * 30),
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        dataLabels: {
                            position: 'center'
                        }
                    }
                },
                xaxis: {
                    categories: labels,
                    title: {
                        text: 'Cantidad'
                    }
                },
                title: {
                    text: 'Datos Filtrados',
                    align: 'center'
                },
                legend: {
                    position: 'top'
                }
            };

            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
</body>
</html>
