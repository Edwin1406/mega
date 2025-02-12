<!--  id contador  -->
<div>edwin</div>
<pre id="contador"></pre>     
<!-- id pedidos  -->
<pre id="pedidos"></pre>




<script>

    document.addEventListener('DOMContentLoaded', () => {
        apitrimar();
        anchoylargo();
    });



    async function apitrimar() {
        const url = "https://megawebsistem.com/admin/api/trimar";
        const respuesta = await fetch(url);
        const pedidos = await respuesta.json();
       return pedidos;
    }


    async function anchoylargo() {
        const pedidos = await apitrimar();
        pedidos.forEach(pedido => {
            const { ancho, largo } = pedido;
            const anchoLargo = `Ancho: ${ancho} Largo: ${largo}`;
            const contador = document.querySelector('#contador');
            contador.textContent = anchoLargo;
        });
    }


</script>