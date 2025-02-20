<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/corrugador/cartonera/combinacion">
        <i class="fa-regular fa-eye"></i>
        SIGUIENTE
    </a>
</div>



<div class="dashboard__contenedor">
    <table class="table">
        <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">ID</th>
                <th scope="col" class="table__th">Material</th>
                <th scope="col" class="table__th">Flauta</th>
                <th scope="col" class="table__th">Papeles</th>
                <th scope="col" class="table__th">%</th>
                <th scope="col" class="table__th">Descripción Papeles</th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <!-- Las filas se agregarán aquí dinámicamente -->
        </tbody>
    </table>
</div>

<script>
async function consumirAPI() {
    const url = "https://megawebsistem.com/admin/api/apipapel";

    try {
        const response = await fetch(url);
        const data = await response.json();

        console.log("Datos recibidos de la API:", data); // Verificar la estructura de los datos

        const tbody = document.querySelector(".table__tbody");
        tbody.innerHTML = ""; // Limpiar antes de agregar nuevos datos

        // Obtener pedidos filtrados desde localStorage
        let pedidosFiltrados = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];
        console.log("Pedidos filtrados desde localStorage:", pedidosFiltrados);

        // Extraer el primer pedido (si hay varios, solo toma el primero)
        let pedidoSeleccionado = pedidosFiltrados.length > 0 ? pedidosFiltrados[0] : null;

        if (!pedidoSeleccionado) {
            console.warn("No hay pedidos en localStorage.");
            tbody.innerHTML = "<tr><td colspan='6'>No hay pedidos disponibles</td></tr>";
            return;
        }

        let testPedido = String(pedidoSeleccionado.test).trim();
        let flautaPedido = String(pedidoSeleccionado.flauta).trim();
        console.log("Test del pedido seleccionado:", testPedido);
        console.log("Flauta del pedido seleccionado:", flautaPedido);

        // Buscar el material que tenga el mismo test (sin "K") y flauta que el pedido seleccionado
        let materialFiltrado = data.find(material => {
            let testMaterial = String(material.material).replace(/^K/, "").trim(); // Elimina la "K" si está al inicio
            return testMaterial === testPedido && String(material.flauta).trim() === flautaPedido;
        });

        console.log("Material filtrado encontrado:", materialFiltrado);
        localStorage.setItem("materialFiltrado", JSON.stringify(materialFiltrado));



        if (materialFiltrado) {
            materialFiltrado.papeles.forEach((papel, index) => {
                const row = document.createElement("tr");

                if (index === 0) {
                    row.innerHTML = `
                        <td rowspan="${materialFiltrado.papeles.length}">${materialFiltrado.id}</td>
                        <td rowspan="${materialFiltrado.papeles.length}">${materialFiltrado.material}</td> <!-- Muestra K250 -->
                        <td rowspan="${materialFiltrado.papeles.length}">${materialFiltrado.flauta}</td>
                        <td>${papel.codigo}</td>
                        <td>${papel.gramaje}</td>
                        <td>${papel.descripcion}</td>
                    `;
                } else {
                    row.innerHTML = `
                        <td>${papel.codigo}</td>
                        <td>${papel.gramaje}</td>
                        <td>${papel.descripcion}</td>
                    `;
                }

                tbody.appendChild(row);
            });
        } else {
            console.warn("No hay materiales que coincidan con el pedido seleccionado.");
            tbody.innerHTML = "<tr><td colspan='6'>No hay materiales disponibles</td></tr>";
        }
    } catch (error) {
        console.error("Error al obtener los datos:", error);
        document.querySelector(".table__tbody").innerHTML = 
            "<tr><td colspan='6'>Error al cargar los datos</td></tr>";
    }
}

// Llamar a la función para cargar los datos cuando la página se cargue
document.addEventListener("DOMContentLoaded", consumirAPI);





</script>
