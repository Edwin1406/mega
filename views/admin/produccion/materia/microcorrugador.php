<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<ul class="lista-areas-produccion">  
    <li class="areas-produccion-estatico-craft">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>





<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

  <!-- jQuery y DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

  <style>
  

    h1 {
      font-size: 24px;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    table.dataTable {
      width: 100%;
      border-collapse: collapse;
      background: #ffffff;
      border: none;
      font-size: 14px;
    }

    th{
      background-color: #2c3e50;
      color: rgb(14, 12, 12);
      text-align: center;
      padding: 10px;
    }

    table.dataTable thead {
      background-color: #2c3e50;
      color: white;
      text-transform: uppercase;
    }

    .dataTables_wrapper .dataTables_filter{
      padding-bottom: 1rem;
    }

    table.dataTable tbody tr:hover {
      background-color: #f4f6f9;
    }

    table.dataTable td, table.dataTable th {
      text-align: center;
      padding: 10px;
    }

    .dt-center {
      text-align: center;
    }

    td.highlight {
      font-weight: bold;
      background-color: #fcefe3 !important;
      color: #2d3436;
    }

    td:last-child, th:last-child {
      font-weight: bold;
      color: #27ae60;
      background-color: #f0fdf4;
    }

    .total-row td {
      background-color: #dfe6e9;
      font-weight: bold;
      text-transform: uppercase;
    }

    #modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(163, 110, 110, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
      backdrop-filter: blur(3px);
    }

    #modal-content {
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
      width: 700px;
      max-height: 80vh;
      overflow-y: auto;
      position: relative;
      font-family: 'Segoe UI', sans-serif;
      animation: modalFadeIn 0.3s ease;
    }

    #modal h2 {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 22px;
      font-weight: 700;
      color:rgb(244, 250, 255);
      border-bottom: 1px solid #eee;
      padding-bottom: 10px;
    }

    #close-modal {
      position: absolute;
      top: 14px;
      right: 18px;
      font-size: 20px;
      color: #999;
      cursor: pointer;
      transition: color 0.3s;
    }

    #close-modal:hover {
      color: #e74c3c;
    }

    #detalles {
      list-style: none;
      padding-left: 0;
    }

    #detalles li {
      margin-bottom: 12px;
      padding: 10px 12px;
      background: #f9f9f9;
      border-left: 4px solid #3498db;
      border-radius: 6px;
      color: #333;
      font-size: 15px;
    }

    .ancho-1100 {
      background-color: #dff9fb !important;
      border-left-color: #0984e3 !important;
    }

    .ancho-1880 {
      background-color: #ffeaa7 !important;
      border-left-color: #fdcb6e !important;
    }

    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }


    .contenedor {
  display: flex;
  flex-wrap: wrap; /* NUEVO: permite que las columnas se bajen en pantallas chicas */
}

.columna {
  flex: 1 1 50%; /* NUEVO: mínimo 50% de ancho, flexible */
  padding: 10px;
  min-width: 300px; /* NUEVO: evita que se comprima demasiado */
  box-sizing: border-box;
}

table.dataTable {
  width: 100% !important; /* Asegura que no se desborde */
  overflow-x: auto;       /* Evita que se rompa el diseño */
  display: block;         /* Necesario para aplicar scroll */
}


.columna {
  flex: 1;
  padding: 10px;
}

/* opcional: separación entre columnas */
.columna + .columna {
  margin-left: 20px;
}



@media (max-width: 768px) {
  .contenedor {
    flex-direction: column;
  }

  .columna + .columna {
    margin-left: 0;
    margin-top: 20px;
  }

  td.child{
    text-align: left;
  }
}


  </style>
</head>
<body>
  
  <div class="contenedor">

    <div class="columna izquierda">

    <h1>INGRESOS</h1>
    <table id="tabla-gramajes" class="display responsive nowrap">
      <thead>
        <tr>
          <th>Gramaje</th>
          <th>Línea</th>
          <th>Enero</th>
          <th>Febrero</th>
          <th>Marzo</th>
          <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
  </div>
  <div class="columna derecha">

  
<h2>inventario</h2>

<table id="tabla-ingresos">
  <thead>
    <tr id="encabezado">
      <th>Gramaje</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
</div>


<!-- Modal -->
<div id="modal1">
  <div id="modal-content">
    <span id="close">&times;</span>
    <h3>Detalles de Anchos</h3>
    <ul id="detalles-lista"></ul>
  </div>
</div>

</div>
  
  <div id="modal">
    <div id="modal-content">
      <span id="close-modal">&times;</span>
      <h2>Detalles de Anchos</h2>
      <ul id="detalles"></ul>
    </div>
  </div>


<!-- DataTables core -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- JSZip (necesario para exportar a Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
let datosOriginales = [];

async function cargarDatos() {
    try {
        const response = await fetch('https://megawebsistem.com/admin/api/apicomercial');
        const data = await response.json();

        // Obtener mes y año actual
        const fechaActual = new Date();
        const mesActual = fechaActual.getMonth(); // 0 = Enero
        const anioActual = fechaActual.getFullYear();

        // Filtrar solo datos con fecha_corte en el mes actual
        const dataFiltrada = data.filter(item => {
            if (!item.fecha_corte || item.fecha_corte === "0000-00-00") return false;
            const fechaCorte = new Date(item.fecha_corte.replace(/-/g, '/'));
            return fechaCorte.getMonth() === mesActual && fechaCorte.getFullYear() === anioActual;
        });

        datosOriginales = dataFiltrada;

        const resumenPorClave = {};
        const detallePorClave = {};
        const totalesMensuales = Array(12).fill(0);
        const combinaciones = {}; // gramaje => Set de líneas reales

        dataFiltrada.forEach(item => {
            let lineaOriginal = item.linea ? item.linea.toUpperCase().trim() : '';
            // if (!/^MICRO|^MEDIUM/.test(lineaOriginal)) return;
            if (!/^MICRO/.test(lineaOriginal)) return;

            const fechaStr = item.arribo_planta;
            if (!fechaStr || fechaStr === "0000-00-00") return;
            const fecha = new Date(fechaStr.replace(/-/g, '/'));
            if (isNaN(fecha.getTime())) return;
            const mes = fecha.getMonth();
            if (isNaN(mes)) return;

            const cantidad = parseFloat(item.cantidad.toString().replace(',', '').replace(' ', '')) || 0;
            const gramaje = item.gramaje;

            if (!combinaciones[gramaje]) combinaciones[gramaje] = new Set();
            combinaciones[gramaje].add(lineaOriginal);

            // Agrupar solo por gramaje, sin incluir la línea
            const clave = `${gramaje}`;

            if (!resumenPorClave[clave]) {
                resumenPorClave[clave] = {
                    gramaje,
                    linea: 'PENDIENTE', // Mantener la línea como 'PENDIENTE' para todos los casos
                    cantidades: Array(12).fill(0),
                    total: 0
                };
            }

            resumenPorClave[clave].cantidades[mes] += cantidad;
            resumenPorClave[clave].total += cantidad;
            totalesMensuales[mes] += cantidad;

            if (!detallePorClave[`${clave}-${mes}`]) detallePorClave[`${clave}-${mes}`] = [];
            detallePorClave[`${clave}-${mes}`].push({ ancho: item.ancho, lineaOriginal, cantidad, fecha: fechaStr });
        });

        Object.entries(resumenPorClave).forEach(([clave, info]) => {
            if (info.linea === 'PENDIENTE') {
                const lineas = combinaciones[info.gramaje];
                if (lineas.has('CAJAS-KRAFT') && lineas.has('MEDIUM') && lineas.has('CAJAS-BLANCO')) {
                    info.linea = 'CAJAS-KRAFT/MEDIUM/CAJAS-BLANCO';
                }else if (lineas.has('CAJAS-KRAFT') && lineas.has('MEDIUM')) {
                    info.linea = 'CAJAS-KRAFT/MEDIUM';
                } else if (lineas.has('CAJAS-BLANCO') && lineas.has('MEDIUM')) {
                    info.linea = 'CAJAS-BLANCO/MEDIUM';
                } else if (lineas.has('CAJAS-BLANCO')) {
                    info.linea = 'CAJAS-BLANCO';
                }
                else if (lineas.has('CAJAS-KRAFT') && lineas.has('CAJAS-BLANCO')) {
                    info.linea = 'CAJAS-KRAFT/CAJAS-BLANCO';
                } else if (lineas.has('CAJAS-KRAFT')) {
                    info.linea = 'CAJAS-KRAFT';
                } else if (lineas.has('MEDIUM') && lineas.has('CAJAS-BLANCO')) {
                    info.linea = 'MEDIUM/CAJAS-BLANCO';
                }
                else if (lineas.has('MEDIUM')) {
                    info.linea = 'MEDIUM';
                } else {
                    info.linea = Array.from(lineas).join(', ');
                }
                
               
            }
        });

        const columnasActivas = Array(12).fill(false);
        Object.values(resumenPorClave).forEach(info => {
            info.cantidades.forEach((cant, i) => {
                if (cant > 0) columnasActivas[i] = true;
            });
        });

        const tbody = document.querySelector('#tabla-gramajes tbody');
        tbody.innerHTML = '';
        let totalGeneral = 0;

        const encabezado = document.querySelector('#tabla-gramajes thead tr');
        const nombresMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        let encabezadoHtml = `<th>Gramaje</th><th>Línea</th>`;
        columnasActivas.forEach((activa, idx) => {
            if (activa) encabezadoHtml += `<th>${nombresMeses[idx]}</th>`;
        });
        encabezadoHtml += `<th>Total</th>`;
        encabezado.innerHTML = encabezadoHtml;

        Object.entries(resumenPorClave).forEach(([clave, info]) => {
            const row = document.createElement('tr');
            let html = `<td class="highlight">${info.gramaje}</td><td>${info.linea}</td>`;
            info.cantidades.forEach((cant, idx) => {
                if (columnasActivas[idx]) {
                    const keyMes = `${clave}-${idx}`;
                    html += `<td onclick="mostrarDetalles('${keyMes}')">${cant.toFixed(3)}</td>`;
                }
            });
            html += `<td><strong>${info.total.toFixed(3)}</strong></td>`;
            totalGeneral += info.total;
            row.innerHTML = html;
            tbody.appendChild(row);
        });

        const totalRow = document.createElement('tr');
        totalRow.classList.add('total-row');
        let htmlTotales = `<td><strong>Total</strong></td><td></td>`;
        columnasActivas.forEach((activa, idx) => {
            if (activa) htmlTotales += `<td><strong>${totalesMensuales[idx].toFixed(3)}</strong></td>`;
        });
        htmlTotales += `<td><strong>${totalGeneral.toFixed(3)}</strong></td>`;
        totalRow.innerHTML = htmlTotales;
        tbody.appendChild(totalRow);

        $('#tabla-gramajes').DataTable({
            responsive: true,
            paging: false,
            searching: true,
            ordering: true,
            info: false,
            language: {
                search: "Buscar:",
                zeroRecords: "No se encontraron resultados",
                infoEmpty: "No hay registros disponibles"
            },
            columnDefs: [
                { targets: '_all', className: 'dt-center' }
            ]
        });

        window.mostrarDetalles = (key) => {
            const lista = document.getElementById('detalles');
            lista.innerHTML = '';
            const detalles = detallePorClave[key] || [];

            if (detalles.length === 0) {
                lista.innerHTML = '<li>No hay detalles disponibles.</li>';
            } else {
                detalles.forEach((item, i) => {
                    const li = document.createElement('li');
                    li.textContent = `#${i + 1} → Ancho: ${item.ancho} | | Linea: ${item.lineaOriginal} |  | Cantidad: ${item.cantidad.toFixed(3)} | | Fecha: ${item.fecha}`;
                    const anchoNumerico = parseInt(item.ancho);
                    if (anchoNumerico === 1100) li.classList.add('ancho-1100');
                    else if (anchoNumerico === 1880) li.classList.add('ancho-1880');
                    lista.appendChild(li);
                });
            }
            document.getElementById('modal').style.display = 'flex';
        };

        document.getElementById('close-modal').onclick = function () {
            document.getElementById('modal').style.display = 'none';
        };
        window.onclick = function (event) {
            if (event.target === document.getElementById('modal')) {
                document.getElementById('modal').style.display = 'none';
            }
        };

    } catch (error) {
        console.error('Error al cargar datos:', error);
        document.querySelector('#tabla-gramajes tbody').innerHTML = '<tr><td colspan="15">Error al cargar datos</td></tr>';
    }
}

cargarDatos();

</script>
</body>
</html>


