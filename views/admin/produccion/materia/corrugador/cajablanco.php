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
    <title>Gráfico con Filtros</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .filters, .chart-container, .table-container {
            margin-bottom: 20px;
        }
        select {
            padding: 5px;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
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
        <canvas id="myChart"></canvas>
    </div>

    <div class="table-container">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>Línea</th>
                    <th>Gramaje</th>
                    <th>Ancho</th>
                    <th>Existencias</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contenido dinámico -->
            </tbody>
        </table>
    </div>

    <script>
        let originalData; // Variable para almacenar los datos originales
        let chart; // Referencia al gráfico

        // Llamar a la API y obtener los datos
        fetch('https://megawebsistem.com/admin/api/apicajablanco')
            .then(response => response.json())
            .then(data => {
                originalData = data; // Guardar los datos originales
                populateFilters(data);
                renderChartAndTable(data);
            })
            .catch(error => console.error('Error al cargar los datos:', error));

        // Poblar los selectores de filtro
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

            filterGramaje.addEventListener('change', () => applyFilters());
            filterAncho.addEventListener('change', () => applyFilters());
        }

        // Aplicar los filtros seleccionados
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

            renderChartAndTable(filteredData);
        }

        // Renderizar el gráfico y la tabla
        function renderChartAndTable(data) {
            const labels = [];
            const datasets = [];
            const tableBody = document.getElementById('dataTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Limpiar la tabla

            Object.keys(data).forEach((linea, index) => {
                const lineaData = data[linea];

                datasets.push({
                    label: linea,
                    data: lineaData.data,
                    backgroundColor: index % 2 === 0 ? 'rgba(54, 162, 235, 0.5)' : 'rgba(255, 99, 132, 0.5)',
                    borderColor: index % 2 === 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                });

                if (labels.length === 0) {
                    labels.push(...lineaData.labels);
                }

                // Rellenar la tabla
                lineaData.labels.forEach((label, i) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${linea}</td>
                        <td>${lineaData.gramajes[i]}</td>
                        <td>${lineaData.anchos[i]}</td>
                        <td>${lineaData.data[i]}</td>
                    `;
                    tableBody.appendChild(row);
                });
            });

            // Destruir el gráfico anterior si existe
            if (chart) {
                chart.destroy();
            }

            // Crear el gráfico
            const ctx = document.getElementById('myChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Existencias por Línea y Gramaje/Ancho'
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
