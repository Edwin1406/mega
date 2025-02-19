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
    console.log(pedidos);
})

</script>