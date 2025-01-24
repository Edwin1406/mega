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
  <title>100% Stacked Bar Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div id="chart" style="max-width: 700px; margin: auto;"></div>

  <script>
    var options = {
      series: [
        {
          name: 'Marine Sprite',
          data: [44, 55, 41, 37, 22, 43, 21]
        },
        {
          name: 'Striking Calf',
          data: [53, 32, 33, 52, 13, 43, 32]
        },
        {
          name: 'Tank Picture',
          data: [12, 17, 11, 9, 15, 11, 20]
        },
        {
          name: 'Bucket Slope',
          data: [9, 7, 5, 8, 6, 9, 4]
        },
        {
          name: 'Reborn Kid',
          data: [25, 12, 19, 32, 25, 24, 10]
        },
      ],
      chart: {
        type: 'bar',
        height: 350,
        stacked: true,
        stackType: '100%' // Asegura que sea un gráfico apilado al 100%.
      },
      plotOptions: {
        bar: {
          horizontal: true, // Las barras serán horizontales.
        },
      },
      stroke: {
        width: 1,
        colors: ['#fff'] // Bordes blancos entre las barras.
      },
      title: {
        text: '100% Stacked Bar'
      },
      xaxis: {
        categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + "K"; // Agrega una "K" al valor mostrado en el tooltip.
          }
        }
      },
      fill: {
        opacity: 1
      },
      legend: {
        position: 'top', // Coloca la leyenda en la parte superior.
        horizontalAlign: 'left',
        offsetX: 40
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>
</html>
