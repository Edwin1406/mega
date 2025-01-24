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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <h1>Dashboard de Existencias</h1>
        <canvas id="chart" style="max-width: 800px; margin: auto;"></canvas>
        <table id="datatable" class="display" style="width: 100%; margin-top: 20px;">
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
            // URL de la API
            const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

            // Obtener datos de la API
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const chartLabels = [];
                    const chartDataKraft = [];
                    const chartDataBlanco = [];

                    // Construcción de los datos para la gráfica y la tabla
                    const tableData = [];

                    for (const [linea, detalles] of Object.entries(data)) {
                        detalles.labels.forEach((label, index) => {
                            chartLabels.push(label);
                            if (linea === "CAJA-KRAFT") {
                                chartDataKraft.push(parseInt(detalles.data[index]));
                            } else if (linea === "CAJA-BLANCO") {
                                chartDataBlanco.push(parseInt(detalles.data[index]));
                            }

                            tableData.push({
                                linea,
                                gramaje: detalles.gramajes[index],
                                ancho: detalles.anchos[index],
                                existencias: detalles.data[index]
                            });
                        });
                    }

                    // Crear gráfica con Chart.js
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

                    // Inicializar DataTable
                    $('#datatable').DataTable({
                        data: tableData,
                        columns: [
                            { data: 'linea' },
                            { data: 'gramaje' },
                            { data: 'ancho' },
                            { data: 'existencias' }
                        ]
                    });
                })
                .catch(error => console.error('Error al obtener los datos de la API:', error));
        });
    </script>
</body>
</html>
