<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Estadísticas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    .card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
      padding: 15px;
    }
    h1, h3 {
      font-weight: bold;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container my-4">
    <!-- Título -->
    <h1 class="text-center mb-4">Dashboard - Estadísticas</h1>

    <!-- Filtros -->
    <div class="row mb-4">
      <div class="col-md-2">
        <label for="projectFilter" class="form-label">Proyecto</label>
        <select id="projectFilter" class="form-select">
          <option value="">Todos</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="productFilter" class="form-label">Producto</label>
        <select id="productFilter" class="form-select">
          <option value="">Todos</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="brandFilter" class="form-label">Marca</label>
        <select id="brandFilter" class="form-select">
          <option value="">Todas</option>
        </select>
      </div>
      <div class="col-md-2">
        <label for="traderFilter" class="form-label">Trader</label>
        <select id="traderFilter" class="form-select">
          <option value="">Todos</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="dateFilter" class="form-label">Rango de Fechas</label>
        <div class="d-flex">
          <input type="date" id="startDate" class="form-control me-2">
          <input type="date" id="endDate" class="form-control">
        </div>
      </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="chart-container" id="barChart"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="chart-container" id="lineChart"></div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="chart-container" id="pieChart"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="chart-container" id="donutChart"></div>
        </div>
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

    // Inicializar
    fetchData();
  </script>
</body>
</html>
