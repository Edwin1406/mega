

<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];

    const bobinas = [1880, 1100];
    const refile = 30;
    const Cavidades= [1, 2,3,4];
    for(const bobina of bobinas) {
        const disponible =bobina-refile;
        // pedidos 
       
        for(const pedido of pedidos) {
            const {id, cantidad, fecha, nombre_pedido, ancho, largo, corte, cavidades} = pedido;
            console.log(cavidades);

    }


    }

});

</script>