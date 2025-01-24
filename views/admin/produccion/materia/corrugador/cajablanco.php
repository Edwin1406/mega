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
  <h1>Gráfico de Barras Apiladas</h1>
  <div id="chart" style="max-width: 800px; margin: auto;"></div>

  <script>
    // Datos simulados (reemplázalos con los de tu API)
    const apiData = [
      { ancho: "188", gramaje: "175", existencia: 44, nombre: "PRODUCT A" },
      { ancho: "188", gramaje: "150", existencia: 13, nombre: "PRODUCT B" },
      { ancho: "188", gramaje: "140", existencia: 11, nombre: "PRODUCT C" },
      { ancho: "188", gramaje: "130", existencia: 21, nombre: "PRODUCT D" },

      { ancho: "155", gramaje: "175", existencia: 55, nombre: "PRODUCT A" },
      { ancho: "155", gramaje: "150", existencia: 23, nombre: "PRODUCT B" },
      { ancho: "155", gramaje: "140", existencia: 17, nombre: "PRODUCT C" },
      { ancho: "155", gramaje: "130", existencia: 7, nombre: "PRODUCT D" },

      { ancho: "58", gramaje: "175", existencia: 41, nombre: "PRODUCT A" },
      { ancho: "58", gramaje: "150", existencia: 20, nombre: "PRODUCT B" },
      { ancho: "58", gramaje: "140", existencia: 15, nombre: "PRODUCT C" },
      { ancho: "58", gramaje: "130", existencia: 25, nombre: "PRODUCT D" },
    ];

    // Procesar datos para el gráfico
    const categories = [...new Set(apiData.map(item => item.ancho))]; // Anchos únicos en el eje X
    const seriesNames = [...new Set(apiData.map(item => item.nombre))]; // Nombres únicos
    const series = seriesNames.map(name => ({
      name: name,
      data: categories.map(category => {
        const item = apiData.find(
          entry => entry.nombre === name && entry.ancho === category
        );
        return item ? item.existencia : 0;
      }),
    }));

    // Configuración del gráfico
    const options = {
      series: series,
      chart: {
        type: 'bar',
        height: 350,
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
        formatter: (val, opts) => val, // Muestra los valores sobre las barras
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
      },
      fill: {
        opacity: 1,
      },
    };

    // Renderizar el gráfico
    const chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>
</html>
