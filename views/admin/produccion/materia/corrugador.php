<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<ul class="lista-areas-produccion">
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-industry"> </i> TOTAL REGISTROS :
            <?php if ($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?>
        </a>
    </li>
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO :
            <?php if ($totalCosto > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCosto ?> $ </span>
            <?php endif; ?>
        </a>
    </li>
</ul>





<ul class="lista-areas-produccion">



    <li class="areas-produccion-craft">
        <a href="/admin/produccion/materia/corrugador/cajacraft">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium">
        <a href="/admin/produccion/materia/corrugador/cajamedium">
            <i class="fas fa-shopping-cart"></i> TOTAL EXISTENCIA CAJA-MEDIUM :
            <?php if (isset($totalExistenciaM) && $totalExistenciaM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> $ </span>
            <?php else : ?>
                <span class="areas-produccion__numero">  0 KG </span>
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
        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 2.5rem;
            font-weight: 600;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        #chart {
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }

        table thead th {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        table tbody td {
            padding: 8px;
            border: 1px solid #ddd;
        }

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
        <div class="chart-card">
            <div class="title">Existencias por Línea y Gramaje/Ancho</div>
            <div id="chart"></div>
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Línea</th>
                        <th>Gramaje</th>
                        <th>Ancho</th>
                        <th>Existencias</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas de datos se llenarán dinámicamente -->
                </tbody>
            </table>
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
                renderChart(data); // Renderizar gráfica inicial
                renderTable(data); // Renderizar tabla inicial
            })
            .catch(error => console.error('Error al cargar datos:', error));

        // Renderizar la gráfica
        function renderChart(data) {
            const series = Object.keys(data).map(linea => ({
                name: linea,
                data: data[linea].data
            }));

            const labels = [];
            Object.values(data).forEach(linea => {
                linea.labels.forEach(label => {
                    labels.push(label || "Sin Datos");
                });
            });

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
                    align: 'center'
                },
                colors: ['#1E90FF', '#28B463', '#F39C12']
            };

            if (chart) chart.destroy();
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        // Renderizar la tabla
        function renderTable(data) {
            const tbody = document.querySelector("#data-table tbody");
            tbody.innerHTML = ""; // Limpiar tabla

            Object.keys(data).forEach(linea => {
                data[linea].labels.forEach((label, index) => {
                    const row = document.createElement("tr");

                    const lineaCell = document.createElement("td");
                    lineaCell.textContent = linea;
                    row.appendChild(lineaCell);

                    const gramajeCell = document.createElement("td");
                    gramajeCell.textContent = data[linea].gramajes[index] || "Sin Datos";
                    row.appendChild(gramajeCell);

                    const anchoCell = document.createElement("td");
                    anchoCell.textContent = data[linea].anchos[index] || "Sin Datos";
                    row.appendChild(anchoCell);

                    const existenciasCell = document.createElement("td");
                    existenciasCell.textContent = data[linea].data[index] || 0;
                    row.appendChild(existenciasCell);

                    tbody.appendChild(row);
                });
            });
        }
    </script>
</body>

</html>
