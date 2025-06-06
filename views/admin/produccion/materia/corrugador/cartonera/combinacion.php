<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Optimizador de Bobinas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      margin-top: 20px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #007bff;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <h2>Combinaciones Optimizadas</h2>
  <table>
    <thead>
      <tr>
        <th>Número Combo</th>
        <th>ID</th>
        <th>Pedido</th>
        <th>Largo</th>
        <th>Cavidad</th>
        <th>Cortes</th>
        <th>Cantidad</th>
        <th>Producida</th>
        <th>Faltante</th>
        <th>Metros Lineales</th>
        <th>Ancho Utilizado</th>
        <th>Porcentaje</th>
        <th>Total Ancho</th>
        <th>Mejor Bobina</th>
        <th>Sobrante</th>
      </tr>
    </thead>
    <tbody id="tabla-body"></tbody>
  </table>
  <div id="resultadoBobinas"></div>

  <script>
    const bobinas = [1700, 1880];
    const trim = 0;
    const cavidades = [1, 2, 3];

    // Cargar pedidos desde localStorage
    function cargarPedidos() {
      return JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];
    }

    // Calcular todas las variaciones por pedido
    function calcularVariaciones(pedido) {
      return cavidades.map(cavidad => {
        const cantidad = pedido.cantidad;
        const cortes = Math.ceil(cantidad / cavidad);
        const cantidad_producida = cortes * cavidad;
        const cantidad_faltante = cantidad - cantidad_producida;
        const metros_lineales = Math.floor(((cantidad_producida * pedido.largo) / cavidad) / 1000);
        const ancho_utilizado = Math.ceil(pedido.ancho * cavidad);
        const porcentaje = cantidad_faltante === cantidad ? 100 : Math.floor((cantidad_faltante * 100) / cantidad);

        return {
          ...pedido,
          cavidad,
          cortes,
          cantidad_producida,
          cantidad_faltante,
          metros_lineales,
          ancho_utilizado,
          porcentaje
        };
      });
    }

    // Generar combinaciones entre pedidos
    function generarTodasLasCombinaciones(pedidos) {
      let combinaciones = [];

      for (let i = 0; i < pedidos.length - 1; i++) {
        for (let j = i + 1; j < pedidos.length; j++) {
          const p1 = pedidos[i];
          const p2 = pedidos[j];

          p1.variaciones.forEach(var1 => {
            p2.variaciones.forEach(var2 => {
              const total_ancho = var1.ancho_utilizado + var2.ancho_utilizado;

              const { mejorBobina, sobrante } = encontrarMejorBobina(total_ancho);

              if (mejorBobina !== null && sobrante >= 0) {
                combinaciones.push({
                  comboNumero: combinaciones.length + 1,
                  pedido_1: var1,
                  pedido_2: var2,
                  total_ancho,
                  mejorBobina,
                  sobrante: sobrante - trim
                });
              }
            });
          });
        }
      }

      return combinaciones;
    }

    // Encontrar mejor bobina según el ancho necesario
    function encontrarMejorBobina(anchoNecesario) {
      let mejorBobina = null;
      let menorSobrante = Infinity;

      bobinas.forEach(bobina => {
        const sobrante = bobina - anchoNecesario;
        if (sobrante >= 0 && sobrante < menorSobrante) {
          menorSobrante = sobrante;
          mejorBobina = bobina;
        }
      });

      return {
        mejorBobina,
        sobrante: menorSobrante
      };
    }

    // Trim individual: procesar pedidos sin pareja
    function trimIndividual(pedidosSinPareja) {
      return pedidosSinPareja.map(pedido => {
        const variaciones = calcularVariaciones(pedido);
        const mejorVar = variaciones.reduce((a, b) => {
          const aBobina = encontrarMejorBobina(a.ancho_utilizado);
          const bBobina = encontrarMejorBobina(b.ancho_utilizado);
          return aBobina.sobrante < bBobina.sobrante ? a : b;
        });

        const { mejorBobina, sobrante } = encontrarMejorBobina(mejorVar.ancho_utilizado);

        return {
          comboNumero: `Indiv ${pedido.id}`,
          pedido_1: {
            id: pedido.id,
            nombre: pedido.nombre_pedido,
            ancho_utilizado: mejorVar.ancho_utilizado,
            cantidad: mejorVar.cantidad,
            cavidad: mejorVar.cavidad,
            largo: mejorVar.largo,
            cortes: mejorVar.cortes,
            cantidad_producida: mejorVar.cantidad_producida,
            cantidad_faltante: mejorVar.cantidad_faltante,
            metros_lineales: mejorVar.metros_lineales,
            porcentaje1: mejorVar.porcentaje
          },
          pedido_2: {
            id: null,
            nombre: 'Único',
            ancho_utilizado: 0,
            cantidad: 0,
            cavidad: 0,
            largo: 0,
            cortes: 0,
            cantidad_producida: 0,
            cantidad_faltante: 0,
            metros_lineales: 0,
            porcentaje2: 0
          },
          total_ancho: mejorVar.ancho_utilizado,
          mejorBobina,
          sobrante
        };
      });
    }

    // Mostrar los resultados en la tabla
    function mostrarResultadosEnTabla(combos) {
      const tbody = document.getElementById("tabla-body");
      tbody.innerHTML = '';

      combos.forEach(combo => {
        const tr1 = document.createElement('tr');
        tr1.innerHTML = `
          <td rowspan="2">Combo ${combo.comboNumero}</td>
          <td>${combo.pedido_1.id}</td>
          <td>${combo.pedido_1.nombre}</td>
          <td>${combo.pedido_1.largo}</td>
          <td>${combo.pedido_1.cavidad}</td>
          <td>${combo.pedido_1.cortes}</td>
          <td>${combo.pedido_1.cantidad}</td>
          <td>${combo.pedido_1.cantidad_producida}</td>
          <td>${combo.pedido_1.cantidad_faltante}</td>
          <td>${combo.pedido_1.metros_lineales}</td>
          <td>${combo.pedido_1.ancho_utilizado}</td>
          <td>${combo.pedido_1.porcentaje1}</td>
          <td rowspan="2">${combo.total_ancho}</td>
          <td rowspan="2">${combo.mejorBobina}</td>
          <td rowspan="2">${combo.sobrante}</td>
        `;

        const tr2 = document.createElement('tr');
        tr2.innerHTML = `
          <td>${combo.pedido_2.id || ''}</td>
          <td>${combo.pedido_2.nombre || ''}</td>
          <td>${combo.pedido_2.largo || ''}</td>
          <td>${combo.pedido_2.cavidad || ''}</td>
          <td>${combo.pedido_2.cortes || ''}</td>
          <td>${combo.pedido_2.cantidad || ''}</td>
          <td>${combo.pedido_2.cantidad_producida || ''}</td>
          <td>${combo.pedido_2.cantidad_faltante || ''}</td>
          <td>${combo.pedido_2.metros_lineales || ''}</td>
          <td>${combo.pedido_2.ancho_utilizado || ''}</td>
          <td>${combo.pedido_2.porcentaje2 || ''}</td>
        `;

        tbody.appendChild(tr1);
        tbody.appendChild(tr2);
      });
    }

    // Contar bobinas usadas
    function contarBobinas(combos) {
      const conteo = {};
      combos.forEach(combo => {
        if (combo.mejorBobina) {
          conteo[combo.mejorBobina] = (conteo[combo.mejorBobina] || 0) + 1;
        }
      });
      return conteo;
    }

    // Mostrar conteo de bobinas
    function mostrarConteoBobinas(conteo) {
      const resultadoDiv = document.getElementById("resultadoBobinas");
      let html = "<h3>Conteo de bobinas:</h3><ul>";
      Object.entries(conteo).forEach(([bobina, count]) => {
        html += `<li><strong>${bobina}:</strong> ${count}</li>`;
      });
      html += "</ul>";
      resultadoDiv.innerHTML = html;
    }

    // Función principal
    function main() {
      const pedidosOriginales = cargarPedidos();

      // Agregar variaciones a cada pedido
      const pedidosConVariaciones = pedidosOriginales.map(pedido => ({
        ...pedido,
        variaciones: calcularVariaciones(pedido)
      }));

      // Generar combinaciones
      const combinaciones = generarTodasLasCombinaciones(pedidosConVariaciones);

      // Filtrar combinaciones únicas
      const idsVistos = new Set();
      const mejoresCombos = [];
      combinaciones.sort((a, b) => a.sobrante - b.sobrante);

      combinaciones.forEach(combo => {
        if (!idsVistos.has(combo.pedido_1.id) && !idsVistos.has(combo.pedido_2.id)) {
          idsVistos.add(combo.pedido_1.id);
          idsVistos.add(combo.pedido_2.id);
          mejoresCombos.push(combo);
        }
      });

      // Procesar pedidos sin pareja
      const todosLosPedidosIds = new Set(pedidosOriginales.map(p => p.id));
      const pedidosSinPareja = [...todosLosPedidosIds].filter(id => !idsVistos.has(id)).map(id =>
        pedidosOriginales.find(p => p.id === id)
      );

      const combosIndividuales = trimIndividual(pedidosSinPareja);
      const todosLosCombos = [...mejoresCombos, ...combosIndividuales];

      // Mostrar resultados
      mostrarResultadosEnTabla(todosLosCombos);
      const conteo = contarBobinas(todosLosCombos);
      mostrarConteoBobinas(conteo);
    }

    document.addEventListener("DOMContentLoaded", main);
  </script>
</body>
</html>