

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
                if (corte2 < 0) continue;

                        if (!mejorCombinacionLocal || sobrante < mejorCombinacionLocal.sobrante) {
                            mejorCombinacionLocal = {
                                bobina,
                                pedidos: [pedido1, pedido2],
                                suma,
                                sobrante,
                                cavidad: "1<br>1",
                                corteP1: pedido1.cantidad,
                                corteP2: Math.max(0, parseInt(corte2)),
                                metrosLineales,
                            };
                        }
                    console.log(mejorCombinacionLocal);

            }

            }

        }

    }



});

</script>