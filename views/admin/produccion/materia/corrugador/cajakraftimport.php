<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>






<ul class="lista-areas-produccion">
  <li class="areas-produccion-estatico-craft">
    <a href="#">
      <i class="fas fa-shopping-cart"></i> TOTAL CAJAS KRAFT :
      <?php if ($totalExistenciaKI > 0) : ?>
        <span class="areas-produccion__numero"> <?php echo $totalExistenciaKI ?> KG </span>
      <?php endif; ?>
    </a>
  </li>
</ul>




<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>



<style>
  .original {
    display: flex;
    justify-content: 1fr 1fr;
    gap: 1rem;

  }
</style>

<div class="original">

  <div class="graficas_blancas">

    <div id="filters">
      <div>
        <label for="filterGramaje">Filtrar por Gramaje:</label>
        <select id="filterGramaje">
          <option value="all">Todos</option>
        </select>
      </div>
      <div>
        <label for="filterAncho">Filtrar por Ancho:</label>
        <select id="filterAncho">
          <option value="all">Todos</option>
        </select>
      </div>
    </div>
    <div id="chart" class="tamaño"></div>
  </div>

  <div>

    <table id="dataTable">
      <thead>
        <tr>
          <th>Ancho</th>
          <th>Gramaje</th>
          <th>Existencia</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

</div>


<script>
  (function() {
    const apiUrl = `${location.origin}/admin/api/apicajakraftimport`;
    let originalData = [];
    let chart;

    async function fetchData() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        originalData = data;
        populateFilters(data);
        renderChart(data);
        renderTable(data);
      } catch (error) {
        console.error("Error al obtener los datos de la API:", error);
      }
    }

    function populateFilters(data) {
      const gramajes = [...new Set(data.map(item => item.gramaje))];
      const anchos = [...new Set(data.map(item => item.ancho))];

      const gramajeSelect = document.getElementById("filterGramaje");
      gramajes.forEach(gramaje => {
        const option = document.createElement("option");
        option.value = gramaje;
        option.textContent = gramaje;
        gramajeSelect.appendChild(option);
      });

      const anchoSelect = document.getElementById("filterAncho");
      anchos.forEach(ancho => {
        const option = document.createElement("option");
        option.value = ancho;
        option.textContent = ancho;
        anchoSelect.appendChild(option);
      });
    }

    function filterData() {
      const selectedGramaje = document.getElementById("filterGramaje").value;
      const selectedAncho = document.getElementById("filterAncho").value;

      let filteredData = originalData;

      if (selectedGramaje !== "all") {
        filteredData = filteredData.filter(item => item.gramaje === selectedGramaje);
      }
      if (selectedAncho !== "all") {
        filteredData = filteredData.filter(item => item.ancho === selectedAncho);
      }

      renderChart(filteredData);
      renderTable(filteredData);
    }

    function renderChart(data) {
      const gramajes = [...new Set(data.map(item => item.gramaje))];
      const anchos = [...new Set(data.map(item => item.ancho))];

      const series = anchos.map(ancho => ({
        name: `Ancho : ${ancho}m`,
        data: gramajes.map(gramaje => {
          const items = data.filter(item => item.ancho === ancho && item.gramaje === gramaje);
          return items.reduce((sum, item) => sum + parseFloat(item.existencia), 0);
        }),
      }));

      const options = {
        series: series,
        chart: {
          type: 'bar',
          height: 400,
          stacked: true,
          toolbar: {
            show: true,
          },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 4,
          },
        },
        dataLabels: {
          enabled: true,
        },
        xaxis: {
          categories: gramajes,
          title: {
            text: 'Gramajes',
          },
        },
        yaxis: {
          title: {
            text: 'Existencias Totales',
          },
        },
        legend: {
          position: 'top',
        },
        fill: {
          opacity: 1,
        },
      };

      if (chart) {
        chart.updateOptions(options);
      } else {
        chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      }
    }

    function renderTable(data) {
      const table = $("#dataTable").DataTable();
      table.clear();

      data.forEach(item => {
        table.row.add([
          item.ancho,
          item.gramaje,
          item.existencia,
          item.descripcion,
        ]);
      });

      table.draw();
    }

    document.getElementById("filterGramaje").addEventListener("change", filterData);
    document.getElementById("filterAncho").addEventListener("change", filterData);

    $(document).ready(() => {
      $("#dataTable").DataTable({
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
      });
      fetchData();
    });


  })();
</script>