(function(){
 document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
  });
    
  function iniciarApp() {
    desgloza();
  }

async function pedidoss() {
    try {
        const url = 'https://serviacrilico.com/admin/api/allpedidos2';
        const resultado = await fetch(url);
        const pedidos = await resultado.json();
        return pedidos;

    } catch (e) {
        console.log(e);
    }
}



async function filtradoPendientes() {
    const verificar = await pedidoss(); 
    return verificar.filter(pedido => pedido.estado_pedido === "pendiente");
}


function extraerDimensiones(nombreProducto) {
    const regexDimensiones = /(\d+)(?:X|x)(\d+)\s*(?:X|x)?\s*(\d+)?\s*(CM|cm)?/;
    const regexTipo = /\b(K\/K|B\/B|T\/T|B\/k)\b/i;
    const regexTest = /\bTEST (\d+)\b/i;
    const regexFlauta = /\b(C|B)\b/i; // Ahora detecta flauta C o B

    // Extraer dimensiones
    const [_, largo, ancho, alto = 'N/A'] = regexDimensiones.exec(nombreProducto) || [];

    // Extraer tipo, test y flauta
    const tipo = (regexTipo.exec(nombreProducto) || [])[1] || 'N/A';
    const test = (regexTest.exec(nombreProducto) || [])[1] || 'N/A';
    const flauta = (regexFlauta.exec(nombreProducto) || [])[1] || 'C';

    return {
        largo: largo || 'N/A',
        ancho: ancho || 'N/A',
        alto: alto,
        tipo,
        test,
        flauta 
    };
}

// Función para desglosar los pedidos pendientes
async function desgloza() {
    let peddidoDesglosado = [];
    const pedidosPendientes = await filtradoPendientes(); 
    pedidosPendientes.forEach(pedido => {
        const dimensiones = extraerDimensiones(pedido.nombre_producto);
        const pedidoDesglosado = {
            id: pedido.id,
            nombre_cliente: pedido.nombre_cliente,
            numero_pedido: pedido.numero_pedido,
            fecha_pedido: pedido.fecha_pedido,
            plazo_entrega: pedido.plazo_entrega,
            nombre_producto: pedido.nombre_producto,
            cantidad: pedido.cantidad,
            subtotal: pedido.subtotal,
            total: pedido.total,
            largo: dimensiones.largo,
            ancho: dimensiones.ancho,
            alto: dimensiones.alto,
            tipo: dimensiones.tipo, 
            test: dimensiones.test, 
            flauta: dimensiones.flauta, 
            
        };

        peddidoDesglosado.push(pedidoDesglosado);
        
    });
    document.getElementById('pedidos').innerHTML = JSON.stringify(peddidoDesglosado, null, 2);
    document.getElementById('contador').innerHTML = peddidoDesglosado.length;

    console.log(peddidoDesglosado.length);
    
}






})();