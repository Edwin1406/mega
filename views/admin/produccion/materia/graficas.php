<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
   

    h1 {
      margin-top: 20px;
      font-size: 24px;
      color: #222;
    }

    .filter-container {
      margin: 20px 0;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 15px;
      align-items: center;
    }

    label {
      font-size: 14px;
    }

    input, button {
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    button {
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .charts-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
    }

    .chart {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }
  </style>

  <h1>Dashboard - Materia Prima</h1>
  <div class="filter-container">
    <label for="startDate">Fecha de inicio:</label>
    <input type="date" id="startDate">
    
    <label for="endDate">Fecha de fin:</label>
    <input type="date" id="endDate">

    <label for="weightFilter">Peso mínimo:</label>
    <input type="number" id="weightFilter" placeholder="Ej: 50">

    <button onclick="filterData()">Filtrar</button>
  </div>

  <div class="charts-container">
    <div id="barChart" class="chart"></div>
    <div id="lineChart" class="chart"></div>
    <div id="pieChart" class="chart"></div>
    <div id="totalKgChart" class="chart"></div>
  </div>

  <script>
    // URL de la API
    const apiUrl = "https://megawebsistem.com/admin/api/ApiMateriaPrima";

    // Función para obtener datos de la API
    async function fetchData() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        return data;
      } catch (error) {
        console.error("Error al obtener los datos:", error);
        return [];
      }
    }

    // Filtrar datos por fecha y peso
    async function filterData() {
      const startDate = document.getElementById("startDate").value;
      const endDate = document.getElementById("endDate").value;
      const weightFilter = document.getElementById("weightFilter").value;

      if (!startDate || !endDate) {
        alert("Selecciona ambas fechas para filtrar.");
        return;
      }

      // Obtener datos de la API
      const allData = await fetchData();

      // Filtrar según las fechas y peso
      const filteredData = allData.filter(item => {
        const itemDate = new Date(item.created_at);
        const itemWeight = parseInt(item.peso, 10);
        return (
          itemDate >= new Date(startDate) &&
          itemDate <= new Date(endDate) &&
          (!weightFilter || itemWeight >= weightFilter)
        );
      });

      // Procesar datos para los gráficos
      updateCharts(filteredData);
    }

    // Crear y actualizar los gráficos
    let barChart, lineChart, pieChart, totalKgChart;

    function updateCharts(data) {
      const labels = data.map(item => item.nombre_rollo);
      const values = data.map(item => parseInt(item.peso));
      const totalKg = values.reduce((sum, val) => sum + val, 0);

      // Gráfico de barras
      const barOptions = {
        series: [{ name: "Peso de los rollos", data: values }],
        chart: { type: "bar", height: 350 },
        xaxis: { categories: labels, title: { text: "Nombre de los rollos" } },
        yaxis: { title: { text: "Peso (kg)" } }
      };

      if (barChart) barChart.destroy();
      barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
      barChart.render();

      // Gráfico de líneas
      const lineOptions = {
        series: [{ name: "Peso de los rollos", data: values }],
        chart: { type: "line", height: 350 },
        xaxis: { categories: labels, title: { text: "Nombre de los rollos" } },
        yaxis: { title: { text: "Peso (kg)" } }
      };

      if (lineChart) lineChart.destroy();
      lineChart = new ApexCharts(document.querySelector("#lineChart"), lineOptions);
      lineChart.render();

      // Gráfico de pastel
      const pieOptions = {
        series: values,
        chart: { type: "pie", height: 350 },
        labels: labels
      };

      if (pieChart) pieChart.destroy();
      pieChart = new ApexCharts(document.querySelector("#pieChart"), pieOptions);
      pieChart.render();

      // Gráfico de total de kilogramos
      const totalKgOptions = {
        series: [totalKg],
        chart: { type: "radialBar", height: 350 },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: { show: true, fontSize: "16px" },
              value: { fontSize: "24px", formatter: () => `${totalKg} kg` }
            }
          }
        },
        labels: ["Total Kg"]
      };

      if (totalKgChart) totalKgChart.destroy();
      totalKgChart = new ApexCharts(document.querySelector("#totalKgChart"), totalKgOptions);
      totalKgChart.render();
    }

    // Inicializar gráficos con todos los datos
    fetchData().then(updateCharts);

    
  </script>














