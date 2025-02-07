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
    .tablageneral {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        background-color: rgb(208, 212, 215);
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

    .grafica_dual {
        display: flex;
        justify-content: space-around;
        align-items: stretch;
        gap: 2rem;
        background-color: rgb(208, 212, 215);
        padding: 2rem;
        border-radius: 1rem;
        margin-bottom: 2rem;
    }

    .columna_filtros,
    .columna_graficas,
    .columna_tabla {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1;
        background-color: white;
        padding: 1rem;
        height: 50%;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    table {
        width: 100%;
        margin-top: 1rem;
    }

    .total-display {
        margin-top: 1rem;
        font-weight: bold;
        text-align: center;
    }


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

     .dataTables_wrapper .dataTables_filter {
    font-size: 1.2rem;
}

.tamaño {
    width: 300px;
    height: 300px;
}


#totalExistencia {
    position: fixed; /* Fijo para que siempre esté visible */
    top: 10px;      /* A 10px desde la parte superior */
    right: 10px;    /* A 10px desde la parte derecha */
    background-color: rgba(0, 0, 0, 0.7); /* Fondo semitransparente */
    color: white;   /* Texto en blanco */
    padding: 10px;  /* Espaciado interno */
    font-size: 18px; /* Tamaño de texto */
    z-index: 9999;  /* Aparecerá encima de todo */
    border-radius: 8px; /* Bordes redondeados */
}






</style>
<div id="filters">
    <div>
        <label for="filterGramaje">Filtrar por Gramaje (Gráficas):</label>
        <select id="filterGramaje">
            <option value="all">Todos</option>
        </select>
    </div>
    <div>
        <label for="filterAncho">Filtrar por Ancho (Tabla):</label>
        <select id="filterAncho">
            <option value="all">Todos</option>
        </select>
    </div>
    <div>
        <label for="filterLinea">Filtrar por Línea (Tabla):</label>
        <select id="filterLinea">
            <option value="all">Todos</option>
        </select>
    </div>
</div>
<div class="grafica_dual">
    <!-- Primera columna: Filtros -->
     
    <div class="columna_filtros">
        <h2 class="titulo_existencia">Gráfica 1</h2>

        <div id="chart1880" class="tamaño"></div>

    </div>

    <!-- Segunda columna: Gráficas -->
    <div class="columna_graficas">
        <h2 class="titulo_existencia">Gráfica 2</h2>

        <div id="chart1100" class="tamaño"></div>

        
    </div>
    
    <div id="totalExistencia" class="total-display">Total de Existencia: 0</div>


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
    </div>
</div>

<script>
    (function() {
        const apiCorrugadorUrl = `${location.origin}/admin/api/apicorrugador`;
        let originalCorrugadorData = [];

        async function fetchData() {
            try {
                const corrugadorResponse = await fetch(apiCorrugadorUrl);
                originalCorrugadorData = await corrugadorResponse.json();

                populateFilters(originalCorrugadorData);
                renderCharts(originalCorrugadorData);
                renderTable(originalCorrugadorData);
            } catch (error) {
                console.error("Error al obtener los datos de la API:", error);
            }
        }

        function populateFilters(corrugadorData) {
            document.getElementById("filterGramaje").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterAncho").innerHTML = '<option value="all">Todos</option>';
            document.getElementById("filterLinea").innerHTML = '<option value="all">Todos</option>';

            const gramajes = [...new Set(corrugadorData.map(item => item.gramaje))];
            const anchos = [...new Set(corrugadorData.map(item => item.ancho))];
            const lineas = [...new Set(corrugadorData.map(item => item.linea))];

            gramajes.forEach(gramaje => {
                const option = document.createElement("option");
                option.value = gramaje;
                option.textContent = gramaje;
                document.getElementById("filterGramaje").appendChild(option);
            });

            anchos.forEach(ancho => {
                const option = document.createElement("option");
                option.value = ancho;
                option.textContent = ancho;
                document.getElementById("filterAncho").appendChild(option);
            });

            lineas.forEach(linea => {
                const option = document.createElement("option");
                option.value = linea;
                option.textContent = linea;
                document.getElementById("filterLinea").appendChild(option);
            });
        }

        function filterDataForCharts() {
            const selectedGramaje = document.getElementById("filterGramaje").value;
            let filteredData = originalCorrugadorData;

            if (selectedGramaje !== "all") {
                filteredData = filteredData.filter(item => item.gramaje === selectedGramaje);
            }

            renderCharts(filteredData);
        }

        function filterDataForTable() {
            const selectedAncho = document.getElementById("filterAncho").value;
            const selectedLinea = document.getElementById("filterLinea").value;

            let filteredData = originalCorrugadorData;

            if (selectedAncho !== "all") {
                filteredData = filteredData.filter(item => item.ancho === selectedAncho);
            }
            if (selectedLinea !== "all") {
                filteredData = filteredData.filter(item => item.linea === selectedLinea);
            }

            renderTable(filteredData);
        }

        let chart1100Instance = null;
        let chart1880Instance = null;

        function renderCharts(data) {
            // Filtrar los datos por cada ancho
            const data1100 = data.filter(item => item.ancho == 1100);
            const data1880 = data.filter(item => item.ancho == 1880);

            // Agrupar existencias por gramaje
            const grouped1100 = data1100.reduce((acc, item) => {
                acc[item.gramaje] = (acc[item.gramaje] || 0) + parseFloat(item.existencia);
                return acc;
            }, {});

            const grouped1880 = data1880.reduce((acc, item) => {
                acc[item.gramaje] = (acc[item.gramaje] || 0) + parseFloat(item.existencia);
                return acc;
            }, {});

            // Destruir gráficos anteriores si existen
            if (chart1100Instance) {
                chart1100Instance.destroy();
            }
            if (chart1880Instance) {
                chart1880Instance.destroy();
            }

            // Configurar gráficos
            const options1100 = {
                series: Object.values(grouped1100),
                chart: {
                    type: 'pie',
                    height: 400
                },
                labels: Object.keys(grouped1100).map(g => `${g}g`),
                title: {
                    text: 'Ancho 1100',
                    align: 'center'
                },
                dataLabels: {
                    enabled: true
                },
            };

            const options1880 = {
                series: Object.values(grouped1880),
                chart: {
                    type: 'pie',
                    height: 400
                },
                labels: Object.keys(grouped1880).map(g => `${g}g`),
                title: {
                    text: 'Ancho 1880',
                    align: 'center'
                },
                dataLabels: {
                    enabled: true
                },
            };

            // Renderizar gráficos nuevos
            chart1100Instance = new ApexCharts(document.querySelector("#chart1100"), options1100);
            chart1880Instance = new ApexCharts(document.querySelector("#chart1880"), options1880);

            chart1100Instance.render();
            chart1880Instance.render();
        }



        function renderTable(data) {
            const table = $("#dataTable").DataTable();
            table.clear();

            let totalExistencia = 0;
            data.forEach(item => {
                totalExistencia += parseFloat(item.existencia || 0);
                table.row.add([item.ancho, item.gramaje, item.linea, item.existencia]);
            });

            table.draw();
            document.getElementById("totalExistencia").textContent = `Total de Existencia: ${totalExistencia}`;
        }

        $(document).ready(() => {
            $("#dataTable").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
            });

            fetchData();

            document.getElementById("filterGramaje").addEventListener("change", filterDataForCharts);
            document.getElementById("filterAncho").addEventListener("change", filterDataForTable);
            document.getElementById("filterLinea").addEventListener("change", filterDataForTable);
        });
    })();
</script>













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