<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<div id="pedidosFiltrados"></div>




<script>
// 1️⃣ Obtener los pedidos desde localStorage
const pedidosGuardados = JSON.parse(localStorage.getItem("pedidos")) || [];

// 2️⃣ Definir los anchos de papel disponibles
const anchosDisponibles = [1600, 1700, 1800];

// 3️⃣ Agrupar pedidos por ID y calcular su ancho total y porcentaje de completado
const pedidosAgrupados = pedidosGuardados.reduce((grupos, pedido) => {
    if (!grupos[pedido.id]) {
        grupos[pedido.id] = { pedidos: [], anchoTotal: 0, completado: false };
    }
    grupos[pedido.id].pedidos.push(pedido);
    grupos[pedido.id].anchoTotal += pedido.ancho ? parseInt(pedido.ancho) : 0;
    grupos[pedido.id].completado = pedido.porcentaje === "100%"; // Verificar si el pedido ya está al 100%
    return grupos;
}, {});

// Convertir a array de objetos con su información
let combos = Object.keys(pedidosAgrupados).map(id => ({
    id,
    ...pedidosAgrupados[id]
}));

// 4️⃣ Separar pedidos completos y pendientes de trimado
let pedidosCompletos = combos.filter(combo => combo.completado);
let pedidosIncompletos = combos.filter(combo => !combo.completado);

// 5️⃣ Formar duplas optimizando el uso de papel SOLO con los incompletos
const duplas = [];
const usados = new Set();

for (let i = 0; i < pedidosIncompletos.length; i++) {
    if (usados.has(i)) continue; // Saltar si ya está en una dupla

    let mejorPareja = null;
    let menorDesperdicio = Infinity;

    for (let j = i + 1; j < pedidosIncompletos.length; j++) {
        if (usados.has(j)) continue;

        const anchoSuma = pedidosIncompletos[i].anchoTotal + pedidosIncompletos[j].anchoTotal;

        // Buscar el ancho de papel más cercano que minimice desperdicio
        const papelOptimo = anchosDisponibles.find(a => a >= anchoSuma);
        const desperdicio = papelOptimo ? papelOptimo - anchoSuma : Infinity;

        if (desperdicio < menorDesperdicio) {
            mejorPareja = j;
            menorDesperdicio = desperdicio;
        }
    }

    // Si encontró una pareja óptima, formar la dupla
    if (mejorPareja !== null) {
        duplas.push([pedidosIncompletos[i], pedidosIncompletos[mejorPareja]]);
        usados.add(i);
        usados.add(mejorPareja);
    } else {
        // Si no encontró pareja, el pedido incompleto va solo en una dupla
        duplas.push([pedidosIncompletos[i]]);
        usados.add(i);
    }
}

// 6️⃣ Mostrar en consola las duplas optimizadas
console.log("Pedidos COMPLETOS (No requieren trimado):", pedidosCompletos);
console.log("Pedidos pendientes de trimado:", pedidosIncompletos);
console.log("Duplas de pedidos incompletos optimizadas:", duplas);

// 7️⃣ Mostrar en la pantalla
const mostrarPedidos = (duplas, pedidosCompletos) => {
    const contenedor = document.getElementById("pedidosFiltrados");

    if (!contenedor) {
        console.error("Error: No se encontró el elemento con ID 'pedidosFiltrados'.");
        return;
    }

    contenedor.innerHTML = ""; // Limpiar contenido antes de agregar nuevos pedidos

    // Mostrar pedidos completados
    if (pedidosCompletos.length > 0) {
        const divCompletos = document.createElement("div");
        divCompletos.innerHTML = `<h2>Pedidos Completados ✅</h2>`;
        contenedor.appendChild(divCompletos);

        pedidosCompletos.forEach(combo => {
            const divCombo = document.createElement("div");
            divCombo.innerHTML = `<h3>Combo ${combo.id} - Ancho total: ${combo.anchoTotal} mm (100% completado)</h3>`;
            divCompletos.appendChild(divCombo);
        });
    }

    // Mostrar duplas de pedidos incompletos
    duplas.forEach((dupla, index) => {
        const divDupla = document.createElement("div");
        divDupla.innerHTML = `<h2>Dupla de Trimado ${index + 1}</h2>`;
        contenedor.appendChild(divDupla);

        dupla.forEach(combo => {
            const divCombo = document.createElement("div");
            divCombo.innerHTML = `<h3>Combo ${combo.id} - Ancho total: ${combo.anchoTotal} mm (Falta completar)</h3>`;
            divDupla.appendChild(divCombo);

            combo.pedidos.forEach(pedido => {
                const divPedido = document.createElement("div");
                divPedido.textContent = `Pedido: ${pedido.nombre_pedido} - Cantidad: ${pedido.cantidad} - Ancho: ${pedido.ancho} mm - ${pedido.porcentaje}`;
                divCombo.appendChild(divPedido);
            });
        });
    });
};

// 8️⃣ Llamar a la función para mostrar en pantalla
mostrarPedidos(duplas, pedidosCompletos);

</script>