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
    <title>Gráfico Horizontal</title>
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
        // Datos simulados (reemplaza con tu API)
        const data = {
            labels: ['CAJA-KRAFT', 'CAJA-BLANCO'], // Líneas
            datasets: [
                {
                    label: 'Gramaje',
                    data: [254, 175], // Datos de gramaje
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ancho',
                    data: [188, 116], // Datos de ancho
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        };

        // Configuración del gráfico
        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y', // Cambiar a barras horizontales
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
    </script>
</body>
</html>
