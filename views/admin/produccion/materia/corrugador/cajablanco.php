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
  <title>ApexCharts Stacked Bar Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div id="chart" style="max-width: 700px; margin: auto;"></div>

  <script>
    var options = {
      series: [
        { name: "PRODUCT A", data: [44, 55, 41, 67, 22, 43] },
        { name: "PRODUCT B", data: [13, 23, 20, 8, 13, 22] },
        { name: "PRODUCT C", data: [11, 17, 15, 25, 21, 27] },
        { name: "PRODUCT D", data: [21, 7, 25, 13, 22, 8] },
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
          breakpoint: 640,
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
          borderRadius: 4,
        },
      },
      xaxis: {
        categories: ["Jan '11", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan"],
      },
      legend: {
        position: 'right',
        offsetY: 40,
      },
      fill: {
        opacity: 1,
      },
      colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'], // Colores para cada producto
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>
</html>
