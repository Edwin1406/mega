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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tabla de Gramajes</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <style>
    .contenedor {
      display: flex;
      justify-content: space-between;
    }
    .columna {
      width: 48%;
    }
    .highlight {
      font-weight: bold;
    }
    .total-row {
      background-color: #f0f0f0;
    }
    #modal, #modal1 {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }
    #modal-content {
      background-color: white;
      margin: 10% auto;
      padding: 20px;
      width: 50%;
    }
    #close, #close-modal {
      float: right;
      font-size: 28px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="contenedor">
  <div class="columna izquierda">
    <h1>INGRESOS</h1>
    <table id="tabla-gramajes" class="display responsive nowrap">
      <thead>
        <tr id="encabezado">
          <th>Gramaje</th>
          <th>Línea</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <div class="columna derecha">
    <h2>Inventario</h2>
    <table id="tabla-ingresos">
      <thead>
        <tr>
          <th>Gramaje</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div id="modal">
  <div id="modal-content">
    <span id="close-modal">&times;</span>
    <h2>Detalles de Anchos</h2>
    <ul id="detalles"></ul>
  </div>
</div>

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
        let linea = item.linea ? item.linea.toUpperCase().trim() : '';
        if (linea === 'MICRO - BLANCO' || linea === 'PERIODICO') return;
        if (linea === 'CAJAS-KRAFT' || linea === 'MEDIUM') linea = 'CAJAS-KRAFT/MEDIUM';

        const fechaStr = item.arribo_planta;
        if (!fechaStr || fechaStr === "0000-00-00") return;
        const fecha = new Date(fechaStr.replace(/-/g, '/'));
        if (isNaN(fecha.getTime())) return;
        const mes = fecha.getMonth();
        if (isNaN(mes)) return;

        const cantidad = parseFloat(item.cantidad.toString().replace(',', '').replace(' ', '')) || 0;
        const gramaje = item.gramaje;
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

      // Detectar columnas activas
      const columnasActivas = Array(12).fill(false);
      Object.values(resumenPorGramaje).forEach(info => {
        info.cantidades.forEach((cant, i) => {
          if (cant > 0) columnasActivas[i] = true;
        });
      });

      const tbody = document.querySelector('#tabla-gramajes tbody');
      tbody.innerHTML = '';
      let totalGeneral = 0;

      // Crear encabezado dinámico
      const encabezado = document.querySelector('#tabla-gramajes thead tr');
      const nombresMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      let encabezadoHtml = `<th>Gramaje</th><th>Línea</th>`;
      columnasActivas.forEach((activa, idx) => {
        if (activa) encabezadoHtml += `<th>${nombresMeses[idx]}</th>`;
      });
      encabezadoHtml += `<th>Total</th>`;
      encabezado.innerHTML = encabezadoHtml;

      // Crear filas
      Object.entries(resumenPorGramaje).forEach(([gramaje, info]) => {
        const row = document.createElement('tr');
        let html = `<td class="highlight">${gramaje}</td><td>${info.linea}</td>`;
        info.cantidades.forEach((cant, idx) => {
          if (columnasActivas[idx]) {
            const key = `${gramaje}-${idx}`;
            html += `<td onclick="mostrarDetalles('${key}')">${cant.toFixed(3)}</td>`;
          }
        });
        html += `<td><strong>${info.total.toFixed(3)}</strong></td>`;
        totalGeneral += info.total;
        row.innerHTML = html;
        tbody.appendChild(row);
      });

      // Fila de totales
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
            li.textContent = `#${i + 1} → Ancho: ${item.ancho} | Cantidad: ${item.cantidad.toFixed(3)} | Fecha: ${item.fecha}`;
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
  <style>
    body { font-family: Arial; }
    h2 { margin-top: 20px; }
    table { border-collapse: collapse; width: 100%; margin-top: 10px; }
    th, td { border: 1px solid #aaa; padding: 8px; text-align: center; }
    th { background-color: #f2f2f2; }
    tr:nth-child(even) td { background-color: #f9f9f9; }
    td:first-child { font-weight: bold; }

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
    width: 550px;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    font-family: 'Segoe UI', sans-serif;
    animation: modalFadeIn 0.3s ease;
  }

  #modal1 h2 {
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
  #detalles-lista {
    list-style: none;
    padding-left: 0;
  }

  #detalles-lista li {
    margin-bottom: 12px;
    padding: 10px 12px;
    background: #f9f9f9;
    border-left: 4px solid #3498db;
    border-radius: 6px;
    color: #333;
    font-size: 15px;
  }

  @keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }


  </style>
</head>
<body>

<script>
  const meses = [
    'Enero', 'Febrero', 'Marzo', 'Abril',
    'Mayo', 'Junio', 'Julio', 'Agosto',
    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];

  const tabla = document.querySelector('#tabla-ingresos tbody');
  const encabezado = document.querySelector('#encabezado');
  const modal = document.getElementById('modal1');
  const closeModal = document.getElementById('close');
  const detallesLista = document.getElementById('detalles-lista');

  closeModal.onclick = () => modal.style.display = "none";
  window.onclick = e => { if (e.target == modal) modal.style.display = "none"; };

  fetch('https://megawebsistem.com/admin/api/apimateriaprimajson')
    .then(res => res.json())
    .then(data => {
      const resumen = {};
      const detalles = {};
      const mesesConDatos = new Array(12).fill(false);
      const totalesPorMes = new Array(12).fill(0);

      data.forEach(item => {
        const fecha = new Date(item.fecha_corte);
        const mes = fecha.getMonth(); // 0 = Enero
        const gramaje = item.gramaje;
        const cantidad = parseInt(item.existencia) || 0;
        const ancho = item.ancho;

        if (!resumen[gramaje]) resumen[gramaje] = Array(12).fill(0);
        if (!detalles[`${gramaje}-${mes}`]) detalles[`${gramaje}-${mes}`] = [];

        resumen[gramaje][mes] += cantidad;
        detalles[`${gramaje}-${mes}`].push({ ancho, cantidad });

        if (cantidad > 0) mesesConDatos[mes] = true;
      });

      // Cabecera solo con meses con datos
      meses.forEach((mes, i) => {
        if (mesesConDatos[i]) {
          const th = document.createElement('th');
          th.textContent = mes;
          encabezado.appendChild(th);
        }
      });

      // Crear filas
      Object.entries(resumen).forEach(([gramaje, cantidades]) => {
        const tieneDatos = cantidades.some((c, i) => mesesConDatos[i] && c > 0);
        if (!tieneDatos) return;

        const fila = document.createElement('tr');
        fila.innerHTML = `<td>${gramaje}</td>`;

        cantidades.forEach((cantidad, i) => {
          if (mesesConDatos[i]) {
            const celda = document.createElement('td');
            if (cantidad > 0) {
              celda.innerHTML = `<span style="cursor:pointer;color:#007BFF" onclick="mostrarModal('${gramaje}', ${i})">${cantidad}</span>`;
              totalesPorMes[i] += cantidad;
            } else {
              celda.textContent = "";
            }
            fila.appendChild(celda);
          }
        });

        tabla.appendChild(fila);
      });

      // Fila de totales
      const filaTotal = document.createElement('tr');
      filaTotal.innerHTML = `<td><strong>TOTAL</strong></td>`;
      mesesConDatos.forEach((activo, i) => {
        if (activo) {
          filaTotal.innerHTML += `<td><strong>${totalesPorMes[i]}</strong></td>`;
        }
      });
      tabla.appendChild(filaTotal);

      // Modal de detalles
      window.mostrarModal = function(gramaje, mesIndex) {
        const clave = `${gramaje}-${mesIndex}`;
        const elementos = detalles[clave] || [];
        detallesLista.innerHTML = elementos.map(e =>
          `<li>Ancho: ${e.ancho} - Cantidad: ${e.cantidad}</li>`).join('');
        modal.style.display = "flex";
      };

    })
    .catch(err => {
      console.error("Error al obtener los datos:", err);
      tabla.innerHTML = `<tr><td colspan="13">Error cargando datos</td></tr>`;
    });
</script>

</body>
</html>






<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Proyecciones Mensuales</title>



  <style>
 

    h2 {
      text-align: center;
      margin-top: 20px;
    }

    .contenedor-scroll {
      overflow-x: auto;
      margin: 20px;
      background-color: #fff;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
      white-space: nowrap;
    }

    th {
      background-color: #f4f4f4;
      font-weight: bold;
    }

    #proy_modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    #proy_modal .contenido {
      background: white;
      padding: 20px;
      border-radius: 10px;
      max-width: 500px;
      width: 90%;
    }

    #proy_modal button {
      margin-top: 10px;
      padding: 8px 16px;
      background-color: #007BFF;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <h2>Proyecciones Mensuales por Gramaje y Línea</h2>

  <div class="contenedor-scroll">
    <table id="proy_tabla" class="nowrap display responsive">
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

  <!-- Modal -->
  <div id="proy_modal">
    <div class="contenido">
      <h3>Detalles por mes</h3>
      <ul id="proy_detalles_lista"></ul>
      <button id="proy_cerrar">Cerrar</button>
    </div>
  </div>

  <script>
    function initProyecciones() {
      const proy_tablaBody = document.querySelector('#proy_tabla tbody');
      const proy_modal = document.getElementById('proy_modal');
      const proy_btnCerrar = document.getElementById('proy_cerrar');
      const proy_detalles = document.getElementById('proy_detalles_lista');

      proy_btnCerrar.onclick = () => proy_modal.style.display = "none";
      window.onclick = e => { if (e.target === proy_modal) proy_modal.style.display = "none"; };

      fetch('https://megawebsistem.com/admin/api/apiproyecciones')
        .then(res => res.ok ? res.json() : Promise.reject(`Status: ${res.status}`))
        .then(data => {
          if (!Array.isArray(data) || data.length === 0) {
            console.warn("⚠️ Sin datos desde la API.");
            return;
          }

          const resumen = {};
          const detallesMes = {};
          const totalesPorMes = Array(12).fill(0);

          data.forEach(item => {
            const fecha = new Date(item.fecha_consumo);
            const mes = fecha.getMonth(); // 0 = Enero
            const gramaje = item.gms;
            const linea = item.linea;
            const cantidad = parseFloat(item.cantidad) || 0;
            const ancho = item.ancho;

            const clave = `${gramaje}|${linea}`;

            if (!resumen[clave]) resumen[clave] = Array(12).fill(0);
            if (!detallesMes[`${clave}-${mes}`]) detallesMes[`${clave}-${mes}`] = [];

            resumen[clave][mes] += cantidad;
            detallesMes[`${clave}-${mes}`].push({ ancho, cantidad });
            totalesPorMes[mes] += cantidad;
          });

          Object.entries(resumen).forEach(([clave, cantidades]) => {
            const [gramaje, linea] = clave.split('|');
            const fila = document.createElement('tr');
            fila.innerHTML = `<td>${gramaje}</td><td>${linea}</td>`;
            let totalFila = 0;

            for (let i = 0; i < 12; i++) {
              const cantidad = cantidades[i] || 0;
              const celda = document.createElement('td');
              if (cantidad > 0) {
                celda.innerHTML = `<span style="cursor:pointer;color:#007BFF" onclick="proy_mostrarModal('${clave}', ${i})">${cantidad.toFixed(2)}</span>`;
                totalFila += cantidad;
              } else {
                celda.textContent = '';
              }
              fila.appendChild(celda);
            }

            fila.innerHTML += `<td><strong>${totalFila.toFixed(2)}</strong></td>`;
            proy_tablaBody.appendChild(fila);
          });

          const filaTotal = document.createElement('tr');
          filaTotal.innerHTML = `<td colspan="2"><strong>TOTAL</strong></td>`;
          let totalGeneral = 0;
          for (let i = 0; i < 12; i++) {
            const totalMes = totalesPorMes[i];
            filaTotal.innerHTML += `<td><strong>${totalMes.toFixed(2)}</strong></td>`;
            totalGeneral += totalMes;
          }
          filaTotal.innerHTML += `<td><strong>${totalGeneral.toFixed(2)}</strong></td>`;
          proy_tablaBody.appendChild(filaTotal);

          window.proy_mostrarModal = function(clave, mesIndex) {
            const lista = detallesMes[`${clave}-${mesIndex}`] || [];
            proy_detalles.innerHTML = lista.map(e => `<li>Ancho: ${e.ancho} - Cantidad: ${e.cantidad}</li>`).join('');
            proy_modal.style.display = "flex";
          };
        })
        .catch(err => {
          console.error("❌ Error al obtener datos:", err);
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
      initProyecciones();

      // Inicializar DataTable con opciones
      $('#proy_tabla').DataTable({
        responsive: true,
        paging: false,
        searching: false,
        info: false
      });
    });
  </script>
</body>
</html>
