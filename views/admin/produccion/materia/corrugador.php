<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<ul class="lista-areas-produccion">
   
    <li class="areas-produccion-estatico">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-estatico">
        <a>
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO :
            <?php if ($totalCosto > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCosto ?> $ </span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-estatico">
        <a>
            <i class="fa-solid fa-calendar"> </i> TIEMPO PROMEDIO DE ROTACIÓN :
            <?php if ($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?>
        </a>
    </li>
</ul>





<ul class="lista-areas-produccion">



    <li class="areas-produccion-craft">
        <a href="/admin/produccion/materia/corrugador/cajacraft">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium">
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






<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Existencias</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 2.5rem;
            font-weight: 600;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        #chart {
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }

        table thead th {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        table tbody td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .chart-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .chart-card .title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .filters {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filters div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .filters label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }

        .filters select {
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
            width: 150px;
            transition: all 0.3s ease;
        }

        .filters select:hover {
            border-color: #4CAF50;
            background-color: #f1fdf1;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="filters">
            <div>
                <label for="filterGramaje">Filtrar por Gramaje:</label>
                <select id="filterGramaje">
                    <option value="">Todos</option>
                </select>
            </div>

            <div>
                <label for="filterAncho">Filtrar por Ancho:</label>
                <select id="filterAncho">
                    <option value="">Todos</option>
                </select>
            </div>
        </div>

        <div class="chart-card">
            <div class="title">Existencias por Línea y Gramaje/Ancho</div>
            <div id="chart"></div>
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Línea</th>
                        <th>Gramaje</th>
                        <th>Ancho</th>
                        <th>Existencias</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas de datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let chart; // Variable para el gráfico
        let originalData = {}; // Datos originales desde el backend

        // Cargar datos desde el backend
        async function loadData() {
            try {
                const response = await fetch('https://megawebsistem.com/admin/api/apicorrugador'); // Cambia a la ruta correcta de tu API
                if (!response.ok) throw new Error('Error al cargar datos');
                originalData = await response.json();
                initializeFilters(originalData);
                renderChart(originalData);
                renderTable(originalData);
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un error al cargar los datos. Por favor, intenta de nuevo.');
            }
        }

        // Inicializar los filtros con valores únicos
        function initializeFilters(data) {
            const gramajes = new Set();
            const anchos = new Set();

            Object.values(data).forEach(linea => {
                linea.gramajes.forEach(g => gramajes.add(g));
                linea.anchos.forEach(a => anchos.add(a));
            });

            populateFilter('filterGramaje', Array.from(gramajes));
            populateFilter('filterAncho', Array.from(anchos));
        }

        // Llenar los selectores con opciones
        function populateFilter(filterId, values) {
            const select = document.getElementById(filterId);
            values.forEach(value => {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value;
                select.appendChild(option);
            });
        }

        // Renderizar la gráfica
        function renderChart(data) {
            const series = Object.keys(data).map(linea => ({
                name: linea,
                data: data[linea].data
            }));

            const labels = Object.keys(data).flatMap(linea => data[linea].labels);
            const uniqueLabels = [...new Set(labels)];

            const options = {
                series: series,
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: uniqueLabels,
                    labels: {
                        formatter: function (value) {
                            return value || "Sin Datos";
                        }
                    }
                },
                title: {
                    text: 'Existencias por Línea y Gramaje/Ancho',
                    align: 'center'
                },
                colors: ['#1E90FF', '#28B463', '#F39C12']
            };

            if (chart) chart.destroy();
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        // Renderizar la tabla
        function renderTable(data) {
            const tbody = document.querySelector("#data-table tbody");
            tbody.innerHTML = ""; // Limpiar tabla

            Object.keys(data).forEach(linea => {
                data[linea].labels.forEach((label, index) => {
                    const row = document.createElement("tr");

                    row.appendChild(createTableCell(linea));
                    row.appendChild(createTableCell(data[linea].gramajes[index] || "Sin Datos"));
                    row.appendChild(createTableCell(data[linea].anchos[index] || "Sin Datos"));
                    row.appendChild(createTableCell(data[linea].data[index] || 0));

                    tbody.appendChild(row);
                });
            });
        }

        // Crear una celda de tabla
        function createTableCell(content) {
            const cell = document.createElement("td");
            cell.textContent = content;
            return cell;
        }

        // Aplicar filtros dinámicos
        document.getElementById('filterGramaje').addEventListener('change', applyFilters);
        document.getElementById('filterAncho').addEventListener('change', applyFilters);

        function applyFilters() {
            const selectedGramaje = document.getElementById('filterGramaje').value;
            const selectedAncho = document.getElementById('filterAncho').value;

            const filteredData = Object.keys(originalData).reduce((acc, linea) => {
                const filtered = originalData[linea].labels
                    .map((label, index) => ({
                        label,
                        gramaje: originalData[linea].gramajes[index],
                        ancho: originalData[linea].anchos[index],
                        data: originalData[linea].data[index]
                    }))
                    .filter(item =>
                        (selectedGramaje === '' || item.gramaje == selectedGramaje) &&
                        (selectedAncho === '' || item.ancho == selectedAncho)
                    );

                if (filtered.length > 0) {
                    acc[linea] = {
                        labels: filtered.map(item => item.label),
                        data: filtered.map(item => item.data),
                        gramajes: filtered.map(item => item.gramaje),
                        anchos: filtered.map(item => item.ancho)
                    };
                }

                return acc;
            }, {});

            renderChart(filteredData);
            renderTable(filteredData);
        }

        // Iniciar la carga de datos
        loadData();
    </script>
</body>

</html>





<title>Comparación de Coincidencias con Filtros</title>
    <style>
        #tabla-coincidencias {
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: left;
            border-collapse: collapse;
        }

        #tabla-coincidencias th, #tabla-coincidencias td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        #tabla-coincidencias tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #tabla-coincidencias th {
            background-color: #4CAF50;
            color: white;
        }

        .filtros {
            margin-bottom: 20px;
        }

        .filtros label {
            margin-right: 10px;
        }

        .filtros select {
            padding: 5px;
            margin-right: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .sin-datos {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>

   

    <table id="tabla-coincidencias">
        <thead>
            <tr>
                <th>Gramaje</th>
                <th>Ancho</th>
                <th>Descripción Corrugador</th>
                <th>Descripción Comercial</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="4" class="sin-datos">Cargando datos...</td></tr>
        </tbody>
    </table>

    <script>
        let todasLasCoincidencias = [];

        // Función para obtener datos de la API de corrugador
        async function apicorru() {
            try {
                const url = "https://megawebsistem.com/admin/api/apicorrugador2";
                const resultado = await fetch(url);
                return await resultado.json();
            } catch (e) {
                console.error("Error en apicorru:", e);
                return [];
            }
        }

        // Función para obtener datos de la API comercial
        async function apicomercial() {
            try {
                const url = "https://megawebsistem.com/admin/api/apicomercial";
                const resultado = await fetch(url);
                return await resultado.json();
            } catch (e) {
                console.error("Error en apicomercial:", e);
                return [];
            }
        }

        // Función para cargar los valores de filtro dinámicamente
        async function cargarFiltros() {
            const corru = await apicorru();

            // Extraer gramajes y anchos únicos
            const gramajesUnicos = [...new Set(corru.map(item => item.gramaje))];
            const anchosUnicos = [...new Set(corru.map(item => item.ancho))];

            // Llenar el select de gramaje
            const selectGramaje = document.getElementById("filterGramaje");
            gramajesUnicos.forEach(gramaje => {
                const option = document.createElement("option");
                option.value = gramaje;
                option.textContent = gramaje;
                selectGramaje.appendChild(option);
            });

            // Llenar el select de ancho
            const selectAncho = document.getElementById("filterAncho");
            anchosUnicos.forEach(ancho => {
                const option = document.createElement("option");
                option.value = ancho;
                option.textContent = ancho;
                selectAncho.appendChild(option);
            });
        }

        // Función para procesar y comparar los datos de ambas APIs
        async function desgloza() {
            const corru = await apicorru();
            const comercial = await apicomercial();

            todasLasCoincidencias = [];

            corru.forEach(corrugador => {
                const { gramaje, ancho, descripcion: descCorru = "Sin descripción" } = corrugador;

                // Busca registros en comercial donde el gramaje y el ancho coincidan
                const match = comercial.find(com => 
                    Number(com.gramaje) === Number(gramaje) && 
                    Number(com.ancho) === Number(ancho)
                );

                if (match) {
                    todasLasCoincidencias.push({
                        gramaje,
                        ancho,
                        descCorru,
                        descComercial: match.producto || "Sin descripción"
                    });
                }
            });

            mostrarTabla(todasLasCoincidencias);
        }

        // Función para mostrar las coincidencias en la tabla
        function mostrarTabla(coincidencias) {
            const tabla = document.getElementById("tabla-coincidencias");
            const tbody = tabla.querySelector("tbody");

            tbody.innerHTML = ""; // Limpiar contenido previo

            if (coincidencias.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="sin-datos">No se encontraron coincidencias</td></tr>`;
                return;
            }

            coincidencias.forEach(({ gramaje, ancho, descCorru, descComercial }) => {
                const fila = `
                    <tr>
                        <td>${gramaje}</td>
                        <td>${ancho}</td>
                        <td>${descCorru}</td>
                        <td>${descComercial}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }

        // Función para aplicar los filtros
        function aplicarFiltros() {
            const filtroGramaje = document.getElementById("filterGramaje").value;
            const filtroAncho = document.getElementById("filterAncho").value;

            let resultadosFiltrados = todasLasCoincidencias;

            if (filtroGramaje) {
                resultadosFiltrados = resultadosFiltrados.filter(item => Number(item.gramaje) === Number(filtroGramaje));
            }

            if (filtroAncho) {
                resultadosFiltrados = resultadosFiltrados.filter(item => Number(item.ancho) === Number(filtroAncho));
            }

            mostrarTabla(resultadosFiltrados);
        }

        // Escucha de eventos para los filtros
        document.getElementById("filterGramaje").addEventListener("change", aplicarFiltros);
        document.getElementById("filterAncho").addEventListener("change", aplicarFiltros);

        // Ejecutar las funciones al cargar la página
        document.addEventListener("DOMContentLoaded", async () => {
            await cargarFiltros();
            await desgloza();
        });
    </script>
