<div id="dashboard">
  <div id="filters">
    <label>Rango de Fechas:</label>
    <input type="date" id="startDate">
    <input type="date" id="endDate">
    <label>Proyecto:</label>
    <select id="projectFilter"></select>
    <label>Marca:</label>
    <select id="brandFilter"></select>
    <button id="applyFilters">Aplicar Filtros</button>
  </div>
  <div id="charts">
    <div id="barChart"></div>
    <div id="lineChart"></div>
    <div id="pieChart"></div>
  </div>
  <div id="dataTable">
    <table>
      <thead>
        <tr>
          <th>Import</th>
          <th>Proyecto</th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Total</th>
          <th>Fecha Solicitud</th>
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
  gap: 10px;
  margin-bottom: 20px;
}
#charts {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}
#dataTable {
  max-height: 300px;
  overflow-y: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}
table th, table td {
  border: 1px solid #ddd;
  padding: 8px;
}
table th {
  background-color: #f4f4f4;
}

</style>
<script>
document.addEventListener("DOMContentLoaded", async () => {
  const apiUrl = "https://megawebsistem.com/admin/api/apiestadisticas";
  let rawData = [];
  
  // Fetch data
  const fetchData = async () => {
    const response = await fetch(apiUrl);
    const data = await response.json();
    rawData = data;
    updateFilters(data);
    renderCharts(data);
    renderTable(data);
  };

  // Update filters
  const updateFilters = (data) => {
    const projects = [...new Set(data.map(item => item.proyecto))];
    const brands = [...new Set(data.map(item => item.marca))];

    const projectFilter = document.getElementById("projectFilter");
    projects.forEach(project => {
      const option = document.createElement("option");
      option.value = project;
      option.textContent = project;
      projectFilter.appendChild(option);
    });

    const brandFilter = document.getElementById("brandFilter");
    brands.forEach(brand => {
      const option = document.createElement("option");
      option.value = brand;
      option.textContent = brand;
      brandFilter.appendChild(option);
    });
  };

  // Render charts
  const renderCharts = (data) => {
    // Bar Chart
    const barOptions = {
      series: [
        {
          name: "Cantidad",
          data: data.map(item => parseInt(item.cantidad)),
        },
      ],
      chart: { type: "bar" },
      xaxis: { categories: data.map(item => item.proyecto) },
    };
    new ApexCharts(document.querySelector("#barChart"), barOptions).render();

    // Line Chart
    const lineOptions = {
      series: [
        {
          name: "Cantidad",
          data: data.map(item => parseInt(item.cantidad)),
        },
      ],
      chart: { type: "line" },
      xaxis: { categories: data.map(item => item.fecha_solicitud) },
    };
    new ApexCharts(document.querySelector("#lineChart"), lineOptions).render();

    // Pie Chart
    const pieOptions = {
      series: data.map(item => parseFloat(item.total_item)),
      chart: { type: "pie" },
      labels: data.map(item => item.producto),
    };
    new ApexCharts(document.querySelector("#pieChart"), pieOptions).render();
  };

  // Render table
  const renderTable = (data) => {
    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";
    data.forEach(item => {
      const row = `<tr>
        <td>${item.import}</td>
        <td>${item.proyecto}</td>
        <td>${item.producto}</td>
        <td>${item.cantidad}</td>
        <td>${item.precio}</td>
        <td>${item.total_item}</td>
        <td>${item.fecha_solicitud}</td>
      </tr>`;
      tableBody.insertAdjacentHTML("beforeend", row);
    });
  };

  // Apply filters
  document.getElementById("applyFilters").addEventListener("click", () => {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;
    const project = document.getElementById("projectFilter").value;
    const brand = document.getElementById("brandFilter").value;

    const filteredData = rawData.filter(item => {
      const isDateInRange =
        (!startDate || item.fecha_solicitud >= startDate) &&
        (!endDate || item.fecha_solicitud <= endDate);
      const isProjectMatch = !project || item.proyecto === project;
      const isBrandMatch = !brand || item.marca === brand;

      return isDateInRange && isProjectMatch && isBrandMatch;
    });

    renderCharts(filteredData);
    renderTable(filteredData);
  });

  // Initial fetch
  await fetchData();
});


</script>