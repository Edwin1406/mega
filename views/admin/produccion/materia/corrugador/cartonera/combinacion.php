<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>






<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];
    console.log(pedidos);
});

</script>