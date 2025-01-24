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
  <title>Stacked Bar Chart from API</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <h1>Gráfico de Barras Apiladas</h1>
  <div id="chart" style="max-width: 800px; margin: auto;"></div>

  <script>
    // URL de la API
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    // Función para obtener datos de la API y procesarlos para el gráfico
    async function fetchDataAndRenderChart() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Procesar los datos para el gráfico
        const categories = data.map(item => item.descripcion); // Nombres en el eje X
        const productA = data.map(item => parseFloat(item.costo)); // Datos de 'PRODUCT A'
        const productB = data.map(item => parseFloat(item.promedio)); // Datos de 'PRODUCT B'
        const productC = data.map(item => parseFloat(item.existencia)); // Datos de 'PRODUCT C'
        const productD = data.map(item => parseFloat(item.ancho)); // Datos de 'PRODUCT D'

        // Configuración del gráfico
        const options = {
          series: [
            { name: 'PRODUCT A', data: productA },
            { name: 'PRODUCT B', data: productB },
            { name: 'PRODUCT C', data: productC },
            { name: 'PRODUCT D', data: productD },
          ],
          chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
              show: true,
            },
            zoom: {
              enabled: true,
            },
          },
          responsive: [
            {
              breakpoint: 480,
              options: {
                legend: {
                  position: 'bottom',
                  offsetX: -10,
                  offsetY: 0,
                },
              },
            },
          ],
          plotOptions: {
            bar: {
              horizontal: false,
              borderRadius: 10,
              dataLabels: {
                total: {
                  enabled: true,
                  style: {
                    fontSize: '13px',
                    fontWeight: 900,
                  },
                },
              },
            },
          },
          xaxis: {
            categories: categories,
          },
          legend: {
            position: 'right',
            offsetY: 40,
          },
          fill: {
            opacity: 1,
          },
        };

        // Renderizar el gráfico
        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      } catch (error) {
        console.error("Error al obtener datos de la API:", error);
      }
    }

    // Llamar a la función para obtener datos y renderizar el gráfico
    fetchDataAndRenderChart();
  </script>
</body>
</html>
