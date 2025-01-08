<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div id="dashboard">
  <!-- Filtros -->
  <div id="filters">
    <select id="projectFilter"></select>
    <select id="productFilter"></select>
    <select id="brandFilter"></select>
    <input type="date" id="startDate">
    <input type="date" id="endDate">
  </div>

  <!-- Gráficos -->
  <div id="charts">
    <div id="barChart"></div>
    <div id="pieChart"></div>
    <div id="lineChart"></div>
  </div>

  <!-- Tabla -->
  <div id="dataTable"></div>
</div>

<script>
  // Configuración de gráficos con ApexCharts
  var optionsBar = {
    chart: { type: 'bar' },
    series: [{ name: 'Progreso', data: [30, 40, 55, 70] }],
    xaxis: { categories: ['Fecha Solicitud', 'Fecha Producción', 'ETS', 'ETA'] },
  };

  var barChart = new ApexCharts(document.querySelector("#barChart"), optionsBar);
  barChart.render();

  var optionsPie = {
    chart: { type: 'pie' },
    series: [44, 55, 13],
    labels: ['Producto A', 'Producto B', 'Producto C'],
  };

  var pieChart = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
  pieChart.render();

  var optionsLine = {
    chart: { type: 'line' },
    series: [{ name: 'Importes', data: [1000, 2000, 1500, 2500] }],
    xaxis: { categories: ['Enero', 'Febrero', 'Marzo', 'Abril'] },
  };

  var lineChart = new ApexCharts(document.querySelector("#lineChart"), optionsLine);
  lineChart.render();
</script>
