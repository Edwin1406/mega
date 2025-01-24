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
    <title>Gráfico Horizontal Mejorado</title>
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
        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
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

    <div class="chart-container">
        <div id="chart"></div>
    </div>

    <script>
        const apiUrl = 'https://megawebsistem.com/admin/api/apicajablanco'; // Reemplaza con la URL real de tu API

        let originalData; // Almacena los datos originales
        let chart; // Referencia al gráfico

        // Llamar a la API y cargar los datos
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                originalData = data;
                populateFilters(data);
                renderChart(data);
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

        // Aplicar los filtros y actualizar el gráfico
        function applyFilters() {
            const selectedGramaje = document.getElementById('filterGramaje').value;
            const selectedAncho = document.getElementById('filterAncho').value;

            const filteredData = JSON.parse(JSON.stringify(originalData));

            Object.keys(filteredData).forEach(linea => {
                const lineaData = filteredData[linea];

                // Filtrar por gramaje
                if (selectedGramaje !== 'Todos') {
                    const indices = lineaData.gramajes
                        .map((gramaje, index) => gramaje == selectedGramaje ? index : null)
                        .filter(index => index !== null);

                    lineaData.labels = indices.map(index => lineaData.labels[index]);
                    lineaData.data = indices.map(index => lineaData.data[index]);
                    lineaData.gramajes = indices.map(index => lineaData.gramajes[index]);
                    lineaData.anchos = indices.map(index => lineaData.anchos[index]);
                }

                // Filtrar por ancho
                if (selectedAncho !== 'Todos') {
                    const indices = lineaData.anchos
                        .map((ancho, index) => ancho == selectedAncho ? index : null)
                        .filter(index => index !== null);

                    lineaData.labels = indices.map(index => lineaData.labels[index]);
                    lineaData.data = indices.map(index => lineaData.data[index]);
                    lineaData.gramajes = indices.map(index => lineaData.gramajes[index]);
                    lineaData.anchos = indices.map(index => lineaData.anchos[index]);
                }
            });

            renderChart(filteredData);
        }

        // Renderizar el gráfico con ApexCharts
        function renderChart(data) {
            const labels = [];
            const gramajeData = [];
            const anchoData = [];

            Object.keys(data).forEach(linea => {
                const lineaData = data[linea];
                lineaData.labels.forEach((label, index) => {
                    labels.push(`${linea} (${label})`);
                    gramajeData.push(lineaData.gramajes[index]);
                    anchoData.push(lineaData.anchos[index]);
                });
            });

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
                    height: Math.max(400, labels.length * 30), // Altura dinámica basada en los datos
                    zoom: {
                        enabled: true // Habilitar zoom para explorar datos
                    },
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        distributed: true, // Colores distribuidos automáticamente
                        dataLabels: {
                            position: 'center'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val;
                    }
                },
                xaxis: {
                    categories: labels,
                    title: {
                        text: 'Cantidad'
                    },
                    labels: {
                        rotate: -45, // Rota etiquetas si son largas
                        formatter: function (val) {
                            return val.length > 20 ? val.slice(0, 20) + '...' : val; // Truncar etiquetas largas
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Líneas'
                    }
                },
                title: {
                    text: 'Gramaje y Ancho por Línea',
                    align: 'center'
                },
                legend: {
                    position: 'top'
                }
            };

            // Destruir el gráfico anterior si existe
            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
</body>
</html>
