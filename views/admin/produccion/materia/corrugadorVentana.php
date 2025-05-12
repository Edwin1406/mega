<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>




<ul class="lista-areas-produccion">
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> TOTAL MATERIA PRIMA CORRUGADOR :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?>
        </a>
    </li>
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> TOTAL IMPORT :
            <?php if ($totalExistenciasComercial > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciasComercial ?> KG </span>
            <?php endif; ?>
        </a>
    </li>

</ul>


<H1>MATERIA PRIMA</H1>

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
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> KG </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> 0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>


<H1> IMPORTACIONES</H1>


<ul class="lista-areas-produccion">
    <li class="areas-produccion-craft" data-aos="flip-left">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL CAJA-KRAFT :
            <?php if ($totalExistenciaKI > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaKI ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-blanco" data-aos="flip-left">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL CAJA-BLANCO :
            <?php if ($totalExistenciaBI > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaBI ?> KG </span>
            <?php endif; ?>
        </a>
    </li>


    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL CAJA-MEDIUM :
            <?php if (isset($totalExistenciaMI) && $totalExistenciaMI > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaMI ?> KG </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> 0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tabla de Ingresos</title>

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
      background-color: rgba(0, 0, 0, 0.5);
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
      color: #2c3e50;
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

      const fechaActual = new Date();
      const mesActual = fechaActual.getMonth();
      const anioActual = fechaActual.getFullYear();

      const dataFiltrada = data.filter(item => {
        if (!item.fecha_corte || item.fecha_corte === "0000-00-00") return false;
        const fechaCorte = new Date(item.fecha_corte.replace(/-/g, '/'));
        return fechaCorte.getMonth() === mesActual && fechaCorte.getFullYear() === anioActual;
      });

      datosOriginales = dataFiltrada;

      const resumenPorClave = {};
      const detallePorClave = {};
      const totalesMensuales = Array(12).fill(0);
      const combinaciones = {};

      dataFiltrada.forEach(item => {
        let lineaOriginal = item.linea ? item.linea.toUpperCase().trim() : '';
        if (!/^CAJAS|^MEDIUM/.test(lineaOriginal)) return;

        const fechaStr = item.arribo_planta;
        if (!fechaStr || fechaStr === "0000-00-00") return;
        const fecha = new Date(fechaStr.replace(/-/g, '/'));
        if (isNaN(fecha.getTime())) return;
        const mes = fecha.getMonth();
        if (isNaN(mes)) return;

        const cantidad = parseFloat(item.cantidad.toString().replace(',', '').replace(' ', '')) || 0;
        const gramaje = item.gramaje;
        const producto = item.producto || 'Sin nombre';

        if (!combinaciones[gramaje]) combinaciones[gramaje] = new Set();
        combinaciones[gramaje].add(lineaOriginal);

        let lineaFusionada = (lineaOriginal === 'CAJAS-KRAFT' || lineaOriginal === 'MEDIUM') ? 'PENDIENTE' : lineaOriginal;
        const clave = `${gramaje}||${lineaFusionada}||${producto}`;
        const keyMes = `${clave}-${mes}`;

        if (!resumenPorClave[clave]) {
          resumenPorClave[clave] = {
            gramaje,
            linea: lineaFusionada,
            producto,
            cantidades: Array(12).fill(0),
            total: 0
          };
        }

        resumenPorClave[clave].cantidades[mes] += cantidad;
        resumenPorClave[clave].total += cantidad;
        totalesMensuales[mes] += cantidad;

        if (!detallePorClave[keyMes]) detallePorClave[keyMes] = [];
        detallePorClave[keyMes].push({ ancho: item.ancho, lineaOriginal, cantidad, fecha: fechaStr });
      });

      Object.entries(resumenPorClave).forEach(([clave, info]) => {
        if (info.linea === 'PENDIENTE') {
          const lineas = combinaciones[info.gramaje];
          if (lineas.has('CAJAS-KRAFT') && lineas.has('MEDIUM')) {
            info.linea = 'CAJAS-KRAFT/MEDIUM';
          } else if (lineas.has('CAJAS-KRAFT')) {
            info.linea = 'CAJAS-KRAFT';
          } else if (lineas.has('MEDIUM')) {
            info.linea = 'MEDIUM';
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
      let encabezadoHtml = `<th>Gramaje</th><th>Línea</th><th>Producto</th>`;
      columnasActivas.forEach((activa, idx) => {
        if (activa) encabezadoHtml += `<th>${nombresMeses[idx]}</th>`;
      });
      encabezadoHtml += `<th>Total</th>`;
      encabezado.innerHTML = encabezadoHtml;

      Object.entries(resumenPorClave).forEach(([clave, info]) => {
        const row = document.createElement('tr');
        let html = `<td class="highlight">${info.gramaje}</td><td>${info.linea}</td><td>${info.producto}</td>`;
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
      let htmlTotales = `<td><strong>Total</strong></td><td></td><td></td>`;
      columnasActivas.forEach((activa, idx) => {
        if (activa) htmlTotales += `<td><strong>${totalesMensuales[idx].toFixed(3)}</strong></td>`;
      });
      htmlTotales += `<td><strong>${totalGeneral.toFixed(3)}</strong></td>`;
      totalRow.innerHTML = htmlTotales;
      tbody.appendChild(totalRow);

      $('#tabla-gramajes').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            title: 'Tabla de Ingresos',
            exportOptions: {
              columns: ':visible:not(.no-export)'
            }
          }
        ],
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



<!-- api inventario  -->


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario Detallado</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
  

    h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .tabla-container {
      overflow-x: auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    th {
      position: sticky;
      top: 0;
      background-color: #3498db;
      color: #fff;
      font-weight: 600;
      z-index: 10;
    }

    tr:nth-child(even) {
      background-color: #f9fbfd;
    }

    tr:hover {
      background-color: #eaf3fb;
    }

    tr.resaltado-1100 {
      background-color: #d1ecf1 !important;
    }

    tr.resaltado-1880 {
      background-color: #fff3cd !important;
    }

    td:first-child {
      font-weight: 600;
      color: #2c3e50;
    }

    td span {
      cursor: pointer;
      color: #007BFF;
      transition: color 0.3s;
    }

    td span:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    #modal1 {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
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
      width: 600px;
      max-height: 80vh;
      overflow-y: auto;
      position: relative;
    }

    #modal-content h2 {
      margin-top: 0;
      margin-bottom: 15px;
      font-size: 20px;
      font-weight: 700;
      border-bottom: 1px solid #eee;
      padding-bottom: 10px;
    }

    #close-modal {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      color: #888;
      cursor: pointer;
    }

    #close-modal:hover {
      color: #e74c3c;
    }

    #detalles-lista {
      list-style: none;
      padding-left: 0;
    }

    #detalles-lista li {
      margin-bottom: 10px;
      padding: 10px;
      background: #f1f1f1;
      border-left: 4px solid #3498db;
      border-radius: 6px;
      font-size: 14px;
    }

    #detalles-lista li.ancho-1100 {
      background-color: #d1ecf1 !important;
      border-left-color: #17a2b8;
    }

    #detalles-lista li.ancho-1880 {
      background-color: #fff3cd !important;
      border-left-color: #ffc107;
    }
  </style>
</head>
<body>


<div id="modal1">
  <div id="modal-content">
    <span id="close-modal">&times;</span>
    <h2>Detalles de Anchos</h2>
    <ul id="detalles-lista"></ul>
  </div>
</div>

<script>
  const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

  const tabla = document.querySelector('#tabla-ingresos tbody');
  const encabezado = document.querySelector('#encabezado');
  const modal = document.getElementById('modal1');
  const modalContent = document.getElementById('modal-content');
  const detallesLista = document.getElementById('detalles-lista');
  const closeModal = document.getElementById('close-modal');

  fetch('https://megawebsistem.com/admin/api/apimateriaprimajson')
    .then(res => res.json())
    .then(data => {
      const resumen = {};
      const detalles = {};
      const mesesConDatos = Array(12).fill(false);
      const totalesPorMes = Array(12).fill(0);

      data.forEach(item => {
        const fecha = new Date(item.fecha_corte);
        const mes = fecha.getMonth();
        const gramaje = item.gramaje;
        const cantidad = parseInt(item.existencia) || 0;
        const ancho = item.ancho;

        if (!resumen[gramaje]) resumen[gramaje] = Array(12).fill(0);
        if (!detalles[`${gramaje}-${mes}`]) detalles[`${gramaje}-${mes}`] = [];

        resumen[gramaje][mes] += cantidad;
        detalles[`${gramaje}-${mes}`].push({ ancho, cantidad });

        if (cantidad > 0) mesesConDatos[mes] = true;
      });

      meses.forEach((mes, i) => {
        if (mesesConDatos[i]) {
          const th = document.createElement('th');
          th.textContent = mes;
          encabezado.appendChild(th);
        }
      });

      Object.entries(resumen).forEach(([gramaje, cantidades]) => {
        const fila = document.createElement('tr');

        if (gramaje === "1100") fila.classList.add('resaltado-1100');
        else if (gramaje === "1880") fila.classList.add('resaltado-1880');

        fila.innerHTML = `<td>${gramaje}</td>`;

        cantidades.forEach((cantidad, i) => {
          if (mesesConDatos[i]) {
            const celda = document.createElement('td');
            if (cantidad > 0) {
              celda.innerHTML = `<span onclick="mostrarModal('${gramaje}', ${i})">${cantidad}</span>`;
              totalesPorMes[i] += cantidad;
            } else {
              celda.textContent = '';
            }
            fila.appendChild(celda);
          }
        });

        tabla.appendChild(fila);
      });

      const filaTotal = document.createElement('tr');
      filaTotal.innerHTML = `<td><strong>TOTAL</strong></td>`;
      mesesConDatos.forEach((activo, i) => {
        if (activo) {
          filaTotal.innerHTML += `<td><strong>${totalesPorMes[i]}</strong></td>`;
        }
      });
      tabla.appendChild(filaTotal);

      window.mostrarModal = (gramaje, mesIndex) => {
        const clave = `${gramaje}-${mesIndex}`;
        const elementos = detalles[clave] || [];
        detallesLista.innerHTML = elementos
          .map(e => {
            let clase = '';
            if (e.ancho == 1100) clase = 'ancho-1100';
            else if (e.ancho == 1880) clase = 'ancho-1880';
            return `<li class="${clase}">Ancho: ${e.ancho} - Cantidad: ${e.cantidad}</li>`;
          })
          .join('');
        modal.style.display = 'flex';
      };
    })
    .catch(err => {
      console.error("Error al obtener los datos:", err);
      tabla.innerHTML = `<tr><td colspan="13">Error cargando datos</td></tr>`;
    });

  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      modal.style.display = 'none';
    }
  });
</script>

</body>
</html>







<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Consumos Proyectados por Mes</title>
  <style>
  

    h1 {
      text-align: center;
      margin-bottom: 40px;
      text-transform: uppercase;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    thead th {
      background-color: #f4f4f4;
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
      color: black;
    }

    tbody td {
      border: 1px solid #ccc;
      padding: 6px;
      text-align: center;
    }

    .header-mes {
      background-color: #e1e7ec;
      font-weight: bold;
    }

    .total {
      font-weight: bold;
      color: green;
    }

    .footer-row td {
      background-color: #f8f9fa;
      font-weight: bold;
      color: black;
    }
  </style>
</head>
<body>

<h1>Consumos Proyectados por Mes - 2025</h1>
<div style="overflow-x: auto;">
  <table id="tablaConsumos">
    <thead id="thead"></thead>
    <tbody id="tbody"></tbody>
    <tfoot id="tfoot"></tfoot>
  </table>
</div>

<script>
async function construirTabla() {
  const response = await fetch('https://megawebsistem.com/admin/api/apiproyecciones');
  const data = await response.json();

  const mesesES = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
  const tabla = {};
  const gramajes = new Set();
  const mesesEnData = new Set();
  const totalesPorMes = {}; // para la fila final

  data.forEach(item => {
    const mesIndex = parseInt(item.fecha_consumo.slice(5, 7), 10) - 1;
    const mes = mesesES[mesIndex];
    const gms = item.gms;
    const ancho = item.ancho;
    const cantidad = parseFloat(item.cantidad);

    if (!tabla[gms]) tabla[gms] = {};
    if (!tabla[gms][mes]) tabla[gms][mes] = { '188': 0, '110': 0, 'CANT': 0 };

    if (!totalesPorMes[mes]) totalesPorMes[mes] = { '188': 0, '110': 0, 'CANT': 0 };

    if (ancho === "1880") {
      tabla[gms][mes]['188'] += cantidad;
      totalesPorMes[mes]['188'] += cantidad;
    } else if (ancho === "1100") {
      tabla[gms][mes]['110'] += cantidad;
      totalesPorMes[mes]['110'] += cantidad;
    }

    tabla[gms][mes]['CANT'] += cantidad;
    totalesPorMes[mes]['CANT'] += cantidad;

    gramajes.add(gms);
    mesesEnData.add(mes);
  });

  const mesesOrdenados = mesesES.filter(m => mesesEnData.has(m));
  const gramajesOrdenados = Array.from(gramajes).sort((a, b) => a - b);

  // Construir encabezado
  const thead = document.getElementById("thead");
  const header1 = document.createElement("tr");
  header1.innerHTML = `<th rowspan="2">GRAMAJE</th>`;
  mesesOrdenados.forEach(mes => {
    header1.innerHTML += `<th class="header-mes" colspan="3">${mes}</th>`;
  });

  const header2 = document.createElement("tr");
  mesesOrdenados.forEach(() => {
    header2.innerHTML += `<th>188</th><th>110</th><th>CANT</th>`;
  });

  thead.appendChild(header1);
  thead.appendChild(header2);

  // Construir cuerpo
  const tbody = document.getElementById("tbody");
  gramajesOrdenados.forEach(gms => {
    const fila = document.createElement("tr");
    fila.innerHTML = `<td>${gms}</td>`;

    mesesOrdenados.forEach(mes => {
      const valores = tabla[gms][mes] || { '188': 0, '110': 0, 'CANT': 0 };
      fila.innerHTML += `
        <td>${valores['188'].toFixed(1)}</td>
        <td>${valores['110'].toFixed(1)}</td>
        <td class="total">${valores['CANT'].toFixed(1)}</td>
      `;
    });

    tbody.appendChild(fila);
  });

  // Construir pie (totales por mes)
  const tfoot = document.getElementById("tfoot");
  const filaTotal = document.createElement("tr");
  filaTotal.className = "footer-row";
  filaTotal.innerHTML = `<td>TOTAL</td>`;
  mesesOrdenados.forEach(mes => {
    const t = totalesPorMes[mes];
    filaTotal.innerHTML += `
      <td>${t['188'].toFixed(1)}</td>
      <td>${t['110'].toFixed(1)}</td>
      <td class="total">${t['CANT'].toFixed(1)}</td>
    `;
  });
  tfoot.appendChild(filaTotal);
}

construirTabla();
</script>

</body>
</html>
