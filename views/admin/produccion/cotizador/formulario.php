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
        // Convertir valores a números
        const largo = parseFloat(pedido.largo) || 0;
        const ancho = parseFloat(pedido.ancho) || 0;
        const alto = parseFloat(pedido.alto) || 0;
        // Calcular el largo correcto
        const largocalculado = (2 * alto) + (largo + 8);
        const anchocalculado = (2 * alto) + (ancho + 10+4);
        // remplazar el largo y ancho
        pedido.largo = largocalculado;
        pedido.ancho = anchocalculado;
        pedido.alto = 0;

    });

    console.log(pedidos);
}



</script>