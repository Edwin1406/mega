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
    <title>Gráfico Mejorado con ApexCharts</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        select {
            padding: 8px;
            font-size: 14px;
        }
        .chart-container {
            width: 90%;
            margin: auto;
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
        const apiUrl = 'https://megawebsistem.com/admin/api/apicajablanco'; // Cambia con la URL real de tu API

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

            data.forEach(item => gramajes.add(item.gramaje));
            document.getElementById('filterGramaje').innerHTML += [...gramajes].map(gramaje => `<option value="${gramaje}">${gramaje}</option>`).join('');

            const anchos = new Set();
            data.forEach(item => anchos.add(item.ancho));
            document.getElementById('filterAncho').innerHTML += [...anchos].map(ancho => `<option value="${ancho}">${ancho}</option>`).join('');
        }


        // Renderizar el gráfico
        function renderChart(data) {
            chart = new ApexCharts(document.getElementById('chart'), {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Costo',
                    data: data.map(item => item.costo)
                }],
                xaxis: {
                    categories: data.map(item => `${item.gramaje} - ${item.ancho}`)
                }
            });

            chart.render();
        }

        // Filtrar los datos y actualizar el gráfico

        document.getElementById('filterGramaje').addEventListener('change', filterData);
        document.getElementById('filterAncho').addEventListener('change', filterData);

        function filterData() {
            const gramaje = document.getElementById('filterGramaje').value;
            const ancho = document.getElementById('filterAncho').value;

            let filteredData = originalData;

            if (gramaje !== 'Todos') {
                filteredData = filteredData.filter(item => item.gramaje === gramaje);
            }

            if (ancho !== 'Todos') {
                filteredData = filteredData.filter(item => item.ancho === ancho);
            }

            chart.updateSeries([{
                data: filteredData.map(item => item.costo)
            }], true);
        }

    </script>