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
            <i class="fas fa-scroll"></i> TOTAL CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajamedium">
            <i class="fas fa-shopping-cart"></i> TOTAL CAJA-MEDIUM :
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
    justify-content: center;
    align-items: flex-start;
    gap: 2rem;
    background-color: rgb(214, 234, 248);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

#filters {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

#filters div {
    flex: 1;
}

.graficas_blancas {
    margin-bottom: 1rem;
}

table {
    width: 100%;
}


</style>




<style>
    .tablageneral {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        background-color: rgb(214, 234, 248);
        padding: 1rem;
        border-radius: 0.5rem;
        width: 100%;
        margin: auto;
    }

    .tablaotro {
        padding: 1rem;
    }

    /* #filters-otros label {
        font-size: 0.9rem;
    } */

    /* #filters-otros select {
        font-size: 0.9rem;
        padding: 0.2rem;
        margin-bottom: 0.5rem;
    } */

    h2.titulo_existencia {
        font-size: 1.2rem;
        text-align: center;
    }

    #dataTableOtros {
        width: 100%;
        font-size: 1rem;
        border-collapse: collapse;
    }

    #dataTableOtros th,
    #dataTableOtros td {
        border: 1px solid #ccc;
        padding: 0.5rem;
        text-align: center;
    }

    table.dataTable tbody th,
    table.dataTable tbody td,
    th.sorting {
        font-size: 1.5rem;
    }
</style>

<div class="grafica_dual">
    <!-- Primera columna: Filtros -->
    <div class="columna_filtros">
        <h2 class="titulo_existencia">Filtros</h2>
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
    </div>

    <!-- Segunda columna: Gráficas -->
    <div class="columna_graficas">
        <h2 class="titulo_existencia">Gráficas</h2>
        <div class="graficas_blancas">
            <div id="chart1880" class="tamaño"></div>
            <div id="chart1100" class="tamaño"></div>
        </div>
    </div>

    <!-- Tercera columna: Tabla -->
    <div class="columna_tabla">
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











<div class="tablageneral">
    <div class="tablaotro">
        <div id="filters-otros" class="filters">
            <div>
                <label for="filterGramajeOtros">Filtrar por Gramaje:</label>
                <select id="filterGramajeOtros">
                    <option value="all">Todos</option>
                </select>
            </div>
            <div>
                <label for="filterAnchoOtros">Filtrar por Ancho:</label>
                <select id="filterAnchoOtros">
                    <option value="all">Todos</option>
                </select>
            </div>
            <div>
                <label for="filterLineaOtros">Filtrar por Línea:</label>
                <select id="filterLineaOtros">
                    <option value="all">Todos</option>
                </select>
            </div>
        </div>
        <h2 class="titulo_existencia">Existencia (Otros Anchos)</h2>
        <table id="dataTableOtros">
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
        <div id="totalExistenciaOtros" class="total-display1">Total de Existencia: 0</div>
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
            // Filtrar los datos por cada ancho
            const data1880 = data.filter(item => item.ancho == 1880);
            const data1100 = data.filter(item => item.ancho == 1100);

            // Agrupar existencias por gramaje para el ancho 1880
            const grouped1880 = data1880.reduce((acc, item) => {
                if (!item.gramaje || !item.existencia) return acc;
                acc[item.gramaje] = (acc[item.gramaje] || 0) + parseFloat(item.existencia);
                return acc;
            }, {});

            // Agrupar existencias por gramaje para el ancho 1100
            const grouped1100 = data1100.reduce((acc, item) => {
                if (!item.gramaje || !item.existencia) return acc;
                acc[item.gramaje] = (acc[item.gramaje] || 0) + parseFloat(item.existencia);
                return acc;
            }, {});

            // Obtener categorías y valores para cada gráfico
            const gramajes1880 = Object.keys(grouped1880);
            const existencias1880 = Object.values(grouped1880);

            const gramajes1100 = Object.keys(grouped1100);
            const existencias1100 = Object.values(grouped1100);

            // Verificar que haya datos para los gráficos
            if (gramajes1880.length === 0 || gramajes1100.length === 0) {
                console.warn("No hay datos disponibles para mostrar en los gráficos.");
                return;
            }

            // Configurar gráfico de pastel para ancho 1880
            const options1880 = {
                series: existencias1880,
                chart: {
                    type: 'pie',
                    height: 400,
                },
                labels: gramajes1880.map(g => `${g}g`),
                legend: {
                    position: 'top',
                },
                title: {
                    text: 'Ancho 1880',
                    align: 'center',
                },
                dataLabels: {
                    enabled: true,
                },
            };

            // Configurar gráfico de pastel para ancho 1100
            const options1100 = {
                series: existencias1100,
                chart: {
                    type: 'pie',
                    height: 400,
                },
                labels: gramajes1100.map(g => `${g}g`),
                legend: {
                    position: 'top',
                },
                title: {
                    text: 'Ancho 1100',
                    align: 'center',
                },
                dataLabels: {
                    enabled: true,
                },
            };

            // Renderizar ambos gráficos
            const chart1880 = new ApexCharts(document.querySelector("#chart1880"), options1880);
            const chart1100 = new ApexCharts(document.querySelector("#chart1100"), options1100);

            chart1880.render();
            chart1100.render();
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
        font-size: 2rem;
    }

    .total-display1 {
        margin-top: 10px;
        font-weight: bold;
        font-size: 2rem;
    }



    #filters-otros {
        display: flex;
        gap: 1rem;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }
</style>

<script>
    (function() {
        const apiOtrosAnchosUrl = "https://megawebsistem.com/admin/api/apiAnchossobrantes";

        console.log(apiOtrosAnchosUrl);
        let originalOtrosData = [];

        async function fetchDataOtros() {
            try {
                const otrosResponse = await fetch(apiOtrosAnchosUrl);
                originalOtrosData = await otrosResponse.json();

                populateFiltersOtros(originalOtrosData);
                renderTableOtros(originalOtrosData);
            } catch (error) {
                console.error("Error al obtener los datos de la API:", error);
            }
        }

        function populateFiltersOtros(otrosData) {
            // Limpiar opciones anteriores
            document.getElementById("filterGramajeOtros").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterAnchoOtros").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterLineaOtros").innerHTML = '<option value="all">Todos</option>';

            // Obtener conjuntos únicos de valores
            const gramajes = [...new Set(otrosData.map(item => item.gramaje))];
            const anchos = [...new Set(otrosData.map(item => item.ancho))];
            const lineas = [...new Set(otrosData.map(item => item.linea))];

            // Poblar selectores
            const gramajeSelect = document.getElementById("filterGramajeOtros");
            gramajes.forEach(gramaje => {
                const option = document.createElement("option");
                option.value = gramaje;
                option.textContent = gramaje;
                gramajeSelect.appendChild(option);
            });

            const anchoSelect = document.getElementById("filterAnchoOtros");
            anchos.forEach(ancho => {
                const option = document.createElement("option");
                option.value = ancho;
                option.textContent = ancho;
                anchoSelect.appendChild(option);
            });

            const lineaSelect = document.getElementById("filterLineaOtros");
            lineas.forEach(linea => {
                const option = document.createElement("option");
                option.value = linea;
                option.textContent = linea;
                lineaSelect.appendChild(option);
            });
        }

        function filterDataOtros() {
            const selectedGramaje = document.getElementById("filterGramajeOtros").value;
            const selectedAncho = document.getElementById("filterAnchoOtros").value;
            const selectedLinea = document.getElementById("filterLineaOtros").value;

            let filteredOtros = originalOtrosData;

            if (selectedGramaje !== "all") {
                filteredOtros = filteredOtros.filter(item => item.gramaje === selectedGramaje);
            }
            if (selectedAncho !== "all") {
                filteredOtros = filteredOtros.filter(item => item.ancho === selectedAncho);
            }
            if (selectedLinea !== "all") {
                filteredOtros = filteredOtros.filter(item => item.linea === selectedLinea);
            }

            renderTableOtros(filteredOtros);
        }

        function renderTableOtros(otrosData) {
            const otrosTable = $("#dataTableOtros").DataTable();

            // Limpiar tabla
            otrosTable.clear();

            let totalExistencia = 0;

            // Llenar tabla y calcular total de existencia
            otrosData.forEach(item => {
                totalExistencia += parseFloat(item.existencia || 0);
                otrosTable.row.add([
                    item.ancho,
                    item.gramaje,
                    item.linea,
                    item.existencia
                ]);
            });

            // Dibujar tabla
            otrosTable.draw();

            // Actualizar el total en el DOM
            document.getElementById("totalExistenciaOtros").textContent = `Total de Existencia: ${totalExistencia}`;
        }

        $(document).ready(() => {
            if (!$.fn.DataTable.isDataTable("#dataTableOtros")) {
                $("#dataTableOtros").DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
                    },
                });
            }

            fetchDataOtros();

            document.getElementById("filterGramajeOtros").addEventListener("change", filterDataOtros);
            document.getElementById("filterAnchoOtros").addEventListener("change", filterDataOtros);
            document.getElementById("filterLineaOtros").addEventListener("change", filterDataOtros);
        });
    })();
</script>