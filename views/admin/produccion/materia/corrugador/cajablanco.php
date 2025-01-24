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
    <title>Gráfico con Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 70%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Llamar a la API y obtener los datos
        fetch('URL_DE_TU_API')
            .then(response => response.json())
            .then(data => {
                const lineas = Object.keys(data); // Obtiene las líneas (CAJA-KRAFT, CAJA-BLANCO, etc.)
                const datasets = [];
                const labels = [];

                // Procesar los datos para Chart.js
                lineas.forEach(linea => {
                    const lineaData = data[linea];
                    const lineaDataset = {
                        label: linea,
                        data: lineaData.data,
                        backgroundColor: linea === 'CAJA-KRAFT' ? 'rgba(54, 162, 235, 0.5)' : 'rgba(255, 99, 132, 0.5)',
                        borderColor: linea === 'CAJA-KRAFT' ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    };

                    datasets.push(lineaDataset);

                    // Añadir etiquetas solo una vez
                    if (labels.length === 0) {
                        labels.push(...lineaData.labels);
                    }
                });

                // Crear el gráfico
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels, // Etiquetas combinadas (gramaje / ancho)
                        datasets: datasets // Datos de cada línea
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
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    </script>
</body>
</html>
