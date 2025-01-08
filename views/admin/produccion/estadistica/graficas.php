<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Estadísticas</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    .container {
      width: 90%;
      margin: auto;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    .filters {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }
    .filters label {
      font-weight: bold;
    }
    .filters input,
    .filters select,
    .filters button {
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }
    .filters button {
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .filters button:hover {
      background-color: #0056b3;
    }
    .charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }
    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .chart-container {
      width: 100%;
      height: 300px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Dashboard - Estadísticas</h1>

    <!-- Filtros -->
    <div class="filters">
      <div>
        <label for="projectFilter">Proyecto</label>
        <select id="projectFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <div>
        <label for="productFilter">Producto</label>
        <select id="productFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <div>
        <label for="brandFilter">Marca</label>
        <select id="brandFilter">
          <option value="">Todas</option>
        </select>
      </div>
      <div>
        <label for="traderFilter">Trader</label>
        <select id="traderFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <div>
        <label for="startDate">Fecha de Inicio</label>
        <input type="date" id="startDate">
      </div>
      <div>
        <label for="endDate">Fecha de Fin</label>
        <input type="date" id="endDate">
      </div>
      <div>
        <button id="filterButton">Filtrar</button>
      </div>
    </div>

    <!-- Gráficos -->
    <div class="charts">
      <div class="card">
        <div class="chart-container" id="barChart"></div>
      </div>
      <div class="card">
        <div class="chart-container" id="lineChart"></div>
      </div>
      <div class="card">
        <div class="chart-container" id="pieChart"></div>
      </div>
      <div class="card">
        <div class="chart-container" id="donutChart"></div>
      </div>
    </div>
  </div>

  <script>
    let originalData = [];

    // Función para cargar datos desde la API
    function fetchData() {
      fetch('https://megawebsistem.com/admin/api/apiestadisticas')
        .then(response => response.json())
        .then(data => {
          originalData = data;
          populateFilters(data);
          updateDashboard(data);
        });
    }

    // Poblar filtros dinámicamente
    function populateFilters(data) {
      const projectFilter = document.getElementById('projectFilter');
      const productFilter = document.getElementById('productFilter');
      const brandFilter = document.getElementById('brandFilter');
      const traderFilter = document.getElementById('traderFilter');

      const projects = [...new Set(data.map(item => item.proyecto))];
      const products = [...new Set(data.map(item => item.producto))];
      const brands = [...new Set(data.map(item => item.marca))];
      const traders = [...new Set(data.map(item => item.trader))];

      projects.forEach(project => {
        projectFilter.innerHTML += `<option value="${project}">${project}</option>`;
      });
      products.forEach(product => {
        productFilter.innerHTML += `<option value="${product}">${product}</option>`;
      });
      brands.forEach(brand => {
        brandFilter.innerHTML += `<option value="${brand}">${brand}</option>`;
      });
      traders.forEach(trader => {
        traderFilter.innerHTML += `<option value="${trader}">${trader}</option>`;
      });
    }

    // Filtrar datos
    function filterData() {
      const project = document.getElementById('projectFilter').value;
      const product = document.getElementById('productFilter').value;
      const brand = document.getElementById('brandFilter').value;
      const trader = document.getElementById('traderFilter').value;
      const startDate = document.getElementById('startDate').value;
      const endDate = document.getElementById('endDate').value;

      return originalData.filter(item => {
        const date = new Date(item.fecha_solicitud);
        return (!project || item.proyecto === project) &&
               (!product || item.producto === product) &&
               (!brand || item.marca === brand) &&
               (!trader || item.trader === trader) &&
               (!startDate || date >= new Date(startDate)) &&
               (!endDate || date <= new Date(endDate));
      });
    }

    // Actualizar gráficos
    function updateDashboard(data) {
      renderBarChart(data);
      renderLineChart(data);
      renderPieChart(data);
      renderDonutChart(data);
    }

    // Gráficos
    function renderBarChart(data) {
      const barChart = new ApexCharts(document.querySelector("#barChart"), {
        chart: { type: 'bar', height: 300 },
        series: [{ name: 'Cantidad', data: data.map(item => parseFloat(item.cantidad)) }],
        xaxis: { categories: data.map(item => item.producto) },
        title: { text: 'Cantidad por Producto', align: 'center' }
      });
      barChart.render();
    }

    function renderLineChart(data) {
      const lineChart = new ApexCharts(document.querySelector("#lineChart"), {
        chart: { type: 'line', height: 300 },
        series: [{ name: 'Total (€)', data: data.map(item => parseFloat(item.total_item)) }],
        xaxis: { categories: data.map(item => item.fecha_solicitud) },
        title: { text: 'Evolución de Importes', align: 'center' }
      });
      lineChart.render();
    }

    function renderPieChart(data) {
      const pieChart = new ApexCharts(document.querySelector("#pieChart"), {
        chart: { type: 'pie', height: 300 },
        series: data.map(item => parseFloat(item.total_item)),
        labels: data.map(item => item.producto),
        title: { text: 'Distribución por Producto', align: 'center' }
      });
      pieChart.render();
    }

    function renderDonutChart(data) {
      const donutChart = new ApexCharts(document.querySelector("#donutChart"), {
        chart: { type: 'donut', height: 300 },
        series: [
          data.filter(item => parseFloat(item.transito) > 0).length,
          data.filter(item => parseFloat(item.transito) <= 0).length
        ],
        labels: ['Tránsito Positivo', 'Tránsito Negativo'],
        title: { text: 'Estado de Tránsito', align: 'center' }
      });
      donutChart.render();
    }

    // Listeners de Filtros
    document.getElementById('filterButton').addEventListener('click', () => {
      const filteredData = filterData();
      updateDashboard(filteredData);
    });

    // Inicializar
    fetchData();
  </script>
</body>
</html>
