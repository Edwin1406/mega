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
  <title>Gráfico de Barras Apiladas en Tiempo Real</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <h1>Existencias por Gramaje y Ancho (Tiempo Real)</h1>
  <div id="chart" style="max-width: 800px; margin: auto;"></div>

  <script>
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    let chart; // Variable global para el gráfico

    // Configuración inicial del gráfico
    const options = {
      series: [], // Se llenará dinámicamente
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
        formatter: (val) => val.toFixed(2),
      },
      xaxis: {
        categories: [], // Se llenará dinámicamente
        title: {
          text: 'Gramajes',
        },
      },
      yaxis: {
        title: {
          text: 'Existencias Totales',
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
          formatter: (val) => `${val.toFixed(2)} unidades`,
        },
      },
    };

    // Función para obtener los datos de la API y actualizar el gráfico
    async function fetchAndUpdateChart() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Obtener gramajes y anchos únicos
        const gramajes = [...new Set(data.map(item => item.gramaje))];
        const anchos = [...new Set(data.map(item => item.ancho))];

        // Crear series para cada ancho
        const series = anchos.map(ancho => ({
          name: `Ancho ${ancho}`,
          data: gramajes.map(gramaje => {
            const items = data.filter(item => item.ancho === ancho && item.gramaje === gramaje);
            const totalExistencia = items.reduce((sum, item) => sum + parseFloat(item.existencia), 0);
            return totalExistencia;
          }),
        }));

        // Actualizar categorías y series del gráfico
        if (chart) {
          chart.updateOptions({
            xaxis: {
              categories: gramajes,
            },
            series: series,
          });
        } else {
          // Crear el gráfico la primera vez
          options.xaxis.categories = gramajes;
          options.series = series;
          chart = new ApexCharts(document.querySelector("#chart"), options);
          chart.render();
        }
      } catch (error) {
        console.error("Error al obtener los datos de la API:", error);
      }
    }

    // Llamar a la función por primera vez
    fetchAndUpdateChart();

    // Actualizar el gráfico cada 5 segundos
    setInterval(fetchAndUpdateChart, 5000);
  </script>
</body>
</html>
