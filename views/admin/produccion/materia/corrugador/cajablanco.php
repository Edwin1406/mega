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
  <title>Gráfico de Barras Apiladas desde API</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <h1>Gráfico de Barras Apiladas</h1>
  <div id="chart" style="max-width: 800px; margin: auto;"></div>

  <script>
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    // Función para obtener los datos de la API y renderizar el gráfico
    async function fetchAndRenderChart() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Procesar datos para el gráfico
        const categories = [...new Set(data.map(item => item.ancho))]; // Valores únicos de 'ancho' para el eje X
        const gramajes = [...new Set(data.map(item => item.gramaje))]; // Gramajes únicos
        console.log(categories);
        console.log(gramajes);
        // Crear series para cada gramaje
        const series = gramajes.map(gramaje => ({
          name: `Gramaje ${gramaje}`,
          data: categories.map(ancho => {
            const items = data.filter(item => item.ancho === ancho && item.gramaje === gramaje);
            return items.length > 0 ? parseInt(items[0].existencia, 10) : 0; // Suma las existencias
          })
        }));

        // Configuración del gráfico
        const options = {
          series: series,
          chart: {
            type: 'bar',
            height: 400,
            stacked: true,
            toolbar: {
              show: true,
            },
          },
          plotOptions: {
            bar: {
              horizontal: false,
              borderRadius: 4,
            },
          },
          dataLabels: {
            enabled: true,
            formatter: (val) => val, // Mostrar valores en las barras
          },
          xaxis: {
            categories: categories, // Anchos en el eje X
            title: {
              text: 'ANCHOS',
            },
          },
          yaxis: {
            title: {
              text: 'Existencia Total',
            },
          },
          legend: {
            position: 'right',
            offsetY: 40,
          },
          fill: {
            opacity: 1,
          },
          tooltip: {
            y: {
              formatter: (val) => `${val} unidades`,
            },
          },
        };

        // Renderizar el gráfico
        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      } catch (error) {
        console.error("Error al obtener los datos de la API:", error);
      }
    }

    // Llamar a la función para obtener datos y renderizar el gráfico
    fetchAndRenderChart();
  </script>
</body>
</html>
