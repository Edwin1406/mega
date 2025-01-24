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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Representación de Datos</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Visualización de Datos</h1>

    <h2>Gráfica: Existencia por Gramaje y Ancho</h2>
    <canvas id="graficoBarras" width="800" height="400"></canvas>

    <h2>Tabla Detallada</h2>
    <table id="tablaDatos" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Gramaje</th>
                <th>Total Existencia</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>
<SCRIpt>
    $(document).ready(function () {
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const labels = [];
            const datasets = [];
            const tablaData = [];

            // Procesar los datos por categoría
            for (const tipo in data) {
                if (data.hasOwnProperty(tipo)) {
                    const { gramajes, anchos, data: existencias, labels: etiquetas } = data[tipo];

                    // Acumular datos para la gráfica
                    gramajes.forEach((gramaje, index) => {
                        const ancho = anchos[index];
                        const existencia = existencias[index];

                        // Si no existe el gramaje en la gráfica, inicializar
                        if (!datasets[gramaje]) {
                            datasets[gramaje] = { label: `Gramaje ${gramaje}`, data: [], backgroundColor: randomColor() };
                            labels.push(ancho); // Añadir anchos como etiquetas
                        }

                        // Añadir existencia al gramaje correspondiente
                        datasets[gramaje].data.push(existencia);

                        // Añadir fila a la tabla
                        tablaData.push({
                            tipo,
                            gramaje,
                            ancho,
                            existencia
                        });
                    });
                }
            }

            // Configurar la gráfica
            const ctx = document.getElementById('graficoBarras').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Los anchos
                    datasets: Object.values(datasets)
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        x: { stacked: true },
                        y: { stacked: true, beginAtZero: true }
                    }
                }
            });

            // Configurar la tabla con detalles
            const tabla = $('#tablaDatos').DataTable({
                data: tablaData,
                columns: [
                    { data: 'tipo' },
                    { data: 'gramaje' },
                    { 
                        data: 'existencia',
                        render: function (data, type, row) {
                            return `<strong>${data}</strong>`;
                        }
                    },
                    { 
                        data: null,
                        render: function (data, type, row) {
                            return `<button class="btnDetalles" data-tipo="${row.tipo}" data-gramaje="${row.gramaje}">Ver Anchos</button>`;
                        }
                    }
                ]
            });

            // Evento para mostrar detalles
            $('#tablaDatos tbody').on('click', '.btnDetalles', function () {
                const gramaje = $(this).data('gramaje');
                const tipo = $(this).data('tipo');
                const detalles = tablaData.filter(item => item.gramaje == gramaje && item.tipo == tipo);

                // Mostrar los detalles en un modal o una subtabla
                alert(`Detalles para ${tipo} - Gramaje ${gramaje}:\n` + 
                    detalles.map(d => `Ancho: ${d.ancho}, Existencia: ${d.existencia}`).join('\n'));
            });
        })
        .catch(error => console.error('Error al cargar datos de la API:', error));

    // Función para generar colores aleatorios
    function randomColor() {
        return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`;
    }
});

</SCRIpt>