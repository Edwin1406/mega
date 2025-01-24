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
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.1/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f4f6;
      font-family: 'Inter', sans-serif;
    }
    .container {
      max-width: 1200px;
      margin: 20px auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .filters {
      display: flex;
      gap: 1rem;
      margin-bottom: 20px;
    }
    select {
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
    }
    select:focus {
      outline: 2px solid #2563eb;
    }
    #chart {
      margin-bottom: 20px;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="filters">
      <div>
        <label for="gramajeFilter" class="block text-gray-700 font-semibold mb-1">Filtrar por Gramaje:</label>
        <select id="gramajeFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <div>
        <label for="anchoFilter" class="block text-gray-700 font-semibold mb-1">Filtrar por Ancho:</label>
        <select id="anchoFilter">
          <option value="">Todos</option>
        </select>
      </div>
      <button id="applyFilter" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
        Aplicar Filtro
      </button>
    </div>

    <div id="chart" style="width: 100%; height: 400px;"></div>

    <table id="dataTable" class="display w-full">
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

      // Función para actualizar el gráfico
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

      // Fetch inicial de datos
      function fetchData(chart, dataTable, filters = {}) {
        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
            // Aplicar filtros
            const filteredData = data.filter((item) => {
              const gramajeMatch = !filters.gramaje || item.gramaje == filters.gramaje;
              const anchoMatch = !filters.ancho || item.ancho == filters.ancho;
              return gramajeMatch && anchoMatch;
            });

            // Actualizar tabla
            const tableData = filteredData.map((item) => [
              item.linea,
              item.gramaje,
              item.ancho,
              item.existencia,
            ]);
            dataTable.clear().rows.add(tableData).draw();

            // Actualizar gráfico
            updateChart(chart, filteredData);

            // Rellenar filtros dinámicos
            if (!filters.initialized) {
              const gramajes = [...new Set(data.map((item) => item.gramaje))];
              const anchos = [...new Set(data.map((item) => item.ancho))];

              gramajes.forEach((gramaje) => {
                $("#gramajeFilter").append(
                  `<option value="${gramaje}">${gramaje}</option>`
                );
              });

              anchos.forEach((ancho) => {
                $("#anchoFilter").append(
                  `<option value="${ancho}">${ancho}</option>`
                );
              });
            }
          })
          .catch((error) => console.error("Error fetching data:", error));
      }

      // Inicializar gráfico
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
            formatter: (val) => parseInt(val),
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

      // Inicializar DataTable
      const dataTable = $("#dataTable").DataTable({
        columns: [
          { title: "Línea" },
          { title: "Gramaje" },
          { title: "Ancho" },
          { title: "Existencias" },
        ],
      });

      // Obtener datos iniciales
      fetchData(chart, dataTable, { initialized: false });

      // Aplicar filtros
      $("#applyFilter").on("click", function () {
        const gramaje = $("#gramajeFilter").val();
        const ancho = $("#anchoFilter").val();

        fetchData(chart, dataTable, {
          gramaje: gramaje,
          ancho: ancho,
          initialized: true,
        });
      });
    });
  </script>
</body>
</html>