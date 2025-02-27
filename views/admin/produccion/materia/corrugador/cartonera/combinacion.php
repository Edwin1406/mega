

<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];

    const bobinas = [1880, 1100];
    const refile = 30;

    for(const bobina of bobinas) {
        const disponible =bobina-refile;
        console.log(disponible);

        for(let i=0; i< pedidos.length; i++) {
            const pedidoActual = pedidos[i];
            for(let j=i+1;j< pedidos.length; j++ ){
                const pedidoSiguiente = pedidos[j];
                const suma = pedidoActual + pedidoSiguiente;
                if(suma <= disponible) {
                    console.log(pedidoActual, pedidoSiguiente);
                }

            }

        }

    }



});

</script>