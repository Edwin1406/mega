

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
            const {id, cantidad, cliente, fecha, producto, ancho, largo, corte, cavidades} = pedido;
            const total = cantidad * cavidades;
            const totalBobinas = total / disponible;
            const totalBobinasRedondeado = Math.ceil(totalBobinas);
            const totalBobinasReales = totalBobinasRedondeado * disponible;
            const totalBobinasRealesCavidades = totalBobinasReales / cavidades;
            const totalBobinasRealesCavidadesRedondeado = Math.ceil(totalBobinasRealesCavidades);
            const totalBobinasRealesCavidadesRedondeado2 = Math.ceil(totalBobinasRealesCavidades/2);

            console.log(`
                Pedido: ${id}
                Cliente: ${cliente}
                Fecha: ${fecha}
                Producto: ${producto}
                Ancho: ${ancho}
                Largo: ${largo}
                Corte: ${corte}
                Cantidad: ${cantidad}
                Cavidades: ${cavidades}
                Total: ${total}
                Bobina: ${bobina}
                Disponible: ${disponible}
                Total Bobinas: ${totalBobinas}
                Total Bobinas Redondeado: ${totalBobinasRedondeado}
                Total Bobinas Reales: ${totalBobinasReales}
                Total Bobinas Reales Cavidades: ${totalBobinasRealesCavidades}
                Total Bobinas Reales Cavidades Redondeado: ${totalBobinasRealesCavidadesRedondeado}
                Total Bobinas Reales Cavidades Redondeado2: ${totalBobinasRealesCavidadesRedondeado2}
            `);

    }


    }

});

</script>