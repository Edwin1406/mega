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
  <title>Gráfico y Tabla Mejorados</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <style>
    body {
      background-color: #f4f4f9;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 1200px;
      width: 100%;
      margin: 20px;
    }
    .filters {
      display: flex;
      gap: 1rem;
      margin-bottom: 20px;
    }
    label {
      font-size: 14px;
      font-weight: bold;
      color: #555;
    }
    select {
      padding: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
      background-color: #fff;
      color: #333;
    }
    select:focus {
      outline: none;
      border-color: #007bff;
    }
    #chart {
      margin-bottom: 20px;
      background-color: #f9fafb;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
    table.dataTable {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
    }
    table.dataTable thead th {
      background-color: #f9fafb;
      color: #333;
      font-weight: bold;
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    table.dataTable tbody td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      color: #555;
    }
    table.dataTable tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="filters">
      <div>
        <label for="gramajeFilter">Filtrar por Gramaje:</label>
        <select id="gramajeFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <div>
        <label for="anchoFilter">Filtrar por Ancho:</label>
        <select id="anchoFilter">
          <option value="">Todos</option>
        </select>
      </div>
    </div>

    <div id="chart" style="width: 100%; height: 400px;"></div>

    <table id="dataTable" class="display">
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
  </div>

  <script>
    $(document).ready(function () {
      const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

      function updateChart(chart, data) {
        const chartData = data.map((item) => ({
          x: `${item.gramaje} / ${item.ancho}`,
          y: parseInt(item.existencia),
        }));

        chart.updateSeries([
          {
            name: "Existencias",
            data: chartData,
          },
        ]);
      }

      function fetchData(chart, dataTable) {
        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
            const tableData = data.map((item) => [
              item.linea,
              item.gramaje,
              item.ancho,
              item.existencia,
            ]);
            dataTable.clear().rows.add(tableData).draw();

            updateChart(chart, data);

            const gramajes = [...new Set(data.map((item) => item.gramaje))];
            const anchos = [...new Set(data.map((item) => item.ancho))];

            gramajes.forEach((gramaje) => {
              if (!$(`#gramajeFilter option[value="${gramaje}"]`).length) {
                $("#gramajeFilter").append(
                  `<option value="${gramaje}">${gramaje}</option>`
                );
              }
            });

            anchos.forEach((ancho) => {
              if (!$(`#anchoFilter option[value="${ancho}"]`).length) {
                $("#anchoFilter").append(
                  `<option value="${ancho}">${ancho}</option>`
                );
              }
            });
          })
          .catch((error) => console.error("Error fetching data:", error));
      }

      const chart = new ApexCharts(document.querySelector("#chart"), {
        chart: {
          type: "bar",
          height: 400,
          toolbar: {
            show: true,
          },
        },
        series: [
          {
            name: "Existencias",
            data: [],
          },
        ],
        xaxis: {
          type: "category",
          labels: {
            rotate: -45,
          },
        },
        yaxis: {
          labels: {
            formatter: function (val) {
              return parseInt(val);
            },
          },
        },
        dataLabels: {
          enabled: false,
        },
        tooltip: {
          enabled: true,
        },
      });
      chart.render();

      const dataTable = $("#dataTable").DataTable({
        columns: [
          { title: "Línea" },
          { title: "Gramaje" },
          { title: "Ancho" },
          { title: "Existencias" },
        ],
      });

      fetchData(chart, dataTable);

      $("#gramajeFilter, #anchoFilter").on("change", function () {
        const selectedGramaje = $("#gramajeFilter").val();
        const selectedAncho = $("#anchoFilter").val();

        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
            const filteredData = data.filter((item) => {
              const gramajeMatch = !selectedGramaje || item.gramaje == selectedGramaje;
              const anchoMatch = !selectedAncho || item.ancho == selectedAncho;
              return gramajeMatch && anchoMatch;
            });

            updateChart(chart, filteredData);

            const tableData = filteredData.map((item) => [
              item.linea,
              item.gramaje,
              item.ancho,
              item.existencia,
            ]);
            dataTable.clear().rows.add(tableData).draw();
          })
          .catch((error) => console.error("Error filtering data:", error));
      });
    });
  </script>
</body>
</html>