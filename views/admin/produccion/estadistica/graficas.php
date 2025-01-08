<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estadísticas de Producción</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
  <div class="container my-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Estadísticas de Producción</h1>
      <p class="text-muted">Visualización de datos en tiempo real</p>
    </div>

    <!-- Panel de Filtros -->
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

    <!-- Indicadores Clave (KPIs) -->
    <div class="row text-center mb-4">
      <div class="col-md-3">
        <h3 id="totalOrders">0</h3>
        <p>Pedidos Totales</p>
      </div>
      <div class="col-md-3">
        <h3 id="activeProjects">0</h3>
        <p>Proyectos Activos</p>
      </div>
      <div class="col-md-3">
        <h3 id="averageTransit">0 días</h3>
        <p>Tránsito Promedio</p>
      </div>
      <div class="col-md-3">
        <h3 id="totalAmount">0 $</h3>
        <p>Total Importes</p>
      </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
      <div class="col-md-6">
        <div id="barChart"></div>
      </div>
      <div class="col-md-6">
        <div id="pieChart"></div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div id="lineChart"></div>
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

    // Poblar los filtros dinámicamente
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
        return (!project || item.proyecto === project) &&
               (!product || item.producto === product) &&
               (!brand || item.marca === brand) &&
               (!trader || item.trader === trader) &&
               (!startDate || new Date(item.fecha_solicitud) >= new Date(startDate)) &&
               (!endDate || new Date(item.fecha_solicitud) <= new Date(endDate));
      });
    }

    // Actualizar Dashboard
    function updateDashboard(data) {
      // Actualizar KPIs
      document.getElementById('totalOrders').innerText = data.length;
      document.getElementById('activeProjects').innerText = [...new Set(data.map(item => item.proyecto))].length;
      document.getElementById('averageTransit').innerText = `${Math.round(data.reduce((acc, item) => acc + parseInt(item.transito || 0), 0) / data.length)} días`;
      document.getElementById('totalAmount').innerText = `${data.reduce((acc, item) => acc + parseFloat(item.total_item || 0), 0).toFixed(2)} $`;

      // Actualizar Gráficos
      renderBarChart(data);
      renderPieChart(data);
      renderLineChart(data);
    }

    // Gráficos
    function renderBarChart(data) {
      const barChart = new ApexCharts(document.querySelector("#barChart"), {
        chart: { type: 'bar' },
        series: [{ name: 'Cantidad', data: data.map(item => item.cantidad) }],
        xaxis: { categories: data.map(item => item.producto) }
      });
      barChart.render();
    }

    function renderPieChart(data) {
      const pieChart = new ApexCharts(document.querySelector("#pieChart"), {
        chart: { type: 'pie' },
        series: data.map(item => parseFloat(item.total_item)),
        labels: data.map(item => item.producto)
      });
      pieChart.render();
    }

    function renderLineChart(data) {
      const lineChart = new ApexCharts(document.querySelector("#lineChart"), {
        chart: { type: 'line' },
        series: [{ name: 'Importes', data: data.map(item => parseFloat(item.total_item)) }],
        xaxis: { categories: data.map(item => item.fecha_solicitud) }
      });
      lineChart.render();
    }

    // Listeners de Filtros
    document.getElementById('projectFilter').addEventListener('change', () => updateDashboard(filterData()));
    document.getElementById('productFilter').addEventListener('change', () => updateDashboard(filterData()));
    document.getElementById('brandFilter').addEventListener('change', () => updateDashboard(filterData()));
    document.getElementById('traderFilter').addEventListener('change', () => updateDashboard(filterData()));
    document.getElementById('startDate').addEventListener('change', () => updateDashboard(filterData()));
    document.getElementById('endDate').addEventListener('change', () => updateDashboard(filterData()));

    // Inicializar
    fetchData();
  </script>a
</body>
</html>
