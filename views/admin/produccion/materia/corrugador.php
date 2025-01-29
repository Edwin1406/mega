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

        .sin-datos {
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Filtros -->
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

        <!-- Gráfica -->
        <div class="chart-card">
            <div class="title">Existencias por Línea y Gramaje/Ancho</div>
            <div id="chart"></div>
        </div>

        <!-- Tabla de datos original -->
        <div class="chart-card">
            <div class="title">Datos Generales</div>
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
                    <tr><td colspan="4" class="sin-datos">Cargando datos...</td></tr>
                </tbody>
            </table>
        </div>

        <!-- Tabla de coincidencias -->
        <div class="chart-card">
            <div class="title">Coincidencias</div>
            <table id="tabla-coincidencias">
                <thead>
                    <tr>
                        <th>Gramaje</th>
                        <th>Ancho</th>
                        <th>Descripción Corrugador</th>
                        <th>Descripción Comercial</th>
                        <th>Cantidad</th>
                        <th>Fecha de Producción</th>
                        <th>Ets</th>
                        <th>Eta</th>
                        <th>Arribo planta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="9" class="sin-datos">Cargando datos...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let chart;
        let todasLasCoincidencias = [];
        let originalData = {};

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

        async function cargarFiltros() {
            const corru = await apicorru();
            const comercial = await apicomercial();

            todasLasCoincidencias = [];
            const gramajes = new Set();
            const anchos = new Set();

            corru.forEach(corrugador => {
                const { gramaje, ancho, descripcion: descCorru = "Sin descripción" } = corrugador;

                const match = comercial.find(com =>
                    Number(com.gramaje) === Number(gramaje) &&
                    Number(com.ancho) === Number(ancho)
                );

                if (match) {
                    todasLasCoincidencias.push({
                        gramaje,
                        ancho,
                        descCorru,
                        descComercial: match.linea || match.producto || "Sin descripción",
                        cantidad: match.cantidad || "No especificada",
                        fecha_produccion: match.fecha_produccion || "No especificada",
                        ets: match.ets || "No especificada",
                        eta: match.eta || "No especificada",
                        arribo_planta: match.arribo_planta || "No especificada"
                    });

                    gramajes.add(gramaje);
                    anchos.add(ancho);
                }
            });

            populateFilter('filterGramaje', Array.from(gramajes));
            populateFilter('filterAncho', Array.from(anchos));

            mostrarTabla(todasLasCoincidencias, "tabla-coincidencias");
            renderChart(todasLasCoincidencias);
        }

        function populateFilter(filterId, values) {
            const select = document.getElementById(filterId);
            select.innerHTML = '<option value="">Todos</option>';
            values.forEach(value => {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value;
                select.appendChild(option);
            });
        }

        function mostrarTabla(datos, tablaId) {
            const tbody = document.querySelector(`#${tablaId} tbody`);
            tbody.innerHTML = "";

            if (datos.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="sin-datos">No se encontraron datos</td></tr>`;
                return;
            }

            datos.forEach(item => {
                const fila = `
                    <tr>
                        <td>${item.gramaje}</td>
                        <td>${item.ancho}</td>
                        <td>${item.descCorru || item.linea || "Sin descripción"}</td>
                        <td>${item.descComercial || "Sin descripción"}</td>
                        <td>${item.cantidad || 0}</td>
                        <td>${item.fecha_produccion || "No especificada"}</td>
                        <td>${item.ets || "No especificada"}</td>
                        <td>${item.eta || "No especificada"}</td>
                        <td>${item.arribo_planta || "No especificada"}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }

        function renderChart(coincidencias) {
            const datosPorLinea = coincidencias.reduce((acc, item) => {
                if (!acc[item.descComercial]) {
                    acc[item.descComercial] = { labels: [], data: [] };
                }
                acc[item.descComercial].labels.push(`${item.gramaje} - ${item.ancho}`);
                acc[item.descComercial].data.push(Number(item.cantidad) || 0);
                return acc;
            }, {});

            const series = Object.keys(datosPorLinea).map(linea => ({
                name: linea,
                data: datosPorLinea[linea].data
            }));

            const labels = [...new Set(coincidencias.map(item => `${item.gramaje} - ${item.ancho}`))];

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
                    categories: labels,
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

            mostrarTabla(resultadosFiltrados, "tabla-coincidencias");
            renderChart(resultadosFiltrados);
        }

        document.getElementById("filterGramaje").addEventListener("change", aplicarFiltros);
        document.getElementById("filterAncho").addEventListener("change", aplicarFiltros);

        document.addEventListener("DOMContentLoaded", cargarFiltros);
    </script>
</body>

</html>
