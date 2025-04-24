<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>



<style>
    .item {
      background-color: #24292d;
      color: #f8f2f2;
      padding: 10px 15px;
      transition: all 0.5s;
    }
    
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    
    .item:nth-child(1), .item:nth-child(2), .item:nth-child(3), .item:nth-child(4), .item:nth-child(5) {
      width: 10%;
    }

    .item:hover {
      background-color: #ac5353;
      scale: 1.1;
      text-align: center;
    }

    .item a {
      color: inherit;
      text-decoration: none;
      display: block;
    }
    @media (min-width: 1024px) {
    .item:nth-child(1) {
      width: 20%;
    }
    
    .item:nth-child(2) {
      width: 20%;
    }
    
    .item:nth-child(3) {
      width: 20%;
    }
    
    .item:nth-child(4) {
      width: 20%;
    }
    
    .item:nth-child(5) {
      width: 20%;
    }
  }

</style>

<div class="container">
    <div class="item"><a href="/admin/produccion/materia/crear?id=8080"> <i class="fas fa-home"></i>INICIO</a></div>
    <div class="item"><a href="/admin/produccion/materia/corrugador/cajacraft"> <i class="fas fa-industry"></i> KRAFT</a></div>
  <div class="item"><a href="/admin/produccion/materia/microcorrugador/cajablanco"> <i class="fas fa-scroll"></i>BLANCO</a></div>
  <div class="item"><a href="/admin/produccion/materia/periodico/cajamedium">  <i class="fas fa-newspaper"></i> MEDIUM</a></div>
  <div class="item"><a href="/admin/produccion/materia/corrugador/cartonera/index">  <i class="fas fa-newspaper"></i> CARTOGAR</a></div>


</div>














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
 



</style>





<style>
       
        .display {
            display: flex;
            justify-content: center;
            align-items: center;
           
        }

        .containers {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 1rem;
            width: 80%;
            max-width: 600px;
            /* background-color: #e6e6e6; */
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        }

        .items {
            background-color:#cbd2d7;
            color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
        }

        /* Posiciones específicas de los elementos en la cuadrícula */
        .items:nth-child(1) {
            grid-area: 1 / 1 / 2 / 2; /* Fila 1, Columna 1 */
            width: 100%;
        }

        .items:nth-child(2) {
            grid-area: 1 / 2 / 2 / 3; /* Fila 1, Columna 2 */
        }

        .items:nth-child(3) {
            grid-area: 2 / 1 / 3 / 3; /* Fila 2, ocupa dos columnas */
        }

        .itemn {
            margin-top: 20px;
            background-color: #cbd2d7;
            color: #fff;
            border-radius: 10px;
            padding: 15px;
            font-size: 1.2rem;
            text-align: center;
            margin-left: 10rem;
            width: 100%;
            /* height: 100%; */
        }

        .nuevo {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            height: 20%;
        }
        label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #24292d;
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
    <div class="display">
        
        <div class="containers">
            <div class="items">
            <div id="chart1880" class="tamaño"></div>


            </div>
            <div class="items">
            <div id="chart1100" class="tamaño"></div>

            </div>
            <div class="items">
            <div id="totalExistencia" class="total-display">Total de Existencia: 0</div>

            </div> <!-- He corregido la numeración para mayor coherencia -->
        </div>
        <br><br><br>
        <div class="nuevo">
            <div class="itemn">
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








<style>

#filters-otros {
    display: flex;
    width: min(95%, 140rem);
    margin: 0 auto;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 2rem;
}
</style>




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