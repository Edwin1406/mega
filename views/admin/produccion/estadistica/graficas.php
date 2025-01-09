<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfico de Barras en Tarjetas</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f9;
      padding: 20px;
    }

    .cards-container {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .card {
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
    }

    .card h3 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #333;
    }

    .chart {
      height: 200px;
    }
  </style>
</head>
<body>
  <div class="cards-container">
    <div class="card">
      <h3>Pedido Interno: 2024</h3>
      <div id="chart1" class="chart"></div>
    </div>
    <div class="card">
      <h3>Pedido Interno: 2023</h3>
      <div id="chart2" class="chart"></div>
    </div>
  </div>

  <script>
    // Datos para el gráfico
    const pedidos = [
      { id: "2024", transito: -26 },
      { id: "2023", transito: -50 }
    ];

    pedidos.forEach((pedido, index) => {
      const options = {
        chart: {
          type: 'bar',
          height: 200
        },
        series: [{
          name: 'Tránsito (días)',
          data: [pedido.transito]
        }],
        xaxis: {
          categories: ['Pedido ' + pedido.id],
        },
        colors: [pedido.transito < 0 ? '#FF4560' : '#008FFB'],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '50%',
            endingShape: 'rounded'
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + ' días';
          }
        }
      };

      const chart = new ApexCharts(document.querySelector(`#chart${index + 1}`), options);
      chart.render();
    });
  </script>
</body>
</html>
