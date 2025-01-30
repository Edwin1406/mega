<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<ul class="lista-areas-produccion">
   
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-estatico"  data-aos="fade-up">
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
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-KRAFT :
            <?php if ($totalExistenciaK > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaK ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco"data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador/cajablanco">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA CAJA-BLANCO :
            <?php if ($totalExistenciaB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaB ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
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



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>




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

<div class="graficas_blancas">
    <div id="chart" class="tamaño"></div>
</div>

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

<div>
    <h2 class="titulo_pedido">Pedidos (Comercial)</h2>
    <table id="comercialTable" class="dataTables">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Ancho (mm)</th>
                <th>Gramaje (g/m²)</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Arribo Planta </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Mantenemos el mismo HTML para estructura -->
<script>
(function () {
    const apiComercialUrl = `${location.origin}/admin/api/apicomercial`;
    const apiCorrugadorUrl = `${location.origin}/admin/api/apicorrugador`;
    let originalComercialData = [];
    let originalCorrugadorData = [];
    let chart;

    // Cache de elementos DOM
    const DOM = {
        filterGramaje: document.getElementById("filterGramaje"),
        filterAncho: document.getElementById("filterAncho"),
        filterLinea: document.getElementById("filterLinea"),
        chart: document.querySelector("#chart"),
        dataTable: document.getElementById("dataTable"),
        comercialTable: document.getElementById("comercialTable")
    };

    // Configuración reutilizable
    const config = {
        dataTableOptions: {
            language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" },
            autoWidth: false,
            responsive: true
        },
        chartOptions: {
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
                toolbar: { show: true }
            },
            plotOptions: { bar: { horizontal: false, borderRadius: 4 } },
            dataLabels: { enabled: true },
            legend: { position: 'top' },
            fill: { opacity: 1 }
        }
    };

    async function fetchData() {
        try {
            const [comercial, corrugador] = await Promise.all([
                fetch(apiComercialUrl).then(res => res.json()),
                fetch(apiCorrugadorUrl).then(res => res.json())
            ]);
            
            originalComercialData = comercial;
            originalCorrugadorData = corrugador;

            populateFilters(comercial, corrugador);
            initDataTables();
            updateVisualization();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    // function populateFilters(comercialData, corrugadorData) {
    //     const getUnique = (data, key) => [...new Set(data.map(item => item[key]))];
        
    //     const addOptions = (select, values) => {
    //         const fragment = document.createDocumentFragment();
    //         values.forEach(value => {
    //             const option = document.createElement("option");
    //             option.value = value;
    //             option.textContent = value;
    //             fragment.appendChild(option);
    //         });
    //         select.appendChild(fragment);
    //     };

    //     addOptions(DOM.filterGramaje, ['all', ...getUnique([...comercialData, ...corrugadorData], 'gramaje')]);
    //     addOptions(DOM.filterAncho, ['all', ...getUnique([...comercialData, ...corrugadorData], 'ancho')]);
    //     addOptions(DOM.filterLinea, ['all', ...getUnique(corrugadorData, 'linea')]);
    // }

    function populateFilters(comercialData, corrugadorData) {
    const getUniqueValidValues = (data, key) => {
        // Filtrar valores numéricos y excluir 'all' y 'todos'
        return [...new Set(data.map(item => item[key]))]
            .filter(value => !isNaN(value) && value !== 'all' && value !== 'todos')
            .sort((a, b) => a - b);
    };

    const addOptions = (select, values) => {
        const fragment = document.createDocumentFragment();
        
        // Opción "Todos" inicial
        const defaultOption = document.createElement("option");
        defaultOption.value = "all"; // Valor interno
        defaultOption.textContent = "Todos"; // Etiqueta visible
        fragment.appendChild(defaultOption);

        // Agregar valores numéricos
        values.forEach(value => {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = value;
            fragment.appendChild(option);
        });
        
        select.replaceChildren(fragment); // Reemplazar todo el contenido
    };

    // Obtener valores únicos y válidos
    const gramajes = getUniqueValidValues([...comercialData, ...corrugadorData], 'gramaje');
    const anchos = getUniqueValidValues([...comercialData, ...corrugadorData], 'ancho');
    const lineas = getUniqueValidValues(corrugadorData, 'linea');

    // Poblar los selectores
    addOptions(DOM.filterGramaje, gramajes);
    addOptions(DOM.filterAncho, anchos);
    addOptions(DOM.filterLinea, lineas);
}
    function initDataTables() {
        if ($.fn.DataTable.isDataTable(DOM.dataTable)) {
            $(DOM.dataTable).DataTable().destroy();
        }
        if ($.fn.DataTable.isDataTable(DOM.comercialTable)) {
            $(DOM.comercialTable).DataTable().destroy();
        }

        DOM.dataTableDT = $(DOM.dataTable).DataTable({
            ...config.dataTableOptions,
            columns: [
                { title: "Ancho" },
                { title: "Gramaje" },
                { title: "Línea" },
                { title: "Existencia" }
            ]
        });

        DOM.comercialTableDT = $(DOM.comercialTable).DataTable({
            ...config.dataTableOptions,
            columns: [
                { title: "ID" },
                { title: "Producto" },
                { title: "Ancho (mm)" },
                { title: "Gramaje (g/m²)" },
                { title: "Cantidad" },
                { title: "Estado" },
                { title: "Arribo Planta" }
            ],
            paging: true
        });
    }

    function updateVisualization() {
        const filters = {
            gramaje: DOM.filterGramaje.value,
            ancho: DOM.filterAncho.value,
            linea: DOM.filterLinea.value
        };

        // Filtrar datos en un solo paso
        const filterCondition = (item, type) => {
            const conditions = [
                filters.gramaje === 'all' || item.gramaje === filters.gramaje,
                filters.ancho === 'all' || item.ancho === filters.ancho,
                type === 'corrugador' ? (filters.linea === 'all' || item.linea === filters.linea) : true
            ];
            return conditions.every(c => c);
        };

        const filteredComercial = originalComercialData.filter(item => filterCondition(item, 'comercial'));
        const filteredCorrugador = originalCorrugadorData.filter(item => filterCondition(item, 'corrugador'));

        updateChart(filteredCorrugador);
        updateTables(filteredComercial, filteredCorrugador);
    }

    function updateChart(data) {
        // Agrupación optimizada de datos
        const groupedData = data.reduce((acc, item) => {
            const key = `${item.ancho}-${item.gramaje}`;
            acc[key] = (acc[key] || 0) + parseFloat(item.existencia);
            return acc;
        }, {});

        const gramajes = [...new Set(data.map(item => item.gramaje))].sort();
        const anchos = [...new Set(data.map(item => item.ancho))].sort((a, b) => a - b);

        const series = anchos.map(ancho => ({
            name: `Ancho: ${ancho}mm`,
            data: gramajes.map(gramaje => groupedData[`${ancho}-${gramaje}`] || 0)
        }));

        const chartConfig = {
            ...config.chartOptions,
            series: series,
            xaxis: { categories: gramajes, title: { text: 'Gramajes' } },
            yaxis: { title: { text: 'Existencias Totales' } }
        };

        if (chart) {
            chart.updateOptions(chartConfig);
        } else {
            chart = new ApexCharts(DOM.chart, chartConfig);
            chart.render();
        }
    }

    function updateTables(comercialData, corrugadorData) {
        // Actualización optimizada de tablas
        DOM.comercialTableDT.clear().rows.add(
            comercialData.map(item => [
                item.id,
                item.producto,
                item.ancho,
                item.gramaje,
                item.cantidad,
                item.estado,
                item.arribo_planta
            ])
        ).draw();

        DOM.dataTableDT.clear().rows.add(
            corrugadorData.map(item => [
                item.ancho,
                item.gramaje,
                item.linea,
                item.existencia
            ])
        ).draw();
    }

    // Event listeners
    [DOM.filterGramaje, DOM.filterAncho, DOM.filterLinea].forEach(select => {
        select.addEventListener('change', () => updateVisualization());
    });

    // Inicialización
    $(document).ready(() => {
        fetchData();
        $(DOM.dataTable).closest('table').wrap('<div class="table-responsive"></div>');
    });
})();
</script>