(function() {
    let test = {
        liner_id: '',
        pedido_id: '',
        pedido2_id: '',
        bobinaInterna_id: '',
        bobinaIntermedia_id: '',
        bobinaExterna_id: ''
    };

    document.addEventListener('DOMContentLoaded', function() {
        iniciarApp();
    });

    function iniciarApp() {
        // ApiTest();
    }

    // Obtener datos de la API de test
    async function ApiTest() {
        try {
            const url = `${location.origin}/admin/api/test?liner_id=${test.liner_id}`;
            const resultado = await fetch(url);
            const apitest = await resultado.json();
            console.log(apitest);
        } catch (e) {
            console.log(e);
        }
    }

    // Obtener datos de la API de bobinas
    async function ApiBobinas() {
        try {
            const url = `${location.origin}/admin/api/apibobinas?bobinaInterna_id=${test.bobinaInterna_id}`;
            const resultado = await fetch(url);
            const apibobinas = await resultado.json();
            console.log(apibobinas);
        } catch (e) {
            console.log(e);
        }
    }

    // Seleccionar elementos de la interfaz
    const liner = document.querySelector('[name="liner_id"]');
    const pedido = document.querySelector('[name="pedido_id"]');
    const pedido2 = document.querySelector('[name="pedido2_id"]');
    const bobinaInterna = document.querySelector('[name="bobinaInterna_id"]');
    const bobinaIntermedia = document.querySelector('[name="bobinaIntermedia_id"]');
    const bobinaExterna = document.querySelector('[name="bobinaExterna_id"]');

    // Agregar event listeners a los elementos seleccionados
    liner.addEventListener('change', busqueda);
    pedido.addEventListener('change', busqueda);
    pedido2.addEventListener('change', busqueda);
    bobinaInterna.addEventListener('change', busqueda);
    bobinaIntermedia.addEventListener('change', busqueda);
    bobinaExterna.addEventListener('change', busqueda);

    // Función de búsqueda
    function busqueda(e) {
        // Evitar que los pedidos sean iguales
        if ((e.target.name === 'pedido_id' || e.target.name === 'pedido2_id') && pedido.value === pedido2.value) {
            pedido2.value = '';
            Swal.fire("Pedido ya seleccionado", "No puede seleccionar el mismo pedido", "error");
            return;
        }

        // Actualizar el valor en el objeto `test`
        test[e.target.name] = e.target.value.trim();
        console.log(test);

        // Llamar a ApiBobinas siempre
     

        // Llamar a ApiTest solo si `liner_id` tiene un valor
        if (test.liner_id||test.bobinaInterna_id) {
            ApiTest();
            ApiBobinas();
        }
    }
})();
