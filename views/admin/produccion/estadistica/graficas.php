<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div id="filters-container">
  <h2>Filtros</h2>
  <!-- Filtros por fechas -->
  <label>Fecha Solicitud</label>
  <input type="date" id="startDate" placeholder="Desde">
  <input type="date" id="endDate" placeholder="Hasta">

  <!-- Filtros por texto -->
  <label>Proyecto</label>
  <select id="projectFilter"></select>
  
  <label>Trader</label>
  <select id="traderFilter"></select>

  <label>Marca</label>
  <select id="brandFilter"></select>

  <label>Producto</label>
  <select id="productFilter"></select>

  <!-- Filtros numéricos -->
  <label>Cantidad</label>
  <input type="number" id="minQuantity" placeholder="Mín">
  <input type="number" id="maxQuantity" placeholder="Máx">

  <label>Precio</label>
  <input type="number" id="minPrice" placeholder="Mín">
  <input type="number" id="maxPrice" placeholder="Máx">

  <!-- Botón de aplicar -->
  <button id="applyFilters">Aplicar Filtros</button>
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

  // Fetch Data
  const fetchData = async () => {
    const response = await fetch(apiUrl);
    rawData = await response.json();
    populateFilters(rawData);
  };

  // Populate Filters
  const populateFilters = (data) => {
    const projectFilter = document.getElementById("projectFilter");
    const traderFilter = document.getElementById("traderFilter");
    const brandFilter = document.getElementById("brandFilter");
    const productFilter = document.getElementById("productFilter");

    // Unique values
    const projects = [...new Set(data.map(item => item.proyecto))];
    const traders = [...new Set(data.map(item => item.trader))];
    const brands = [...new Set(data.map(item => item.marca))];
    const products = [...new Set(data.map(item => item.producto))];

    // Populate dropdowns
    projects.forEach(proj => projectFilter.innerHTML += `<option value="${proj}">${proj}</option>`);
    traders.forEach(trader => traderFilter.innerHTML += `<option value="${trader}">${trader}</option>`);
    brands.forEach(brand => brandFilter.innerHTML += `<option value="${brand}">${brand}</option>`);
    products.forEach(product => productFilter.innerHTML += `<option value="${product}">${product}</option>`);
  };

  // Apply Filters
  document.getElementById("applyFilters").addEventListener("click", () => {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;
    const project = document.getElementById("projectFilter").value;
    const trader = document.getElementById("traderFilter").value;
    const brand = document.getElementById("brandFilter").value;
    const product = document.getElementById("productFilter").value;
    const minQuantity = parseInt(document.getElementById("minQuantity").value) || 0;
    const maxQuantity = parseInt(document.getElementById("maxQuantity").value) || Infinity;
    const minPrice = parseFloat(document.getElementById("minPrice").value) || 0;
    const maxPrice = parseFloat(document.getElementById("maxPrice").value) || Infinity;

    const filteredData = rawData.filter(item => {
      const inDateRange = (!startDate || item.fecha_solicitud >= startDate) &&
                          (!endDate || item.fecha_solicitud <= endDate);
      const matchesProject = !project || item.proyecto === project;
      const matchesTrader = !trader || item.trader === trader;
      const matchesBrand = !brand || item.marca === brand;
      const matchesProduct = !product || item.producto === product;
      const inQuantityRange = item.cantidad >= minQuantity && item.cantidad <= maxQuantity;
      const inPriceRange = item.precio >= minPrice && item.precio <= maxPrice;

      return inDateRange && matchesProject && matchesTrader &&
             matchesBrand && matchesProduct && inQuantityRange && inPriceRange;
    });

    // Render charts or table with filteredData
    console.log("Filtered Data: ", filteredData);
  });

  await fetchData();
});


</script>