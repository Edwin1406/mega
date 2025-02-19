<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<script>


document.querySelector(".borrar").addEventListener("click", () => {
    localStorage.removeItem("pedidosFiltrados");
    alert("Los datos filtrados se han eliminado de Local Storage.");
});




document.addEventListener("DOMContentLoaded",()=>{
    const pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados"))||[];

    cargarpedidos(pedidos);
 
})


function cargarpedidos(pedidos){
    pedidos.forEach(pedido=>{
        const{ id, nombre_pedido, cantidad, largo, ancho, alto, flauta, test, fecha_ingreso, fecha_entrega} = pedido;
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

        document.querySelector(".table__tbody").appendChild(row);
        
        

    })
}

</script>