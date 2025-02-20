<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<div id="pedidosFiltrados"></div>




<script>
// 1️⃣ Obtener los pedidos del localStorage
const pedidosGuardados = JSON.parse(localStorage.getItem("pedidos")) || [];

// 2️⃣ Agrupar los pedidos por ID (Combo)
const pedidosAgrupados = pedidosGuardados.reduce((grupos, pedido) => {
    if (!grupos[pedido.id]) {
        grupos[pedido.id] = [];
    }
    grupos[pedido.id].push(pedido);
    return grupos;
}, {});

// 3️⃣ Mostrar pedidos agrupados en la consola
console.log("Pedidos agrupados por combo:", pedidosAgrupados);

// 4️⃣ Mostrar en la pantalla en formato de combos
const mostrarPedidosAgrupados = (pedidosAgrupados) => {
    const contenedor = document.getElementById("pedidosFiltrados");
    contenedor.innerHTML = ""; // Limpiar contenido

    Object.keys(pedidosAgrupados).forEach(idCombo => {
        const divCombo = document.createElement("div");
        divCombo.innerHTML = `<h3>Combo ${idCombo}</h3>`;
        contenedor.appendChild(divCombo);

        pedidosAgrupados[idCombo].forEach(pedido => {
            const divPedido = document.createElement("div");
            divPedido.textContent = `Pedido: ${pedido.nombre_pedido} - Cantidad: ${pedido.cantidad}`;
            divCombo.appendChild(divPedido);
        });
    });
};

// 5️⃣ Llamar a la función para mostrar en pantalla
mostrarPedidosAgrupados(pedidosAgrupados);


</script>