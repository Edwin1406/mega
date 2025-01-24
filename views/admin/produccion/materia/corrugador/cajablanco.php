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
    <title>Dashboard de Existencias</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter {
            display: flex;
            align-items: center;
        }

        .filter label {
            margin-right: 10px;
            font-weight: bold;
        }

        .chart-container {
            max-width: 100%;
            margin: 20px auto;
        }

        table {
            margin-top: 20px;
            width: 100%;
        }

        #datatable {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard de Existencias</h1>

        <div class="filters">
            <div class="filter">
                <label for="filterGramaje">Filtrar por Gramaje:</label>
                <select id="filterGramaje">
                    <option value="">Todos</option>
                </select>
            </div>
            <div class="filter">
                <label for="filterAncho">Filtrar por Ancho:</label>
                <select id="filterAncho">
                    <option value="">Todos</option>
                </select>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>

        <table id="datatable" class="display">
            <thead>
                <tr>
                    <th>Línea</th>
                    <th>Gramaje</th>
                    <th>Ancho</th>
                    <th>Existencias</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const chartLabels = [];
                    const chartDataKraft = [];
                    const chartDataBlanco = [];
                    const tableData = [];
                    const gramajesSet = new Set();
                    const anchosSet = new Set();

                    for (const [linea, detalles] of Object.entries(data)) {
                        detalles.labels.forEach((label, index) => {
                            chartLabels.push(label);
                            if (linea === "CAJA-KRAFT") {
                                chartDataKraft.push(parseInt(detalles.data[index]));
                            } else if (linea === "CAJA-BLANCO") {
                                chartDataBlanco.push(parseInt(detalles.data[index]));
                            }

                            gramajesSet.add(detalles.gramajes[index]);
                            anchosSet.add(detalles.anchos[index]);

                            tableData.push({
                                linea,
                                gramaje: detalles.gramajes[index],
                                ancho: detalles.anchos[index],
                                existencias: detalles.data[index]
                            });
                        });
                    }

                    // Populate filters
                    gramajesSet.forEach(gramaje => {
                        $('#filterGramaje').append(new Option(gramaje, gramaje));
                    });

                    anchosSet.forEach(ancho => {
                        $('#filterAncho').append(new Option(ancho, ancho));
                    });

                    // Create chart
                    const ctx = document.getElementById('chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartLabels,
                            datasets: [
                                {
                                    label: 'CAJA-KRAFT',
                                    data: chartDataKraft,
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                                },
                                {
                                    label: 'CAJA-BLANCO',
                                    data: chartDataBlanco,
                                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                title: {
                                    display: true,
                                    text: 'Existencias por Línea y Gramaje/Ancho'
                                }
                            }
                        }
                    });

                    // Initialize DataTable
                    const dataTable = $('#datatable').DataTable({
                        data: tableData,
                        columns: [
                            { data: 'linea' },
                            { data: 'gramaje' },
                            { data: 'ancho' },
                            { data: 'existencias' }
                        ]
                    });

                    // Add filter functionality
                    $('#filterGramaje').on('change', function () {
                        const gramaje = $(this).val();
                        dataTable.column(1).search(gramaje).draw();
                    });

                    $('#filterAncho').on('change', function () {
                        const ancho = $(this).val();
                        dataTable.column(2).search(ancho).draw();
                    });
                })
                .catch(error => console.error('Error al obtener los datos de la API:', error));
        });
    </script>
</body>
</html>