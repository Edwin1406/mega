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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfico con Filtros y Tabla</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

  <style>
    #filters {
      display: flex;
      justify-content: space-between;
      margin: 20px auto;
      max-width: 800px;
    }
    #filters select {
      padding: 5px;
      font-size: 16px;
    }
    table {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h1>Gráfico de Existencias con Filtros</h1>
  <div class="grafica">

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
  </div>
  <div id="chart" class="tamaño" style="max-width: 800px; margin: auto;"></div>
  <table id="dataTable"  style="width:100%">
    <thead>
      <tr>
        <th>Ancho</th>
        <th>Gramaje</th>
        <th>Existencia</th>
        <th>Descripción</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";
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
        name: `Ancho ${ancho}`,
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
      $("#dataTable").DataTable();
      fetchData();
    });
  </script>
</body>
</html>



<div class="grafica">
  <div class="tamaño">
    <canvas id="producto-grafica"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart2"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart3"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart4"></canvas>
  </div>
  <div class="tamaño">
    <canvas id="myChart5"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Primer gráfico: Bar
  const grafica = document.querySelector('#producto-grafica');

  if(grafica){

        const ctx1 = document.getElementById('producto-grafica');
      new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });



  }

  // Segundo gráfico: Pie
  const ctx2 = document.getElementById('myChart2');
  if(ctx2){
    new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  // Tercer gráfico: Line
  const ctx3 = document.getElementById('myChart3');
  if(ctx3){
    new Chart(ctx3, {
      type: 'line',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }


  // Cuarto gráfico: Radar
  const ctx4 = document.getElementById('myChart4');
  if(ctx4){
    new Chart(ctx4, {
      type: 'radar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }


  // Quinto gráfico: Doughnut
  const ctx5 = document.getElementById('myChart5');
  if(ctx5){
    new Chart(ctx5, {
      type: 'doughnut',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: ['red', 'blue', 'yellow', 'green', 'purple', 'orange'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

</script>


 