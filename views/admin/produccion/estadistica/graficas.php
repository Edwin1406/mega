<div id="filters">
  <h2>Filtros</h2>
  
  <label>Fecha de Pedido</label>
  <input type="date" id="startDate" placeholder="Desde">
  <input type="date" id="endDate" placeholder="Hasta">
  
  <label>Proyecto</label>
  <select id="projectFilter"></select>

  <button id="applyFilters">Aplicar Filtros</button>
</div>

<div id="charts">
  <canvas id="productionChart"></canvas> <!-- Tiempo de Producción -->
  <canvas id="transitChart"></canvas> <!-- Tiempo de Embarque y Tránsito -->
  <canvas id="arrivalChart"></canvas> <!-- Tiempo Aproximado de Llegada al Puerto -->
  <canvas id="plantArrivalChart"></canvas> <!-- Tiempo de Llegada a Planta -->
</div>
<style>
#filters {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

#charts {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 20px;
}

canvas {
  max-width: 100%;
  height: auto;
}


</style>

<script>
  document.addEventListener("DOMContentLoaded", async () => {
  const apiUrl = "https://megawebsistem.com/admin/api/apiestadisticas"; // URL de la API
  let rawData = [];
  let chartInstances = {}; // Para guardar las instancias de gráficos

  // Fetch Data
  const fetchData = async () => {
    const response = await fetch(apiUrl);
    rawData = await response.json();
    populateFilters(rawData);
    renderCharts(rawData); // Render inicial con todos los datos
  };

  // Populate Filters
  const populateFilters = (data) => {
    const projectFilter = document.getElementById("projectFilter");
    const projects = [...new Set(data.map(item => item.proyecto))];

    projects.forEach(proj => {
      projectFilter.innerHTML += `<option value="${proj}">${proj}</option>`;
    });
  };

  // Render Charts
  const renderCharts = (data) => {
    // Tiempo de Producción
    const productionData = data.map(item => ({
      label: item.proyecto,
      value: parseInt(item.tiempo_produccion || 0)
    }));
    chartInstances["production"] = new Chart(document.getElementById("productionChart").getContext("2d"), {
      type: "bar",
      data: {
        labels: productionData.map(d => d.label),
        datasets: [{
          label: "Tiempo de Producción (días)",
          data: productionData.map(d => d.value),
          backgroundColor: "blue"
        }]
      }
    });

    // Tiempo de Embarque y Tránsito
    const transitData = data.map(item => ({
      label: item.proyecto,
      value: parseInt(item.tiempo_embarque || 0)
    }));
    chartInstances["transit"] = new Chart(document.getElementById("transitChart").getContext("2d"), {
      type: "bar",
      data: {
        labels: transitData.map(d => d.label),
        datasets: [{
          label: "Tiempo de Tránsito (días)",
          data: transitData.map(d => d.value),
          backgroundColor: "orange"
        }]
      }
    });

    // Tiempo Aproximado de Llegada al Puerto
    const arrivalData = data.map(item => ({
      label: item.proyecto,
      value: parseInt(item.tiempo_llegada_puerto || 0)
    }));
    chartInstances["arrival"] = new Chart(document.getElementById("arrivalChart").getContext("2d"), {
      type: "line",
      data: {
        labels: arrivalData.map(d => d.label),
        datasets: [{
          label: "Tiempo de Llegada al Puerto (días)",
          data: arrivalData.map(d => d.value),
          borderColor: "green",
          borderWidth: 2
        }]
      }
    });

    // Tiempo Total de Llegada a Planta
    const plantArrivalData = data.map(item => ({
      label: item.proyecto,
      value: parseInt(item.tiempo_llegada_planta || 0)
    }));
    chartInstances["plantArrival"] = new Chart(document.getElementById("plantArrivalChart").getContext("2d"), {
      type: "line",
      data: {
        labels: plantArrivalData.map(d => d.label),
        datasets: [{
          label: "Tiempo Total de Llegada a Planta (días)",
          data: plantArrivalData.map(d => d.value),
          borderColor: "red",
          borderWidth: 2
        }]
      }
    });
  };

  // Apply Filters
  document.getElementById("applyFilters").addEventListener("click", () => {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;
    const project = document.getElementById("projectFilter").value;

    const filteredData = rawData.filter(item => {
      const inDateRange =
        (!startDate || item.fecha_pedido >= startDate) &&
        (!endDate || item.fecha_pedido <= endDate);
      const matchesProject = !project || item.proyecto === project;
      return inDateRange && matchesProject;
    });

    Object.values(chartInstances).forEach(chart => chart.destroy()); // Limpiar gráficos
    renderCharts(filteredData);
  });

  await fetchData();
});

</script>