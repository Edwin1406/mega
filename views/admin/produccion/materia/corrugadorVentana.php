<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>




<ul class="lista-areas-produccion">
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> TOTAL EN EXISTENCIA :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
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
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaM ?> KG </span>
            <?php else : ?>
                <span class="areas-produccion__numero"> 0 KG </span>
            <?php endif; ?>
        </a>
    </li>


</ul>


  <!-- ✅ DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

  <!-- ✅ jQuery y DataTables JS -->
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

    table.dataTable thead {
      background-color: #2c3e50;
      color: white;
      text-transform: uppercase;
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

    table.dataTable thead th,
    table.dataTable thead td {
      border-bottom: 2px solid #ccc;
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
  </style>
</head>
<body>
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
    <tbody>
      <!-- Se llenará dinámicamente -->
    </tbody>
  </table>

  <script>
    let datosOriginales = [];

    async function cargarDatos() {
      try {
        const response = await fetch('https://megawebsistem.com/admin/api/apicomercial');
        const data = await response.json();
        datosOriginales = data;

        const resumenPorGramaje = {};
        const detallePorClave = {};
        const totalesMensuales = Array(12).fill(0);

        data.forEach(item => {
          const gramaje = item.gramaje;
          const linea = item.linea ? item.linea.toUpperCase().trim() : '';
          const fechaStr = item.arribo_planta;

          if (linea === 'MICRO - BLANCO' || linea === 'PERIODICO') return;
          if (!fechaStr || fechaStr === "0000-00-00") return;

          const fecha = new Date(fechaStr.replace(/-/g, '/'));
          if (isNaN(fecha.getTime())) return;
          const mes = fecha.getMonth();
          if (isNaN(mes)) return;

          const cantidad = parseFloat(item.cantidad.toString().replace(',', '').replace(' ', '')) || 0;
          const key = `${gramaje}-${mes}`;

          if (!resumenPorGramaje[gramaje]) resumenPorGramaje[gramaje] = {
            linea: linea,
            cantidades: Array(12).fill(0),
            total: 0
          };

          resumenPorGramaje[gramaje].cantidades[mes] += cantidad;
          resumenPorGramaje[gramaje].total += cantidad;
          totalesMensuales[mes] += cantidad;

          if (!detallePorClave[key]) detallePorClave[key] = [];
          detallePorClave[key].push({ ancho: item.ancho, cantidad, fecha: fechaStr });
        });

        const tbody = document.querySelector('#tabla-gramajes tbody');
        tbody.innerHTML = '';
        let totalGeneral = 0;

        Object.entries(resumenPorGramaje).forEach(([gramaje, info]) => {
          const row = document.createElement('tr');
          let html = `<td class="highlight">${gramaje}</td><td>${info.linea}</td>`;
          info.cantidades.forEach((cant, idx) => {
            html += `<td>${cant.toFixed(3)}</td>`;
          });
          html += `<td><strong>${info.total.toFixed(3)}</strong></td>`;
          totalGeneral += info.total;
          row.innerHTML = html;
          tbody.appendChild(row);
        });

        // Agregar fila de totales mensuales
        const totalRow = document.createElement('tr');
        totalRow.classList.add('total-row');
        let htmlTotales = `<td><strong>Total</strong></td><td></td>`;
        totalesMensuales.forEach(val => {
          htmlTotales += `<td><strong>${val.toFixed(3)}</strong></td>`;
        });
        htmlTotales += `<td><strong>${totalGeneral.toFixed(3)}</strong></td>`;
        totalRow.innerHTML = htmlTotales;
        tbody.appendChild(totalRow);

        // Activar DataTable
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

      } catch (error) {
        console.error('Error al cargar datos:', error);
        const tbody = document.querySelector('#tabla-gramajes tbody');
        tbody.innerHTML = '<tr><td colspan="15">Error al cargar datos</td></tr>';
      }
    }

    cargarDatos();
  </script>