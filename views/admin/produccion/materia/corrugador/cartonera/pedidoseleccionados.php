<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>



<div class="dashboard__contenedor">

    <table class="table">
        <thead class="table__thead">
            <tr>
                <th scope="col" class="table__th">ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Largo</th>
                <th>Ancho</th>
                <th>Alto</th>
                <th>Flauta</th>
                <th>Test</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Entrega</th>
                <th>Metros Cuadrados</th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <!-- Las filas se agregarán aquí -->
        </tbody>
    </table>
</div>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/corrugador/cartonera/dupla">
        <i class="fa-regular fa-eye"></i>
        SIGUIENTE
    </a>
</div>



<script>
document.querySelector(".borrar").addEventListener("click", () => {
    localStorage.removeItem("pedidosFiltrados");
    alert("Los datos filtrados se han eliminado de Local Storage.");
});

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];

    // Aplicar cálculos a todos los pedidos, no solo a los que contienen "CJ"
    pedidos = pedidos.map(pedido => {
        let largo = Number(pedido.largo) || 0;
        let ancho = Number(pedido.ancho) || 0;
        let cantidad = Number(pedido.cantidad) || 1;

        // Solo calcular metros cuadrados si el largo y el ancho son mayores que 0
        if (!pedido.metros_cuadrados || pedido.metros_cuadrados === "undefined") {
            if (largo > 0 && ancho > 0) {
                pedido.metros_cuadrados = ((largo * ancho * cantidad) / 10000).toFixed(2);
            } else {
                pedido.metros_cuadrados = "0.00"; // Evitar valores incorrectos
            }
        }

        return pedido;
    });

    // Guardar los pedidos actualizados en localStorage
    localStorage.setItem("pedidosFiltrados", JSON.stringify(pedidos));

    // Cargar pedidos actualizados en la interfaz
    cargarpedidos(pedidos);

    // Verificar si los valores fueron actualizados
    console.log("Pedidos actualizados:", pedidos);
});

function cargarpedidos(pedidos) {
    const tbody = document.querySelector(".table__tbody");

    if (!tbody) {
        console.error("No se encontró el elemento .table__tbody en el DOM");
        return;
    }

    tbody.innerHTML = ""; // Limpiar la tabla antes de cargar los datos

    pedidos.forEach(pedido => {
        const { id, nombre_pedido, cantidad, largo, ancho, alto, flauta, test, fecha_ingreso, fecha_entrega, metros_cuadrados } = pedido;
        const row = document.createElement("tr");
        row.innerHTML = `
            <td class="table__td">${id}</td>
            <td class="table__td">${nombre_pedido}</td>
            <td class="table__td">${cantidad}</td>
            <td class="table__td">${largo}</td>
            <td class="table__td">${ancho}</td>
            <td class="table__td">${alto}</td>
            <td class="table__td">${flauta}</td>
            <td class="table__td">${test}</td>
            <td class="table__td">${fecha_ingreso}</td>
            <td class="table__td">${fecha_entrega}</td>
            <td class="table__td">${metros_cuadrados} m²</td>
        `;
        tbody.appendChild(row);
    });
}


</script>