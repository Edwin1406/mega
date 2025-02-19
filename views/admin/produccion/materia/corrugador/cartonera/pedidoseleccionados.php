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




</script>