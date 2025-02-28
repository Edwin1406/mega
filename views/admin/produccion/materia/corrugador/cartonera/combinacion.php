

<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];

    const bobinas = [1880, 1100];
    const refile = 30;

    for(const bobina of bobinas) {
        const disponible =bobina-refile;
       
        console.log(disponible);

    }



});

</script>