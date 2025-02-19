<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>



<div class="dashboard__contenedor">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Largo</th>
                <th>Ancho</th>
                <th>Alto</th>
                <th>Flauta</th>
                <th>Test</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Entrega</th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <!-- Las filas se agregarán aquí -->
        </tbody>
    </table>
</div>



<script>


document.querySelector(".borrar").addEventListener("click", () => {
    localStorage.removeItem("pedidosFiltrados");
    alert("Los datos filtrados se han eliminado de Local Storage.");
});




document.addEventListener("DOMContentLoaded",()=>{
    const pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados"))||[];

    cargarpedidos(pedidos);
 
})


function cargarpedidos(pedidos) {
    const tbody = document.querySelector(".table__tbody");
    
    if (!tbody) {
        console.error("No se encontró el elemento .table__tbody en el DOM");
        return;
    }

    pedidos.forEach(pedido => {
        const { id, nombre_pedido, cantidad, largo, ancho, alto, flauta, test, fecha_ingreso, fecha_entrega } = pedido;
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
        `;
        tbody.appendChild(row);
    });
}


</script>