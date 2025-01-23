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
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="graficaCorrugador" width="400" height="200"></canvas>

<script>
    // Obtén datos desde PHP
    fetch('ruta_datos_php.php') // Cambia a la ruta real del archivo PHP
        .then(response => response.json())
        .then(data => {
            // Configuración de Chart.js
            const ctx = document.getElementById('graficaCorrugador').getContext('2d');

            // Prepara los datasets
            const datasets = Object.keys(data).map(linea => ({
                label: linea,
                data: data[linea].data,
                backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`,
                borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                borderWidth: 1
            }));

            // Renderiza el gráfico
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data[Object.keys(data)[0]].labels, // Usamos las etiquetas del primer conjunto
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Existencias por Línea y Gramaje'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>