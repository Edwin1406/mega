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
  <title>Gráfico y Tabla</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>
<body>
  <div>
    <label for="gramajeFilter">Filtrar por Gramaje:</label>
    <select id="gramajeFilter">
      <option value="">Todos</option>
    </select>

    <label for="anchoFilter">Filtrar por Ancho:</label>
    <select id="anchoFilter">
      <option value="">Todos</option>
    </select>
  </div>

  <div id="chart" style="width: 100%; height: 400px;"></div>

  <table id="dataTable" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Línea</th>
        <th>Gramaje</th>
        <th>Ancho</th>
        <th>Existencias</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    $(document).ready(function () {
      const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

      // Fetch data from API
      fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
          // Prepare data for the chart and table
          const chartData = [];
          const uniqueGramajes = new Set();
          const uniqueAnchos = new Set();
          const tableData = [];

          data.forEach((item) => {
            chartData.push({
              x: `${item.gramaje} / ${item.ancho}`,
              y: parseInt(item.existencia),
            });
            uniqueGramajes.add(item.gramaje);
            uniqueAnchos.add(item.ancho);

            tableData.push([
              item.linea,
              item.gramaje,
              item.ancho,
              item.existencia,
            ]);
          });

          // Populate filters
          uniqueGramajes.forEach((gramaje) => {
            $("#gramajeFilter").append(
              `<option value="${gramaje}">${gramaje}</option>`
            );
          });
          uniqueAnchos.forEach((ancho) => {
            $("#anchoFilter").append(
              `<option value="${ancho}">${ancho}</option>`
            );
          });

          // Initialize chart
          const chart = new ApexCharts(document.querySelector("#chart"), {
            chart: {
              type: "bar",
            },
            series: [
              {
                name: "Existencias",
                data: chartData,
              },
            ],
            xaxis: {
              type: "category",
            },
          });
          chart.render();

          // Initialize DataTable
          const dataTable = $("#dataTable").DataTable({
            data: tableData,
            columns: [
              { title: "Línea" },
              { title: "Gramaje" },
              { title: "Ancho" },
              { title: "Existencias" },
            ],
          });

          // Filter functionality
          $("#gramajeFilter, #anchoFilter").on("change", function () {
            const selectedGramaje = $("#gramajeFilter").val();
            const selectedAncho = $("#anchoFilter").val();

            // Filter table
            dataTable.clear().rows.add(
              tableData.filter((row) => {
                const gramajeMatch =
                  !selectedGramaje || row[1] == selectedGramaje;
                const anchoMatch = !selectedAncho || row[2] == selectedAncho;
                return gramajeMatch && anchoMatch;
              })
            ).draw();

            // Filter chart
            const filteredChartData = chartData.filter((data) => {
              const [gramaje, ancho] = data.x.split(" / ");
              const gramajeMatch = !selectedGramaje || gramaje == selectedGramaje;
              const anchoMatch = !selectedAncho || ancho == selectedAncho;
              return gramajeMatch && anchoMatch;
            });

            chart.updateSeries([
              {
                name: "Existencias",
                data: filteredChartData,
              },
            ]);
          });
        })
        .catch((error) => console.error("Error fetching data:", error));
    });
  </script>
</body>
</html>



