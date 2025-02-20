<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<div id="pedidosFiltrados"></div>




<script>
/// 1️⃣ Obtener los pedidos del localStorage
const pedidosGuardados = JSON.parse(localStorage.getItem("pedidos")) || [];

// 2️⃣ Agrupar los pedidos por ID (Combo)
const pedidosAgrupados = pedidosGuardados.reduce((grupos, pedido) => {
    if (!grupos[pedido.id]) {
        grupos[pedido.id] = [];
    }
    grupos[pedido.id].push(pedido);
    return grupos;
}, {});

// 3️⃣ Convertir objeto en array y agrupar en duplas
const ids = Object.keys(pedidosAgrupados);
const duplas = [];

for (let i = 0; i < ids.length; i += 2) {
    const combo1 = pedidosAgrupados[ids[i]];
    const combo2 = pedidosAgrupados[ids[i + 1]] || []; // Si no hay pareja, se deja vacío
    duplas.push([combo1, combo2]);
}

// 4️⃣ Mostrar en consola las duplas creadas
console.log("Duplas de combos:", duplas);

// 5️⃣ Mostrar en la pantalla las duplas
const mostrarDuplas = (duplas) => {
    const contenedor = document.getElementById("pedidosFiltrados");
    
    if (!contenedor) {
        console.error("Error: No se encontró el elemento con ID 'pedidosFiltrados'.");
        return;
    }

    contenedor.innerHTML = ""; // Limpiar contenido antes de agregar nuevos pedidos

    duplas.forEach((dupla, index) => {
        const divDupla = document.createElement("div");
        divDupla.innerHTML = `<h2>Dupla ${index + 1}</h2>`;
        contenedor.appendChild(divDupla);

        dupla.forEach(combo => {
            const divCombo = document.createElement("div");
            divCombo.innerHTML = `<h3>Combo ${combo[0]?.id || "N/A"}</h3>`;
            divDupla.appendChild(divCombo);

            combo.forEach(pedido => {
                const divPedido = document.createElement("div");
                divPedido.textContent = `Pedido: ${pedido.nombre_pedido} - Cantidad: ${pedido.cantidad}`;
                divCombo.appendChild(divPedido);
            });
        });
    });
};

// 6️⃣ Llamar a la función para mostrar en pantalla
mostrarDuplas(duplas);


</script>