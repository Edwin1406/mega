

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
                let pedido1 = pedidoActual;
                let pedido2 = otroPedido;
                if (pedido2.cantidad < pedido1.cantidad) {
                     [pedido1, pedido2] = [pedido2, pedido1];
                }
                const sobrante = disponible - suma;
                const metrosLineales = (pedido1.cantidad * pedido1.largo) / 1000;
                const corte2 = metrosLineales / (pedido2.largo / 1000);
                const corte1 = metrosLineales / (pedido1.largo / 1000);
                console.log(pedidos[i].id, pedidos[j].id, pedido1.id, pedido2.id, corte1, corte2, sobrante);

            }

            }

        }

    }



});

</script>