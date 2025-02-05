<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<ul class="lista-areas-produccion">

    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> TOTAL EN STOCK :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-estatico" data-aos="fade-up">
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
            <i class="fas fa-scroll"></i> TOTAL  CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL  CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajamedium">
            <i class="fas fa-shopping-cart"></i> TOTAL  CAJA-MEDIUM :
            <?php if (isset($totalExistenciaM) && $totalExistenciaM > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> $ </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> 0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


<style>
    .grafica_dual {
        display: flex;
        flex-direction: 1fr 1fr;
        gap: 1rem;
    }

    .apexcharts-legend {
        max-height: 80px;
        overflow-y: auto;
    }

    .total-display {
        margin-top: 10px;
        font-weight: bold;
        font-size: 3rem;
    }
</style>

<div class="grafica_dual">
    <div class="graficas_blancas">
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
        <div id="chart" class="tamaño"></div>
    </div>
</div>

<div class="display">
    <div>
        <h2 class="titulo_existencia">Existencia (Corrugador)</h2>
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
        <div id="totalExistencia" class="total-display">Total de Existencia: 0</div>
    </div>
</div>

<script>
    (function() {
        const apiCorrugadorUrl = `${location.origin}/admin/api/apicorrugador`;
        let originalCorrugadorData = [];
        let chart;

        async function fetchData() {
            try {
                const corrugadorResponse = await fetch(apiCorrugadorUrl);
                originalCorrugadorData = await corrugadorResponse.json();

                populateFilters(originalCorrugadorData);
                renderChart(originalCorrugadorData);
                renderTable(originalCorrugadorData);
            } catch (error) {
                console.error("Error al obtener los datos de la API:", error);
            }
        }

        function populateFilters(corrugadorData) {
            // Limpiar opciones anteriores
            document.getElementById("filterGramaje").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterAncho").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterLinea").innerHTML = '<option value="all">Todos</option>';

            // Obtener conjuntos únicos de valores
            const gramajes = [...new Set(corrugadorData.map(item => item.gramaje))];
            const anchos = [...new Set(corrugadorData.map(item => item.ancho))];
            const lineas = [...new Set(corrugadorData.map(item => item.linea))];

            // Poblar selectores
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

            const lineaSelect = document.getElementById("filterLinea");
            lineas.forEach(linea => {
                const option = document.createElement("option");
                option.value = linea;
                option.textContent = linea;
                lineaSelect.appendChild(option);
            });
        }

        function filterData() {
            const selectedGramaje = document.getElementById("filterGramaje").value;
            const selectedAncho = document.getElementById("filterAncho").value;
            const selectedLinea = document.getElementById("filterLinea").value;

            let filteredCorrugador = originalCorrugadorData;

            if (selectedGramaje !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.gramaje === selectedGramaje);
            }
            if (selectedAncho !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.ancho === selectedAncho);
            }
            if (selectedLinea !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.linea === selectedLinea);
            }

            renderChart(filteredCorrugador);
            renderTable(filteredCorrugador);
        }

        function renderChart(data) {
            const gramajes = [...new Set(data.map(item => item.gramaje))].slice(0, 20);
            const anchos = [...new Set(data.map(item => item.ancho))].slice(0, 15);

            const series = anchos.map(ancho => ({
                name: `Ancho: ${ancho} mm`,
                data: gramajes.map(gramaje => {
                    const items = data.filter(item => item.ancho === ancho && item.gramaje === gramaje);
                    return items.reduce((sum, item) => sum + parseFloat(item.existencia), 0);
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
                        text: 'Existencias Totales',
                    },
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'center',
                    floating: false,
                    maxHeight: 80,
                    itemMargin: {
                        horizontal: 10,
                        vertical: 5,
                    },
                    formatter: function(seriesName) {
                        return seriesName.length > 20 ? seriesName.substring(0, 17) + '...' : seriesName;
                    },
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

        function renderTable(corrugadorData) {
            const corrugadorTable = $("#dataTable").DataTable();

            // Limpiar tabla
            corrugadorTable.clear();

            let totalExistencia = 0;

            // Llenar tabla de corrugador y calcular total de existencia
            corrugadorData.forEach(item => {
                totalExistencia += parseFloat(item.existencia || 0);
                corrugadorTable.row.add([
                    item.ancho,
                    item.gramaje,
                    item.linea,
                    item.existencia
                ]);
            });

            // Dibujar tabla
            corrugadorTable.draw();

            // Actualizar el total en el DOM
            document.getElementById("totalExistencia").textContent = `Total de Existencia: ${totalExistencia}`;
        }

        $(document).ready(() => {
            if (!$.fn.DataTable.isDataTable("#dataTable")) {
                $("#dataTable").DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
                    },
                });
            }

            fetchData();

            document.getElementById("filterGramaje").addEventListener("change", filterData);
            document.getElementById("filterAncho").addEventListener("change", filterData);
            document.getElementById("filterLinea").addEventListener("change", filterData);
        });
    })();
</script>

<style>
    .total-display {
        margin-top: 10px;
        font-weight: bold;
        font-size: 3rem;
    }

    #filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }
</style>

<div id="filters">
    <div>
        <label for="filterGramajeCorr">Filtrar por Gramaje:</label>
        <select id="filterGramajeCorr">
            <option value="all">Todos</option>
        </select>
    </div>
    <div>
        <label for="filterAnchoCorr">Filtrar por Ancho:</label>
        <select id="filterAnchoCorr">
            <option value="all">Todos</option>
        </select>
    </div>
    <div>
        <label for="filterLineaCorr">Filtrar por Línea:</label>
        <select id="filterLineaCorr">
            <option value="all">Todos</option>
        </select>
    </div>
</div>

<div class="display">
    <h2 class="titulo_existencia">Existencia (Corrugador)</h2>
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
    <div id="totalExistencia" class="total-display">Total de Existencia: 0</div>
</div>

<script>
    (function() {
        const apiCorrugadorUrl = `${location.origin}/admin/api/apiAnchossobrantes`;
        let originalCorrugadorData = [];

        async function fetchData() {
            try {
                const corrugadorResponse = await fetch(apiCorrugadorUrl);
                originalCorrugadorData = await corrugadorResponse.json();

                populateFilters(originalCorrugadorData);
                renderTable(originalCorrugadorData);
            } catch (error) {
                console.error("Error al obtener los datos de la API:", error);
            }
        }

        function populateFilters(corrugadorData) {
            // Limpiar opciones anteriores
            document.getElementById("filterGramajeCorr").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterAnchoCorr").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterLineaCorr").innerHTML = '<option value="all">Todos</option>';

            // Obtener conjuntos únicos de valores
            const gramajes = [...new Set(corrugadorData.map(item => item.gramaje))];
            const anchos = [...new Set(corrugadorData.map(item => item.ancho))];
            const lineas = [...new Set(corrugadorData.map(item => item.linea))];

            // Poblar selectores
            const gramajeSelect = document.getElementById("filterGramajeCorr");
            gramajes.forEach(gramaje => {
                const option = document.createElement("option");
                option.value = gramaje;
                option.textContent = gramaje;
                gramajeSelect.appendChild(option);
            });

            const anchoSelect = document.getElementById("filterAnchoCorr");
            anchos.forEach(ancho => {
                const option = document.createElement("option");
                option.value = ancho;
                option.textContent = ancho;
                anchoSelect.appendChild(option);
            });

            const lineaSelect = document.getElementById("filterLineaCorr");
            lineas.forEach(linea => {
                const option = document.createElement("option");
                option.value = linea;
                option.textContent = linea;
                lineaSelect.appendChild(option);
            });
        }

        function filterData() {
            const selectedGramaje = document.getElementById("filterGramajeCorr").value;
            const selectedAncho = document.getElementById("filterAnchoCorr").value;
            const selectedLinea = document.getElementById("filterLineaCorr").value;

            let filteredCorrugador = originalCorrugadorData;

            if (selectedGramaje !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.gramaje === selectedGramaje);
            }
            if (selectedAncho !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.ancho === selectedAncho);
            }
            if (selectedLinea !== "all") {
                filteredCorrugador = filteredCorrugador.filter(item => item.linea === selectedLinea);
            }

            renderTable(filteredCorrugador);
        }

        function renderTable(corrugadorData) {
            const corrugadorTable = $("#dataTable").DataTable();

            // Limpiar tabla
            corrugadorTable.clear();

            let totalExistencia = 0;

            // Llenar tabla de corrugador y calcular total de existencia
            corrugadorData.forEach(item => {
                totalExistencia += parseFloat(item.existencia || 0);
                corrugadorTable.row.add([
                    item.ancho,
                    item.gramaje,
                    item.linea,
                    item.existencia
                ]);
            });

            // Dibujar tabla
            corrugadorTable.draw();

            // Actualizar el total en el DOM
            document.getElementById("totalExistencia").textContent = `Total de Existencia: ${totalExistencia}`;
        }

        $(document).ready(() => {
            if (!$.fn.DataTable.isDataTable("#dataTable")) {
                $("#dataTable").DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
                    },
                });
            }

            fetchData();

            document.getElementById("filterGramajeCorr").addEventListener("change", filterData);
            document.getElementById("filterAnchoCorr").addEventListener("change", filterData);
            document.getElementById("filterLineaCorr").addEventListener("change", filterData);
        });
    })();
</script>
