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
  <title>Gráfico de Barras Apiladas</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <h1>Gráfico de Existencias por Gramaje</h1>
  <div id="chart" style="max-width: 800px; margin: auto;"></div>

  <script>
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    // Función para obtener los datos de la API y renderizar el gráfico
    async function fetchAndRenderChart() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Obtener categorías únicas (gramajes) y series por anchos
        const gramajes = [...new Set(data.map(item => item.gramaje))]; // Gramajes únicos
        const anchos = [...new Set(data.map(item => item.ancho))]; // Anchos únicos

        // Crear series para cada ancho
        const series = anchos.map(ancho => ({
          name: `Ancho ${ancho}`,
          data: gramajes.map(gramaje => {
            const item = data.find(entry => entry.ancho === ancho && entry.gramaje === gramaje);
            return item ? parseInt(item.existencia, 10) : 0; // Existencias
          }),
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
              horizontal: true, // Barras horizontales
              borderRadius: 4,
            },
          },
          dataLabels: {
            enabled: true,
            formatter: (val) => val, // Mostrar valores en las barras
          },
          xaxis: {
            categories: gramajes, // Gramajes en el eje X
            title: {
              text: 'Gramajes',
            },
          },
          yaxis: {
            title: {
              text: 'Anchos',
            },
          },
          legend: {
            position: 'top',
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
