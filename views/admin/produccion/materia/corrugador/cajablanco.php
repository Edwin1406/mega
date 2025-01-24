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
  <title>Stacked Bar Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div id="chart" style="max-width: 700px; margin: auto;"></div>

  <script>
    var options = {
      series: [
        { name: 'PRODUCT A', data: [44, 55, 41, 67, 22, 43] },
        { name: 'PRODUCT B', data: [13, 23, 20, 8, 13, 27] },
        { name: 'PRODUCT C', data: [11, 17, 15, 15, 21, 14] },
        { name: 'PRODUCT D', data: [21, 7, 25, 13, 22, 8] },
      ],
      chart: {
        type: 'bar',
        height: 350,
        stacked: true,
        toolbar: {
          show: true
        },
        zoom: {
          enabled: true
        }
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }
      ],
      plotOptions: {
        bar: {
          horizontal: false,
          borderRadius: 10, // Redondea las esquinas de las barras
          borderRadiusApplication: 'end', // Aplica el borde redondeado solo al final
          borderRadiusWhenStacked: 'last', // Aplica el borde redondeado a la última barra de la pila
          dataLabels: {
            total: {
              enabled: true, // Muestra etiquetas con el total de cada pila
              style: {
                fontSize: '13px',
                fontWeight: 900
              }
            }
          }
        },
      },
      xaxis: {
        type: 'datetime',
        categories: [
          '01/01/2011 GMT',
          '01/02/2011 GMT',
          '01/03/2011 GMT',
          '01/04/2011 GMT',
          '01/05/2011 GMT',
          '01/06/2011 GMT'
        ],
      },
      legend: {
        position: 'right', // Posición de la leyenda
        offsetY: 40
      },
      fill: {
        opacity: 1
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>
</html>
