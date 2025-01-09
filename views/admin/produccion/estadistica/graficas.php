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
  <div class="cards-container" id="cards-container"></div>

  <script>
    // Llamada a la API
    fetch('https://megawebsistem.com/admin/api/apiestadisticas')
      .then(response => response.json())
      .then(data => {
        // Procesar datos
        const container = document.getElementById('cards-container');

        data.forEach((pedido, index) => {
          // Crear una tarjeta para cada pedido
          const card = document.createElement('div');
          card.classList.add('card');
          card.innerHTML = `
            <h3>Pedido Interno: ${pedido.pedido_interno}</h3>
            <div id="chart${index + 1}" class="chart"></div>
          `;
          container.appendChild(card);

          // Crear el gráfico
          const options = {
            chart: {
              type: 'bar',
              height: 200
            },
            series: [{
              name: 'Tránsito (días)',
              data: [parseInt(pedido.transito)]
            }],
            xaxis: {
              categories: ['Pedido ' + pedido.pedido_interno],
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
      })
      .catch(error => console.error('Error al cargar los datos:', error));
  </script>
</body>
</html>
