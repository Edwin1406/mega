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


<style>
    /* body {
      font-family: Arial, sans-serif;
      padding: 20px;
    } */
    table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin-top: 30px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 14px;
  color: #333;
}

th {
  background: #2c3e50;
  color: #ecf0f1;
  text-transform: uppercase;
  padding: 12px;
  text-align: center;
  position: sticky;
  top: 0;
  z-index: 2;
}

td {
  padding: 10px;
  background: #ffffff;
  border-bottom: 1px solid #e0e0e0;
  text-align: center;
  transition: background-color 0.2s ease;
}

th{
  font-weight: bold;
  text-align: center;
  color: black;
}

tr:hover td {
  background: #f9f9f9;
}

tr:nth-child(even) td {
  background: #f4f8fb;
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

tfoot td {
  background: #dfe6e9;
  font-weight: bold;
  text-transform: uppercase;
}

td:hover {
  cursor: pointer;
  background-color: #dfefff !important;
}

h1 {
  font-size: 24px;
  color: #2c3e50;
  margin-bottom: 10px;
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
    width: 450px;
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
  </style>
</head>
<body>
  <h1>INGRESOS</h1>
  <table id="tabla-gramajes">
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
    <tbody>
      <!-- Se llenará dinámicamente -->
    </tbody>
  </table>

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
        const gramaje = item.gramaje;
        const linea = item.linea ? item.linea.toUpperCase().trim() : '';
        const fechaStr = item.arribo_planta;

        // ❌ Excluir líneas específicas
        if (linea === 'MICRO - BLANCO' || linea === 'PERIODICO') return;

        // ❌ Excluir fechas inválidas
        if (!fechaStr || fechaStr === "0000-00-00") return;

        const fecha = new Date(fechaStr.replace(/-/g, '/'));
        if (isNaN(fecha.getTime())) {
          console.warn(`⚠️ Fecha inválida ignorada: ${fechaStr}`);
          return;
        }

        const mes = fecha.getMonth();
        if (isNaN(mes)) return;

        const cantidad = parseFloat(item.cantidad.toString().replace(',', '').replace(' ', '')) || 0;
        const key = `${gramaje}-${mes}`;

        if (!resumenPorGramaje[gramaje]) resumenPorGramaje[gramaje] = Array(12).fill(0);
        resumenPorGramaje[gramaje][mes] += cantidad;
        totalesMensuales[mes] += cantidad;

        if (!detallePorClave[key]) detallePorClave[key] = [];
        detallePorClave[key].push({
          ancho: item.ancho,
          cantidad: cantidad.toFixed(3),
          fecha: fechaStr
        });
      });





      const tbody = document.querySelector('#tabla-gramajes tbody');
      tbody.innerHTML = ''; // Limpiar tabla

      let totalGeneral = 0;

      Object.entries(resumenPorGramaje).forEach(([gramaje, meses]) => {
        const row = document.createElement('tr');
        const total = meses.reduce((sum, val) => sum + val, 0);
        totalGeneral += total;

        // Buscar línea para este gramaje
        let lineaEncontrada = '';
        for (const item of datosOriginales) {
          const linea = item.linea ? item.linea.toUpperCase().trim() : '';
          if (item.gramaje == gramaje && linea !== 'MICRO - BLANCO' && linea !== 'PERIODICO') {
            lineaEncontrada = linea;
            break;
          }
        }

        let html = `<td class="highlight">${gramaje}</td><td>${lineaEncontrada}</td>`;
        meses.forEach((cant, mesIdx) => {
          const key = `${gramaje}-${mesIdx}`;
          html += `<td onclick="mostrarDetalles('${key}')">${cant.toFixed(3)}</td>`;
        });
        html += `<td><strong>${total.toFixed(3)}</strong></td>`;

        row.innerHTML = html;
        tbody.appendChild(row);
      });


      // Fila de totales mensuales
      const rowTotales = document.createElement('tr');
      let htmlTotales = `<td><strong>Total</strong></td><td></td>`;
      totalesMensuales.forEach(val => {
        htmlTotales += `<td><strong>${val.toFixed(3)}</strong></td>`;
      });

      htmlTotales += `<td><strong>${totalGeneral.toFixed(3)}</strong></td>`;
      rowTotales.innerHTML = htmlTotales;
      rowTotales.style.background = "#f0f0f0";
      rowTotales.style.fontWeight = "bold";
      tbody.appendChild(rowTotales);

      // Mostrar detalles en modal
      window.mostrarDetalles = (key) => {
        const lista = document.getElementById('detalles');
        lista.innerHTML = '';
        const detalles = detallePorClave[key] || [];

        if (detalles.length === 0) {
          lista.innerHTML = '<li>No hay detalles disponibles.</li>';
        } else {
          detalles.forEach((item, i) => {
            const li = document.createElement('li');
            li.textContent = `#${i + 1} → Ancho: ${item.ancho} | Cantidad: ${item.cantidad} | Fecha: ${item.fecha}`;

            const anchoNumerico = parseInt(item.ancho);
            if (anchoNumerico === 1100) {
              li.classList.add('ancho-1100');
            } else if (anchoNumerico === 1880) {
              li.classList.add('ancho-1880');
            }

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
      const tbody = document.querySelector('#tabla-gramajes tbody');
      tbody.innerHTML = '<tr><td colspan="13">Error al cargar datos</td></tr>';
    }



  }

  cargarDatos();
</script>














