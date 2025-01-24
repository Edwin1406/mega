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
    <title>Tabla Interactiva</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
      
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table thead {
            background: #f4f4f9;
        }
    </style>
</head>
<body>
    <div class="filters">
        <label for="filterGramaje">Filtrar por Gramaje:</label>
        <select id="filterGramaje">
            <option value="Todos">Todos</option>
        </select>

        <label for="filterAncho">Filtrar por Ancho:</label>
        <select id="filterAncho">
            <option value="Todos">Todos</option>
        </select>
    </div>

    <table id="dataTable">
        <thead>
            <tr>
                <th>Línea</th>
                <th>Gramaje</th>
                <th>Ancho</th>
                <th>Existencias</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contenido dinámico -->
        </tbody>
    </table>

    <script>
        const apiUrl = 'https://megawebsistem.com/admin/api/apicajablanco'; // Reemplaza con la URL real de tu API

        let originalData; // Almacena los datos originales

        // Cargar datos de la API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                originalData = data;
                populateFilters(data);
                populateTable(data);
                initializeDataTable();
            })
            .catch(error => console.error('Error al cargar los datos:', error));

        // Poblar los filtros
        function populateFilters(data) {
            const gramajes = new Set();
            const anchos = new Set();

            Object.values(data).forEach(lineaData => {
                lineaData.gramajes.forEach(gramaje => gramajes.add(gramaje));
                lineaData.anchos.forEach(ancho => anchos.add(ancho));
            });

            const filterGramaje = document.getElementById('filterGramaje');
            const filterAncho = document.getElementById('filterAncho');

            gramajes.forEach(gramaje => {
                const option = document.createElement('option');
                option.value = gramaje;
                option.textContent = gramaje;
                filterGramaje.appendChild(option);
            });

            anchos.forEach(ancho => {
                const option = document.createElement('option');
                option.value = ancho;
                option.textContent = ancho;
                filterAncho.appendChild(option);
            });

            filterGramaje.addEventListener('change', applyFilters);
            filterAncho.addEventListener('change', applyFilters);
        }

        // Poblar la tabla
        function populateTable(data) {
            const tableBody = document.getElementById('dataTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Limpiar contenido previo

            Object.keys(data).forEach(linea => {
                const lineaData = data[linea];

                lineaData.labels.forEach((label, index) => {
                    const gramaje = lineaData.gramajes[index];
                    const ancho = lineaData.anchos[index];
                    const existencia = lineaData.data[index];

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="table__td">${linea}</td>
                        <td class="table__td">${gramaje}</td>
                        <td class="table__td">${ancho}</td>
                        <td class="table__td">${existencia}</td>
                    `;
                    tableBody.appendChild(row);
                });
            });
        }

        // Aplicar filtros
        function applyFilters() {
            const selectedGramaje = document.getElementById('filterGramaje').value;
            const selectedAncho = document.getElementById('filterAncho').value;

            const filteredData = JSON.parse(JSON.stringify(originalData));

            const tableBody = document.getElementById('dataTable').querySelector('tbody');
            tableBody.innerHTML = ''; // Limpiar contenido previo

            Object.keys(filteredData).forEach(linea => {
                const lineaData = filteredData[linea];

                lineaData.labels.forEach((label, index) => {
                    const gramaje = lineaData.gramajes[index];
                    const ancho = lineaData.anchos[index];
                    const existencia = lineaData.data[index];

                    if ((selectedGramaje === 'Todos' || gramaje == selectedGramaje) &&
                        (selectedAncho === 'Todos' || ancho == selectedAncho)) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${linea}</td>
                            <td>${gramaje}</td>
                            <td>${ancho}</td>
                            <td>${existencia}</td>
                        `;
                        tableBody.appendChild(row);
                    }
                });
            });
        }

        // Inicializar DataTables
        function initializeDataTable() {
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true
                });
            });
        }
    </script>
</body>
</html>
