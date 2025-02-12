<!--  id contador  -->
<div>edwin</div>
<pre id="contador"></pre>     
<!-- id pedidos  -->
<pre id="pedidos"></pre>




<script>

    document.addEventListener('DOMContentLoaded', () => {
        apitrimar();
    });



    async function apitrimar() {
        const url = "https://megawebsistem.com/admin/api/trimar";
        const respuesta = await fetch(url);
        const pedidos = await respuesta.json();
        pedidos.forEach(pedido => {
         console.log(pedido.largo);
        });
        console.log(pedidos);
    }



</script>