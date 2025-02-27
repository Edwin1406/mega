

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
               const otroPedido =pedidos[j];
            //    suma de anchos
            const suma = parseFloat(pedidoActual.ancho) + parseFloat(otroPedido.ancho);
            if(suma <= disponible){
                if (pedido2.cantidad < pedido1.cantidad) {
    [pedido1, pedido2] = [pedido2, pedido1];
}
                console.log(pedidoActual, otroPedido);

            }

            }

        }

    }



});

</script>