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
        console.log(`Largo Calculado: ${largocalculado}`);

        // Mostrar los valores en pantalla
        const anchoLargo = `Ancho: ${ancho} Largo: ${largo} Alto: ${alto}`;
        const contador = document.querySelector('#contador');

        if (contador) {
            contador.textContent = anchoLargo;
        } else {
            console.error('Elemento #contador no encontrado en el DOM.');
        }
    });
}



</script>