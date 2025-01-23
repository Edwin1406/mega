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
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA GENERAL :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
   

    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA KRAFT :
            <?php if($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?> 
        </a>
    </li>
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA BLANCO :
            <?php if($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA MEDIUM :
            <?php if($totalExistenciaM > 0): ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> KG</span>
            <?php endif; ?> 
        </a>
    </li>

    <li class="areas-produccion">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO GENERAL :
            <?php if($totalCosto > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCosto ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>

    <li class="areas-produccion">
        <a href="#">
        <i class="fas fa-shopping-cart"></i> TOTAL COSTO KRAFT :
            <?php if($totalCostoK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoK ?> $ </span>
            <?php endif; ?> 
        </a>
    </li>

</ul>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-top: 30px;
            font-size: 2.5rem;
            font-weight: 600;
        }

        /* Contenedor principal */
        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Filtros */
        .filters {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .filters div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .filters label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }

        .filters select {
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
            width: 150px;
            transition: all 0.3s ease;
        }

        .filters select:hover {
            border-color: #4CAF50;
            background-color: #f1fdf1;
        }

        /* Contenedor del gráfico */
        #chart {
            margin: 0 auto;
        }

        /* Estilo de mensajes */
        .message {
            text-align: center;
            color: #e74c3c;
            font-size: 1.4rem;
            font-weight: 600;
        }

        /* Estilos de las tarjetas de gráficos */
        .chart-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .chart-card .title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
   
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

        <!-- Contenedor de gráfico -->
        <div class="chart-card">
            <div class="title">Existencias por Línea y Gramaje/Ancho</div>
            <div id="chart"></div>
        </div>
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
                    labels.push(label || "Sin Datos"); // Evitar undefined y asignar un valor por defecto
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
                    categories: labels,
                    tickPlacement: 'on',
                    scrollbar: {
                        enabled: true
                    },
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: '12px'
                        }
                    },
                    max: 10 // Mostrar un máximo de 10 categorías al mismo tiempo
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
                    theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return val !== undefined ? val : "Sin Datos"; // Manejar undefined en el tooltip
                        }
                    }
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
                        labels.push(etiqueta || "Sin Datos");
                        data.push(originalData[linea].data[index] || 0); // Evitar datos vacíos
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
