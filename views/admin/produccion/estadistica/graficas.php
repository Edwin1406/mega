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
        <h3 id="totalAmount">0 €</h3>
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

    <!-- Tabla -->
    <div class="mt-4">
      <h4>Detalles de los Pedidos</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Proyecto</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Fecha Solicitud</th>
          </tr>
        </thead>
        <tbody id="tableBody"></tbody>
      </table>
    </div>
  </div>

  <script>
    // Ejemplo de conexión a la API
    fetch('https://megawebsistem.com/admin/api/apiestadisticas')
      .then(response => response.json())
      .then(data => {
        // Actualizar KPIs
        document.getElementById('totalOrders').innerText = data.length;
        document.getElementById('activeProjects').innerText = [...new Set(data.map(item => item.proyecto))].length;
        document.getElementById('averageTransit').innerText = `${Math.round(data.reduce((acc, item) => acc + parseInt(item.transito || 0), 0) / data.length)} días`;
        document.getElementById('totalAmount').innerText = `${data.reduce((acc, item) => acc + parseFloat(item.total_item || 0), 0).toFixed(2)} €`;

        // Gráfico de Barras
        var barChart = new ApexCharts(document.querySelector("#barChart"), {
          chart: { type: 'bar' },
          series: [{ name: 'Cantidad', data: data.map(item => item.cantidad) }],
          xaxis: { categories: data.map(item => item.producto) }
        });
        barChart.render();

        // Gráfico Circular
        var pieChart = new ApexCharts(document.querySelector("#pieChart"), {
          chart: { type: 'pie' },
          series: data.map(item => parseFloat(item.total_item)),
          labels: data.map(item => item.producto)
        });
        pieChart.render();

        // Gráfico de Líneas
        var lineChart = new ApexCharts(document.querySelector("#lineChart"), {
          chart: { type: 'line' },
          series: [{ name: 'Importes', data: data.map(item => parseFloat(item.total_item)) }],
          xaxis: { categories: data.map(item => item.fecha_solicitud) }
        });
        lineChart.render();

        // Tabla
        const tableBody = document.getElementById('tableBody');
        data.forEach(item => {
          const row = `<tr>
            <td>${item.proyecto}</td>
            <td>${item.producto}</td>
            <td>${item.cantidad}</td>
            <td>${item.precio}</td>
            <td>${item.total_item}</td>
            <td>${item.fecha_solicitud}</td>
          </tr>`;
          tableBody.innerHTML += row;
        });
      });
  </script>
</body>
</html>
