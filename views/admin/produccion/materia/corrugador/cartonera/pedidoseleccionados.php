<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<script>


document.querySelector(".borrar").addEventListener("click", () => {
    localStorage.removeItem("pedidosFiltrados");
    alert("Los datos filtrados se han eliminado de Local Storage.");
});

const pedidosFil = localStorage.getItem("pedidosFiltrados");

const pedidos = JSON.parse(pedidosFil);
console.log(pedidos);


// function muestra lista de pedidos en un tabla crear tabla con js
// con div 

crearHTML();
function crearHTML(){
    if(pedidos.length > 0){
        pedidos.foreach(pedido => {
            const row = document.createElement("div");
            row.classList.add("table__tr");
            row.innerHTML = `
                <div class="table__td">${pedido.id}</div>
                <div class="table__td">${pedido.nombre_pedido}</div>
                <div class="table__td">${pedido.cantidad}</div>
                <div class="table__td">${pedido.largo}</div>
                <div class="table__td">${pedido.ancho}</div>
                <div class="table__td">${pedido.alto}</div>
                <div class="table__td">${pedido.flauta}</div>
                <div class="table__td">${pedido.test}</div>
                <div class="table__td">${pedido.fecha_ingreso}</div>
                <div class="table__td">${pedido.fecha_entrega}</div>
            `;
            document.querySelector(".table__tbody").appendChild(row);
        });
    }
}


</script>