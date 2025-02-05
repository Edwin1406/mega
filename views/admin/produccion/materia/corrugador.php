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
    justify-content: center; /* Centrar horizontalmente */
    align-items: center; /* Centrar verticalmente si es necesario */
    gap: 2rem; /* Espacio entre los elementos */
    background-color: rgb(214, 234, 248);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.graficas_blancas, table {
    flex: 1; /* Para que ambos elementos ocupen el mismo espacio */
    text-align: center; /* Opcional: centrar el contenido interno */
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

    #dataTableOtros th, #dataTableOtros td {
        border: 1px solid #ccc;
        padding: 0.5rem;
        text-align: center;
    }

    table.dataTable tbody th, table.dataTable tbody td ,th.sorting{
    font-size: 1.5rem;
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


    <div>
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