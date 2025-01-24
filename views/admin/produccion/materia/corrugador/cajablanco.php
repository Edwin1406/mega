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
    <title>Tabla Interactiva con Clases Personalizadas</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="URL_DE_TU_CSS_PERSONALIZADO"> <!-- Reemplaza con la ruta a tu archivo CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
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
    </style>
</head>
<body>
    <div class="dashboard__contenedor">
        <div class="filters">
            <label for="filterGramaje">Filtrar por Gramaje:</label>
            <select id="filterGramaje" class="filter__select">
                <option value="Todos">Todos</option>
            </select>

            <label for="filterAncho">Filtrar por Ancho:</label>
            <select id="filterAncho" class="filter__select">
                <option value="Todos">Todos</option>
            </select>
        </div>

        <table class="table" id="dataTable">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Línea</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Existencias</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <!-- Contenido dinámico -->
            </tbody>
        </table>
    </div>

    <script>
        const apiUrl = 'URL_DE_TU_API'; // Reemplaza con la URL real de tu API

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
            const tableBody = document.querySelector('#dataTable .table__tbody');
            tableBody.innerHTML = ''; // Limpiar contenido previo

            Object.keys(data).forEach(linea => {
                const lineaData = data[linea];

                lineaData.labels.forEach((label, index) => {
                    const gramaje = lineaData.gramajes[index];
                    const ancho = lineaData.anchos[index];
                    const existencia = lineaData.data[index];

                    const row = document.createElement('tr');
                    row.classList.add('table__tr');
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

            const tableBody = document.querySelector('#dataTable .table__tbody');
            tableBody.innerHTML = ''; // Limpiar contenido previo

            Object.keys(originalData).forEach(linea => {
                const lineaData = originalData[linea];

                lineaData.labels.forEach((label, index) => {
                    const gramaje = lineaData.gramajes[index];
                    const ancho = lineaData.anchos[index];
                    const existencia = lineaData.data[index];

                    if ((selectedGramaje === 'Todos' || gramaje == selectedGramaje) &&
                        (selectedAncho === 'Todos' || ancho == selectedAncho)) {
                        const row = document.createElement('tr');
                        row.classList.add('table__tr');
                        row.innerHTML = `
                            <td class="table__td">${linea}</td>
                            <td class="table__td">${gramaje}</td>
                            <td class="table__td">${ancho}</td>
                            <td class="table__td">${existencia}</td>
                        `;
                        tableBody.appendChild(row);
                    }
                });
            });

            // Actualizar DataTables
            $('#dataTable').DataTable().clear().destroy(); // Limpiar configuración previa
            initializeDataTable();
        }

        // Inicializar DataTables
        function initializeDataTable() {
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    language: {
                        lengthMenu: "Mostrar _MENU_ registros por página",
                        zeroRecords: "No se encontraron resultados",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "No hay registros disponibles",
                        infoFiltered: "(filtrado de _MAX_ registros totales)",
                        search: "Buscar:",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "Siguiente",
                            previous: "Anterior"
                        },
                    }
                });
            });
        }
    </script>
</body>
</html>
