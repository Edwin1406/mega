
<style>
  body {
      font-family: Arial, sans-serif;
      /* margin: 20px; */
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

<!-- <h2>CONBINACIONES QUE NO SE SI ESATRE BIEN  😂🤣</h2> -->
<table>
  <thead>
      <tr>
          <th>Numero. combo</th>
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
  <tbody>
      <!-- Aquí se agregarán los datos dinámicamente -->
  </tbody>
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

// Calcular variaciones por pedido
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

// Generar todas las combinaciones posibles entre pedidos
function generarTodasLasCombinaciones(pedidos) {
    let combinaciones = [];

    for (let i = 0; i < pedidos.length - 1; i++) {
        for (let j = i + 1; j < pedidos.length; j++) {
            const p1 = pedidos[i];
            const p2 = pedidos[j];

            p1.variaciones.forEach(var1 => {
                p2.variaciones.forEach(var2 => {
                    const total_ancho = var1.ancho_utilizado + var2.ancho_utilizado;

                    // Encontrar mejor bobina para esta combinación
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

// Encontrar la mejor bobina para un ancho dado
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

// Eliminar combinaciones inválidas o duplicadas
function filtrarCombosUnicos(combinaciones) {
    const idsVistos = new Set();
    const combosFinales = [];

    combinaciones.forEach(combo => {
        const id1 = combo.pedido_1.id;
        const id2 = combo.pedido_2.id;

        if (!idsVistos.has(id1) && !idsVistos.has(id2)) {
            idsVistos.add(id1);
            idsVistos.add(id2);
            combosFinales.push(combo);
        }
    });

    return combosFinales;
}

// Mostrar resultados en tabla
function mostrarResultadosEnTabla(combos) {
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = '';

    combos.forEach(combo => {
        const tr1 = document.createElement('tr');
        tr1.innerHTML = `
            <td rowspan="2">Combo ${combo.comboNumero}</td>
            <td>${combo.pedido_1.id}</td>
            <td>${combo.pedido_1.nombre_pedido}</td>
            <td>${combo.pedido_1.largo}</td>
            <td>${combo.pedido_1.cavidad}</td>
            <td>${combo.pedido_1.cortes}</td>
            <td>${combo.pedido_1.cantidad}</td>
            <td>${combo.pedido_1.cantidad_producida}</td>
            <td>${combo.pedido_1.cantidad_faltante}</td>
            <td>${combo.pedido_1.metros_lineales}</td>
            <td>${combo.pedido_1.ancho_utilizado}</td>
            <td>${combo.pedido_1.porcentaje}</td>
            <td rowspan="2">${combo.total_ancho}</td>
            <td rowspan="2">${combo.mejorBobina}</td>
            <td rowspan="2">${combo.sobrante}</td>
        `;

        const tr2 = document.createElement('tr');
        tr2.innerHTML = `
            <td>${combo.pedido_2.id}</td>
            <td>${combo.pedido_2.nombre_pedido}</td>
            <td>${combo.pedido_2.largo}</td>
            <td>${combo.pedido_2.cavidad}</td>
            <td>${combo.pedido_2.cortes}</td>
            <td>${combo.pedido_2.cantidad}</td>
            <td>${combo.pedido_2.cantidad_producida}</td>
            <td>${combo.pedido_2.cantidad_faltante}</td>
            <td>${combo.pedido_2.metros_lineales}</td>
            <td>${combo.pedido_2.ancho_utilizado}</td>
            <td>${combo.pedido_2.porcentaje}</td>
        `;

        tbody.appendChild(tr1);
        tbody.appendChild(tr2);
    });
}

// Conteo de bobinas usadas
function contarBobinas(combos) {
    const conteo = {};

    combos.forEach(combo => {
        const bobina = combo.mejorBobina;
        if (bobina) {
            conteo[bobina] = (conteo[bobina] || 0) + 1;
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
    const mejoresCombos = filtrarCombosUnicos(combinaciones);

    // Mostrar resultados
    mostrarResultadosEnTabla(mejoresCombos);
    const conteo = contarBobinas(mejoresCombos);
    mostrarConteoBobinas(conteo);
}

document.addEventListener("DOMContentLoaded", main);

</script>