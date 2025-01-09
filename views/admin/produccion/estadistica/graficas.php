<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div id="dashboard">
  <h1>Dashboard Dinámico con Filtros</h1>
  
  <!-- Filtros -->
  <div id="filters">
    <label>Fecha Solicitud</label>
    <input type="date" id="startDate" placeholder="Desde">
    <input type="date" id="endDate" placeholder="Hasta">
    
    <label>Proyecto</label>
    <select id="projectFilter"></select>
    
    <label>Trader</label>
    <select id="traderFilter"></select>
    
    <label>Marca</label>
    <select id="brandFilter"></select>
    
    <label>Producto</label>
    <select id="productFilter"></select>
    
    <button id="applyFilters">Aplicar Filtros</button>
  </div>
  
  <!-- Gráficos -->
  <div id="charts">
    <canvas id="chart1"></canvas> <!-- Gráfico de Fecha -->
    <canvas id="chart2"></canvas> <!-- Gráfico de Proyecto -->
    <canvas id="chart3"></canvas> <!-- Gráfico de Marca -->
    <canvas id="chart4"></canvas> <!-- Gráfico de Producto -->
  </div>
  
  <!-- Tabla -->
  <div id="dataTable">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Proyecto</th>
          <th>Marca</th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>
</div>
<style>

#dashboard {
  font-family: Arial, sans-serif;
  padding: 20px;
}

#filters {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  margin-bottom: 20px;
}

#charts {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 20px;
  margin-bottom: 20px;
}

#dataTable {
  overflow-x: auto;
  margin-top: 20px;
}

canvas {
  max-width: 100%;
  height: auto;
}

</style>


<script>

document.addEventListener("DOMContentLoaded", async () => {
  const apiUrl = "https://megawebsistem.com/admin/api/apiestadisticas";
  let rawData = [];
  let chartInstances = {}; // Para guardar instancias de gráficos

  // Fetch data
  const fetchData = async () => {
    const response = await fetch(apiUrl);
    rawData = await response.json();
    populateFilters(rawData);
    renderCharts(rawData); // Render inicial con todos los datos
    renderTable(rawData);
  };

  // Populate filters
  const populateFilters = (data) => {
    const projectFilter = document.getElementById("projectFilter");
    const traderFilter = document.getElementById("traderFilter");
    const brandFilter = document.getElementById("brandFilter");
    const productFilter = document.getElementById("productFilter");

    const unique = (key) => [...new Set(data.map(item => item[key]))];

    unique("proyecto").forEach(val => projectFilter.innerHTML += `<option value="${val}">${val}</option>`);
    unique("trader").forEach(val => traderFilter.innerHTML += `<option value="${val}">${val}</option>`);
    unique("marca").forEach(val => brandFilter.innerHTML += `<option value="${val}">${val}</option>`);
    unique("producto").forEach(val => productFilter.innerHTML += `<option value="${val}">${val}</option>`);
  };

  // Render charts
  const renderCharts = (data) => {
    const ctx1 = document.getElementById("chart1").getContext("2d");
    const ctx2 = document.getElementById("chart2").getContext("2d");
    const ctx3 = document.getElementById("chart3").getContext("2d");
    const ctx4 = document.getElementById("chart4").getContext("2d");

    // Fecha Solicitud - Línea
    chartInstances["fecha"] = new Chart(ctx1, {
      type: "line",
      data: {
        labels: data.map(item => item.fecha_solicitud),
        datasets: [{
          label: "Cantidad",
          data: data.map(item => parseInt(item.cantidad)),
          borderColor: "blue",
          borderWidth: 2
        }]
      },
      options: { responsive: true }
    });

    // Proyecto - Barras
    const proyectos = data.reduce((acc, curr) => {
      acc[curr.proyecto] = (acc[curr.proyecto] || 0) + parseInt(curr.cantidad);
      return acc;
    }, {});
    chartInstances["proyecto"] = new Chart(ctx2, {
      type: "bar",
      data: {
        labels: Object.keys(proyectos),
        datasets: [{
          label: "Cantidad",
          data: Object.values(proyectos),
          backgroundColor: "green"
        }]
      },
      options: { responsive: true }
    });

    // Marca - Pastel
    const marcas = data.reduce((acc, curr) => {
      acc[curr.marca] = (acc[curr.marca] || 0) + parseInt(curr.cantidad);
      return acc;
    }, {});
    chartInstances["marca"] = new Chart(ctx3, {
      type: "pie",
      data: {
        labels: Object.keys(marcas),
        datasets: [{
          label: "Cantidad",
          data: Object.values(marcas),
          backgroundColor: ["red", "yellow", "blue", "orange"]
        }]
      },
      options: { responsive: true }
    });

    // Producto - Barras horizontales
    const productos = data.reduce((acc, curr) => {
      acc[curr.producto] = (acc[curr.producto] || 0) + parseFloat(curr.total_item);
      return acc;
    }, {});
    chartInstances["producto"] = new Chart(ctx4, {
      type: "horizontalBar",
      data: {
        labels: Object.keys(productos),
        datasets: [{
          label: "Total",
          data: Object.values(productos),
          backgroundColor: "purple"
        }]
      },
      options: { responsive: true }
    });
  };

  // Render table
  const renderTable = (data) => {
    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";
    data.forEach(item => {
      tableBody.innerHTML += `
        <tr>
          <td>${item.id}</td>
          <td>${item.proyecto}</td>
          <td>${item.marca}</td>
          <td>${item.producto}</td>
          <td>${item.cantidad}</td>
          <td>${item.precio}</td>
          <td>${item.total_item}</td>
        </tr>`;
    });
  };

  // Apply Filters
  document.getElementById("applyFilters").addEventListener("click", () => {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;
    const project = document.getElementById("projectFilter").value;
    const trader = document.getElementById("traderFilter").value;
    const brand = document.getElementById("brandFilter").value;
    const product = document.getElementById("productFilter").value;

    const filteredData = rawData.filter(item => {
      const inDateRange = (!startDate || item.fecha_solicitud >= startDate) &&
                          (!endDate || item.fecha_solicitud <= endDate);
      const matchesProject = !project || item.proyecto === project;
      const matchesTrader = !trader || item.trader === trader;
      const matchesBrand = !brand || item.marca === brand;
      const matchesProduct = !product || item.producto === product;
      return inDateRange && matchesProject && matchesTrader && matchesBrand && matchesProduct;
    });

    Object.values(chartInstances).forEach(chart => chart.destroy()); // Clear old charts
    renderCharts(filteredData);
    renderTable(filteredData);
  });

  await fetchData();
});

</script>