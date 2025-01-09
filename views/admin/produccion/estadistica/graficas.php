<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard de Procesos</title>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
 

    h1 {
      margin-top: 20px;
      font-size: 24px;
      color: #222;
    }

    .filter-container {
      margin: 20px 0;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 15px;
      align-items: center;
    }

    label {
      font-size: 14px;
    }

    input, button {
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    button {
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .result-container {
      margin-top: 20px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      width: 100%;
      max-width: 800px;
    }

    .total-productos, .total-general, .transito-positivo, .transito-negativo {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      width: 200px;
    }

    .total-productos img, .total-general img, .transito-positivo img, .transito-negativo img {
      width: 50px;
      height: auto;
      margin-bottom: 10px;
    }

    .total-productos h2, .total-general h2, .transito-positivo h2, .transito-negativo h2 {
      margin: 0;
      font-size: 18px;
      color: #555;
    }

    .total-productos p, .total-general p, .transito-positivo p, .transito-negativo p {
      margin: 5px 0 0;
      font-size: 32px;
      font-weight: bold;
      color: #007bff;
    }

    .chart-container {
      margin-top: 40px;
      width: 90%;
      max-width: 800px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .pie-chart-container {
      margin-top: 20px;
      width: 90%;
      max-width: 800px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Dashboard de procesos</h1>
  <div class="filter-container">
    <label for="fechaInicio">Fecha de inicio:</label>
    <input type="date" id="fechaInicio">
    
    <label for="fechaFin">Fecha de fin:</label>
    <input type="date" id="fechaFin">

    <button onclick="filterData()">Filtrar</button>
  </div>

  <div id="results" class="result-container">
    <div class="total-productos">
      <img src="https://img.icons8.com/color/96/box--v1.png" alt="Icono de productos">
      <h2>Total Productos</h2>
      <p id="totalProductos">0</p>
    </div>
    <div class="total-general">
      <img src="https://img.icons8.com/color/96/accounting.png" alt="Icono de total general">
      <h2>Total General</h2>
      <p id="totalGeneral">0.00 $</p>
    </div>
    <div class="transito-positivo">
      <img src="https://img.icons8.com/color/96/ok.png" alt="Icono de tránsito positivo">
      <h2>Estado de Tránsito</h2>
      <p>Positivo: <span id="transitoPositivo">0</span></p>
    </div>
    <div class="transito-negativo">
      <img src="https://img.icons8.com/color/96/cancel.png" alt="Icono de tránsito negativo">
      <h2>Estado de Tránsito</h2>
      <p>Negativo: <span id="transitoNegativo">0</span></p>
    </div>
  </div>

  <div class="chart-container">
    <h2>Cantidad por Producto</h2>
    <div id="chart"></div>
  </div>

  <div class="pie-chart-container">
    <h2>Estado de Tránsito con Nombre del Producto</h2>
    <div id="pieChart"></div>
  </div>

  <script>
    let barChart;
    let pieChart;

    function filterData() {
      const fechaInicio = document.getElementById('fechaInicio').value;
      const fechaFin = document.getElementById('fechaFin').value;

      if (!fechaInicio || !fechaFin) {
        alert('Por favor, selecciona ambas fechas.');
        return;
      }

      axios.get('https://megawebsistem.com/admin/api/apiestadisticas')
        .then(response => {
          const data = response.data;
          const filteredData = data.filter(item => {
            const fechaSolicitud = new Date(item.fecha_solicitud);
            return fechaSolicitud >= new Date(fechaInicio) && fechaSolicitud <= new Date(fechaFin);
          });

          updateTotals(filteredData);
          updateChart(filteredData);
          updateTransitStatus(filteredData);
          updatePieChart(filteredData);
        })
        .catch(error => {
          console.error('Error al consumir la API:', error);
        });
    }

    function updateTotals(data) {
      const totalProductos = data.length;
      const totalGeneral = data.reduce((sum, item) => sum + parseFloat(item.total_item || 0), 0);

      document.getElementById('totalProductos').textContent = totalProductos;
      document.getElementById('totalGeneral').textContent = totalGeneral.toFixed(2) + ' $';
    }

    function updateChart(data) {
      const productQuantities = {};

      data.forEach(item => {
        if (productQuantities[item.producto]) {
          productQuantities[item.producto] += parseFloat(item.cantidad || 0);
        } else {
          productQuantities[item.producto] = parseFloat(item.cantidad || 0);
        }
      });

      const categories = Object.keys(productQuantities);
      const values = Object.values(productQuantities);

      if (barChart) {
        barChart.destroy();
      }

      const options = {
        chart: {
          type: 'bar',
          height: 350
        },
        series: [{
          name: 'Cantidad',
          data: values
        }],
        xaxis: {
          categories: categories
        },
        title: {
          text: 'Cantidad por Producto',
          align: 'center'
        }
      };

      barChart = new ApexCharts(document.querySelector("#chart"), options);
      barChart.render();
    }

    function updateTransitStatus(data) {
      const positivo = data.filter(item => parseFloat(item.transito) > 0).length;
      const negativo = data.filter(item => parseFloat(item.transito) <= 0).length;

      document.getElementById('transitoPositivo').textContent = positivo;
      document.getElementById('transitoNegativo').textContent = negativo;
    }

    function updatePieChart(data) {
      const transitData = {};

      data.forEach(item => {
        const key = `${item.producto} (${item.transito})`;
        if (transitData[key]) {
          transitData[key] += 1;
        } else {
          transitData[key] = 1;
        }
      });

      const categories = Object.keys(transitData);
      const values = Object.values(transitData);

      if (pieChart) {
        pieChart.destroy();
      }

      const options = {
        chart: {
          type: 'pie',
          height: 350
        },
        series: values,
        labels: categories,
        title: {
          text: 'Estado de Tránsito con Nombre del Producto',
          align: 'center'
        }
      };

      pieChart = new ApexCharts(document.querySelector("#pieChart"), options);
      pieChart.render();
    }
  </script>
</body>
</html>
