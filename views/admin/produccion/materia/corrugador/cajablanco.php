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


  
<div class="graficas_blancas">
  <div id="chart" class="tamaño"></div>
</div>






  <table id="dataTable"  style="width:100%">
    <thead>
      <tr>
        <th>Ancho</th>
        <th>Gramaje</th>
        <th>Existencia</th>
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






<div class="graficas_blancas">
  <div id="chart20" class="tamaño"></div>
  <div id="chart21" class="tamaño"></div>
  <div id="chart22" class="tamaño"></div>
  <div id="chart_pie" class="tamaño"></div> <!-- Contenedor para el gráfico de pastel -->
</div>
<script>
  api();
  async function api() {
    const url = 'https://megawebsistem.com/admin/api/apicajablanco';
    const respuesta = await fetch(url);
    const resultado = await respuesta.json();
    console.log(resultado);

    // Opciones del gráfico de pastel
    let pieOptions = {
      chart: {
        type: 'pie',
        height: 350,
      },
      series: resultado.map(item => item.existencia), // Datos a graficar
      labels: resultado.map(item => item.ancho), // Etiquetas para cada segmento

      title: {
        text: 'Existencia de Caja Blanca',
        align: 'center',
        style: {
          fontSize: '20px',
          fontWeight: 'bold',
        },
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opts) {
          // Mostrar gramaje (existencia) en lugar del porcentaje
          const index = opts.seriesIndex;
          return `${resultado[index].gramaje} g`;
        },
        style: {
          fontSize: '14px',
          colors: ['#FFFFFF'],
        },
      },
      legend: {
        position: 'right',
        labels: {
          colors: ['#000000'],
        },
      },
      colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'], // Colores personalizados
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 300,
          },
          legend: {
            position: 'bottom',
          },
        },
      }],
    };

    // Renderiza el gráfico de pastel en su contenedor
    const chartPie = new ApexCharts(document.querySelector("#chart_pie"), pieOptions);
    chartPie.render();
  }
</script>
