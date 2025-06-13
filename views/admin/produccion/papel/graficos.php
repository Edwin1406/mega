<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<style>
  table.dataTable {
    width: 100% !important;
    overflow-x: auto;
    display: block;
  }

  h2 {
    text-align: center;
    color: #333;
  }

  .filtros {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-bottom: 20px;
  }

  .filtros label {
    font-weight: bold;
    margin-right: 5px;
  }

  .filtros select,
  .filtros input[type="date"] {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #d85a5a;
  }

  table.dataTable thead {
    background-color: #5388bd;
    color: white;
  }

  table.dataTable tbody tr {
    background-color: #fff;
  }

  table.dataTable tbody tr:hover {
    background-color: #ecf0f1;
  }

  table.dataTable tfoot th {
    font-weight: bold;
    background-color: #bb8b8b;
    text-align: center; /* Alineación centrada de los totales */
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5em 1em;
    margin-left: 4px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #f1f1f1;
    color: #333;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #358ac4;
    color: white !important;
  }
</style>

<div class="filtros">
  <label for="filtroClasificacion">Filtrar por tipo de clasificación:</label>
  <select id="filtroClasificacion"><option value="">Todos</option></select>

  <label for="fechaInicio">Desde:</label>
  <input type="date" id="fechaInicio">

  <label for="fechaFin">Hasta:</label>
  <input type="date" id="fechaFin">
</div>

<table id="tablaDesperdicio" class="display" style="width:100%">
  <thead>
    <tr>
      <th rowspan="2">Tipo de clasificación</th>
      <th colspan="8" style="background-color:#9f5fa5; text-align:center">CONTROLABLE</th>
      <th colspan="10" style="background-color:#4988a8; text-align:center;">NO CONTROLABLE</th>
      <th rowspan="2">Fecha</th>
    </tr>
    <tr>
      <th>SINGLE FACE</th>
      <th>EMPALME</th>
      <th>RECUB</th>
      <th>GALLET</th>
      <th>HÚMEDO</th>
      <th>COMBADO</th>
      <th>DESPE</th>
      <th>ERROM</th>

      <th>DESHOJE</th>
      <th>MECÁNICO</th>
      <th>ELECTRICO</th>
      <th>FILOS ROTOS</th>
      <th>REFILE PEQUEÑO</th>
      <th>PEDIDOS CORTOS</th>
      <th>DIFER ANCHO</th>
      <th>CAMBIO GRAMAJE</th>
      <th>CAMBIO PEDIDO</th>
      <th>EXTRA TRIM</th>
      <th>SUSTRATO</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th colspan="2">Totales:</th>
      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody></tbody>
</table>

<div style="display: flex; justify-content: center; gap: 50px; margin-top: 40px;">
  <div>
    <h3 style="text-align:center">Controlables</h3>
    <canvas id="graficoControlables" width="600" height="600"></canvas>
  </div>
  <div>
    <h3 style="text-align:center">No Controlables</h3>
    <canvas id="graficoNoControlables" width="600" height="600"></canvas>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filtroClasificacion = document.getElementById('filtroClasificacion');
    const fechaInicio = document.getElementById('fechaInicio');
    const fechaFin = document.getElementById('fechaFin');
  });

  const columnas = [
    { title: "Tipo de clasificación", data: "tipo_clasificacion" },
    { title: "Single Face", data: "SINGLEFACE" },
    { title: "Empalme", data: "EMPALME" },
    { title: "Recub", data: "RECUB" },
    { title: "Gallet", data: "GALLET" },
    { title: "Húmedo", data: "HUMEDO" },
    { title: "Combado", data: "COMBADO" },
    { title: "Despe", data: "DESPE" },
    { title: "Errom", data: "ERROM" },

    { title: "Deshoje", data: "DESHOJE" },
    { title: "Mecánico", data: "MECANICO" },
    { title: "Cambio de pedido", data: "CAMBIO_PEDIDO" },
    { title: "Filos rotos", data: "FILOS_ROTOS" },
    { title: "Extra trim", data: "EXTRA_TRIM" },
    { title: "Pedidos cortos", data: "PEDIDOS_CORTOS" },
    { title: "Difer ancho", data: "DIFER_ANCHO" },
    { title: "Cambio de gramaje", data: "CAMBIO_GRAMAJE" },
    { title: "Refile pequeño", data: "REFILE_PEQUENO" },
    { title: "Sustrato", data: "SUSTRATO" },
    { title: "Total", data: "TOTAL" },
    { title: "Porcentaje", data: "PORCENTAJE" },
    { title: "Fecha", data: "created_at" }
  ];

  const columnasControlable = ["SINGLEFACE", "EMPALME", "RECUB", "GALLET", "HUMEDO", "COMBADO", "DESPE", "ERROM"];
  const columnasNoControlable = ["DESHOJE","MECANICO","ELECRICO","FILOS_ROTOS","REFILE_PEQUENO","PEDIDOS_CORTOS","DIFER_ANCHO","CAMBIO_GRAMAJE","CAMBIO_PEDIDO","EXTRA_TRIM","SUSTRATO"];

  let tabla;
  let chartControlables, chartNoControlables;
  let dataOriginal = [];

  $(document).ready(function () {
    fetch('https://megawebsistem.com/admin/api/apidesperdiciopapel')
      .then(res => res.json())
      .then(data => {
        dataOriginal = data;

        tabla = $('#tablaDesperdicio').DataTable({
          data: [],
          columns: columnas,
          footerCallback: function (row, data, start, end, display) {
            const api = this.api();
            for (let i = 2; i < columnas.length - 1; i++) {
              const total = api.column(i, { search: 'applied' }).data().reduce((a, b) => {
                return parseFloat(a) + parseFloat(b);
              }, 0);
              $(api.column(i).footer()).html(total.toFixed(2));
            }
          }
        });

        const tiposClasificacion = [...new Set(data.flatMap(e => e.tipo_clasificacion.split(',').map(x => x.trim())))];
        tiposClasificacion.forEach(tipo => {
          $('#filtroClasificacion').append(`<option value="${tipo}">${tipo}</option>`);
        });

        $('#filtroClasificacion, #fechaInicio, #fechaFin').on('change', aplicarFiltroYMostrar);
        aplicarFiltroYMostrar(); // inicial
      });

    function aplicarFiltroYMostrar() {
      const filtroClasificacion = $('#filtroClasificacion').val();
      const fechaInicio = $('#fechaInicio').val();
      const fechaFin = $('#fechaFin').val();

      let datosFiltrados = dataOriginal.filter(registro => {
        const clasificaciones = registro.tipo_clasificacion.split(',').map(x => x.trim());

        const fechaRegistro = new Date(registro.created_at);
        const inicio = fechaInicio ? new Date(fechaInicio) : null;
        const fin = fechaFin ? new Date(fechaFin) : null;

        fechaRegistro.setHours(0, 0, 0, 0);
        if (inicio) inicio.setHours(0, 0, 0, 0);
        if (fin) fin.setHours(0, 0, 0, 0);

        return (!filtroClasificacion || clasificaciones.includes(filtroClasificacion))
            && (!inicio || fechaRegistro >= inicio)
            && (!fin || fechaRegistro <= fin);
      });

      console.log('Datos Filtrados:', datosFiltrados);  // Debugging line to inspect filtered data

      datosFiltrados = datosFiltrados.map(reg => {
        const copia = { ...reg };
        const clasificaciones = reg.tipo_clasificacion.split(',').map(x => x.trim());

        if (filtroClasificacion === "CONTROLABLE") {
          if (!clasificaciones.includes("CONTROLABLE")) {
            columnasControlable.forEach(col => copia[col] = "0.00");
          }
          columnasNoControlable.forEach(col => copia[col] = "0.00");
        }

        if (filtroClasificacion === "NO CONTROLABLE") {
          if (!clasificaciones.includes("NO CONTROLABLE")) {
            columnasNoControlable.forEach(col => copia[col] = "0.00");
          }
          columnasControlable.forEach(col => copia[col] = "0.00");
        }

        return copia;
      });

      tabla.clear().rows.add(datosFiltrados).draw();
      actualizarGraficos(datosFiltrados);
    }

    function actualizarGraficos(data) {
      const sumaColumnas = (cols) => {
        return cols.map(col =>
          data.reduce((acc, fila) => acc + parseFloat(fila[col] || 0), 0)
        );
      };

      const totalesControlables = sumaColumnas(columnasControlable);
      const totalesNoControlables = sumaColumnas(columnasNoControlable);

      const totalControl = totalesControlables.reduce((a, b) => a + b, 0);
      const totalNoControl = totalesNoControlables.reduce((a, b) => a + b, 0);

      const colores = [
        '#ffcccc', '#ffe6cc', '#ffffcc', '#e6ffcc', '#ccffff', '#e6ccff', '#f0f8ff', '#f5f5dc',
        '#fafad2', '#e0ffff', '#f5e6ff', '#d0f0c0', '#fdfd96', '#ffb3ba', '#baffc9', '#bae1ff',
        '#fff0f5', '#e6ffe9', '#ffe6f2', '#e0e0e0'
      ];

      if (chartControlables) chartControlables.destroy();
      if (chartNoControlables) chartNoControlables.destroy();

      const crearConfig = (labels, datos, total) => ({
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: datos,
            backgroundColor: colores
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'right',
              labels: {
                generateLabels: function (chart) {
                  const data = chart.data;
                  return data.labels.map((label, i) => {
                    const value = data.datasets[0].data[i];
                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                    return {
                      text: `${label} - ${percentage}%`,
                      fillStyle: data.datasets[0].backgroundColor[i],
                      strokeStyle: data.datasets[0].backgroundColor[i],
                      index: i
                    };
                  });
                }
              },
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  const label = context.label || '';
                  const value = context.parsed;
                  return `${label}: ${value.toFixed(2)}`;
                }
              }
            }
          }
        }
      });

      chartControlables = new Chart(document.getElementById('graficoControlables'), crearConfig(columnasControlable, totalesControlables, totalControl));
      chartNoControlables = new Chart(document.getElementById('graficoNoControlables'), crearConfig(columnasNoControlable, totalesNoControlables, totalNoControl));
    }
  });
</script>
