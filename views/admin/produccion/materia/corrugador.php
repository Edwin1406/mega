<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<ul class="lista-areas-produccion">
   
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-estatico"  data-aos="fade-up">
        <a>
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO :
            <?php if ($totalCosto > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCosto ?> $ </span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fa-solid fa-calendar"> </i> TIEMPO PROMEDIO DE ROTACIÓN :
            <?php if ($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?>
        </a>
    </li>
</ul>




<ul class="lista-areas-produccion">



    <li class="areas-produccion-craft" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajacraft">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco"data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajamedium">
            <i class="fas fa-shopping-cart"></i> TOTAL EXISTENCIA CAJA-MEDIUM :
            <?php if (isset($totalExistenciaM) && $totalExistenciaM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> $ </span>
            <?php else : ?>
                <span class="areas-produccion__numero">  0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

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
    <div>
      <label for="filterLinea">Filtrar por Línea:</label>
      <select id="filterLinea">
        <option value="all">Todos</option>
      </select>
    </div>
  </div>

  <div class="graficas_blancas">
    <div id="chart" class="tamaño"></div>
  </div>

  <table id="dataTable">
    <thead>
      <tr>
        <th>Ancho</th>
        <th>Gramaje</th>
        <th>Línea</th>
        <th>Existencia</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
   


 (function () {
      const apiComercialUrl = `${location.origin}/admin/api/apicomercial`;
      let originalComercialData = [];
      let chart;

      async function fetchData() {
        try {
          const comercialResponse = await fetch(apiComercialUrl);
          originalComercialData = await comercialResponse.json();

          populateFilters(originalComercialData);
          renderChart(originalComercialData);
          renderTable(originalComercialData);
        } catch (error) {
          console.error("Error al obtener los datos de la API:", error);
        }
      }

      function populateFilters(comercialData) {
        const gramajes = [...new Set(comercialData.map(item => item.gramaje))];
        const anchos = [...new Set(comercialData.map(item => item.ancho))];

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

        let filteredComercial = originalComercialData;

        if (selectedGramaje !== "all") {
          filteredComercial = filteredComercial.filter(item => item.gramaje === selectedGramaje);
        }
        if (selectedAncho !== "all") {
          filteredComercial = filteredComercial.filter(item => item.ancho === selectedAncho);
        }

        renderChart(filteredComercial);
        renderTable(filteredComercial);
      }

      function renderChart(data) {
        const gramajes = [...new Set(data.map(item => item.gramaje))];
        const anchos = [...new Set(data.map(item => item.ancho))];

        const series = anchos.map(ancho => ({
          name: `Ancho: ${ancho}mm`,
          data: gramajes.map(gramaje => {
            const items = data.filter(item => item.ancho === ancho && item.gramaje === gramaje);
            return items.reduce((sum, item) => sum + parseFloat(item.cantidad || 0), 0);
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
              text: 'Cantidades Totales',
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
        const comercialTable = $("#comercialTable").DataTable();
        comercialTable.clear();

        data.forEach(item => {
          comercialTable.row.add([
            item.id,
            item.producto,
            item.ancho,
            item.gramaje,
            item.cantidad,
            item.estado,
          ]);
        });

        comercialTable.draw();
      }

      document.getElementById("filterGramaje").addEventListener("change", filterData);
      document.getElementById("filterAncho").addEventListener("change", filterData);

      $(document).ready(() => {
        $("#comercialTable").DataTable({
          language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
          },
        });
        fetchData();
      });
    })();


  </script>



<div>
    <h2>Pedidos (Comercial)</h2>
    <table id="comercialTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Ancho (mm)</th>
                <th>Gramaje (g/m²)</th>
                <th>Cantidad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

