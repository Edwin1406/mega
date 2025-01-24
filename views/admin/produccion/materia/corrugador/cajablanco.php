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
    <title>Gráfico Horizontal con API</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .chart-container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="horizontalChart"></canvas>
    </div>

    <script>
        // URL de tu API
        const apiUrl = 'https://megawebsistem.com/admin/api/apicajablanco';

        // Llamar a la API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                // Preparar datos para Chart.js
                const labels = [];
                const gramajeData = [];
                const anchoData = [];

                Object.keys(data).forEach(linea => {
                    const lineaData = data[linea];

                    // Para cada línea, obtener datos de gramaje y ancho
                    lineaData.labels.forEach((label, index) => {
                        labels.push(`${linea} (${label})`); // Combina línea y etiqueta
                        gramajeData.push(lineaData.gramajes[index]); // Gramaje
                        anchoData.push(lineaData.anchos[index]); // Ancho
                    });
                });

                // Configuración del gráfico
                const config = {
                    type: 'bar',
                    data: {
                        labels: labels, // Etiquetas con la combinación de línea y gramaje/ancho
                        datasets: [
                            {
                                label: 'Gramaje',
                                data: gramajeData,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Ancho',
                                data: anchoData,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y', // Barras horizontales
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Gramaje y Ancho por Línea'
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                // Renderizar el gráfico
                const ctx = document.getElementById('horizontalChart').getContext('2d');
                new Chart(ctx, config);
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    </script>
</body>
</html>
