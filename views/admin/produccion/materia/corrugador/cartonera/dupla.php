<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<button class="borrar">
    clear
</button>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/corrugador/cartonera/dupla">
        <i class="fa-regular fa-eye"></i>
        SIGUIENTE
    </a>
</div>



<script>
document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];
    console.log(pedidos);
    consumirapi();
});





async function consumirapi(params) {
    const url = "https://megawebsistem.com/admin/api/apipapel";
    const response = await fetch(url);
    const data = await response.json();
    console.log(data);
}








</script>

