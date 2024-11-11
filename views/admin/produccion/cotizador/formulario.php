


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">En desarrollo</legend>



 
    <div class="formulario__campo">
        <label class="formulario__label" for="liner_test"> Escoja el Test</label>
        <select
            class="formulario__select"
            id="liner_test"
            name="liner_id">
            <option  disabled selected>-- Seleccione --</option>
            
            <?php foreach($tests as $test): ?>
              
                    <option  <?php echo s($test===$test->id)? 'selected':'' ?> value="
                        <?php echo s($test->id); ?>">
                        <?php echo  'Ect: ',s($test->ect) ,
                        ' Test: ', s($test->test),
                        ' ---',
                        ' Liner Ext: ', s($test->liner_externo),
                        ' ---',
                        ' Liner Med: ', s($test->liner_medio),
                        ' ---',
                        ' Liner Int: ', s($test->liner_interno),
                        ' ---',
                        ' Peso: ', s($test->peso)
                        ?>

                    </option>
                 
                <?php endforeach; ?>
        </select>
      
    </div>







    <div class="formulario__campo">
        <label class="formulario__label" for="pedido">Pedido 1</label>
        <select
            class="formulario__select"
            id="pedido"
            name="pedido_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach($pedidos as $pedido): ?>
                <?php if ($pedido->estado === 'PENDIENTE'): // Mostrar solo pendientes ?>
                <option <?php echo s($pedido===$pedido->id)? 'selected':'' ?> value="<?php echo s($pedido->id); ?>"><?php echo s($pedido->cliente),' Largo : ', s($pedido->largo) ,' x',' Ancho : ', s($pedido->ancho) ,' ', s($pedido->estado); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>

    


    <div class="formulario__campo">
        <label class="formulario__label" for="pedido">Pedido 2</label>
        <select
            class="formulario__select"
            id="pedido"
            name="pedido2_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach($pedidos as $pedido): ?>
                <?php if ($pedido->estado === 'PENDIENTE'): // Mostrar solo pendientes ?>
                <option <?php echo s($pedido===$pedido->id)? 'selected':'' ?> value="<?php echo s($pedido->id); ?>"><?php echo s($pedido->cliente),' Largo : ', s($pedido->largo) ,' x',' Ancho : ', s($pedido->ancho) ,' ', s($pedido->estado); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>

    






    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_interna">Bobina interna</label>
        <select
            class="formulario__select"
            id="bobina_interna"
            name="bobinaInterna_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            
            <?php foreach($bobinas as $bobina): ?>
                <?php if ($bobina->tipo_papel === 'BOBINA INTERNA'): // Mostrar solo pendientes ?>
                    <option <?php echo s($bobina===$bobina->id)? 'selected':'' ?> value="<?php echo s($bobina->id); ?>"><?php echo   s($bobina->tipo_papel) ,' Ancho:', s($bobina->ancho),' Gramaje : ', s($bobina->gramaje)?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_intermedia">Bobina media</label>
        <select
            class="formulario__select"
            id="bobina_intermedia"
            name="bobinaIntermedia_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            
            <?php foreach($bobinas as $bobina): ?>
                <?php if ($bobina->tipo_papel === 'BOBINA MEDIA'): // Mostrar solo pendientes ?>
                <option <?php echo s($bobina===$bobina->id)? 'selected':'' ?> value="<?php echo s($bobina->id); ?>"><?php echo  s($bobina->tipo_papel) ,' Ancho:', s($bobina->ancho),' Gramaje : ', s($bobina->gramaje)?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>
    

    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_exterior">Bobina externa</label>
        <select
            class="formulario__select"
            id="bobina_exterior"
            name="bobinaExterna_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            
            <?php foreach($bobinas as $bobina): ?>
                <?php if ($bobina->tipo_papel === 'BOBINA EXTERNA'): // Mostrar solo pendientes ?>
                    <option <?php echo s($bobina===$bobina->id)? 'selected':'' ?> value="<?php echo s($bobina->id); ?>"><?php echo  s($bobina->tipo_papel) ,' Ancho:', s($bobina->ancho),' Gramaje : ', s($bobina->gramaje)?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>


   

    
    <div class="formulario__campo">
        <label class="formulario__label" for="num_piezas">Numero de cavidades</label>
        <input
            type="text"
            name="num_piezas"
            id="num_piezas"
            class="formulario__input"
            placeholder="num_piezas "
            value="<?php echo $papel->num_piezas ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="posicion_cuchilla">Posicion de cuchillas</label>
        <input
            type="text"
            name="posicion_cuchilla"
            id="posicion_cuchilla"
            class="formulario__input"
            placeholder="posicion_cuchilla del papel"
            value="<?php echo $papel->posicion_cuchilla ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Desperdicio</label>
        <input
            type="text"
            name="desperdicio"
            id="desperdicio"
            class="formulario__input"
            placeholder="desperdicio del papel"
            value="<?php echo $papel->desperdicio ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_total">Gramaje total</label>
        <input
            type="text"
            name="gramaje_total"
            id="gramaje_total"
            class="formulario__input"
            placeholder="gramaje_total del papel"
            value="<?php echo $papel->gramaje_total ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="estado_combinacion">Estado de combinacion</label>
        <input
            type="text"
            name="estado_combinacion"
            id="estado_combinacion"
            class="formulario__input"
            placeholder="estado_combinacion del papel"
            value="<?php echo $papel->estado_combinacion ?? '' ?>">
    </div>


</fieldset>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Cobertura de Bobinas</title>
</head>
<body>
    <h2>Simulador de Cobertura de Bobinas</h2>
    <div id="resultados"></div>

    <script>
        // URLs de las APIs
        const apiPedidosUrl = 'https://serviacrilico.com/admin/api/apipedidos';
        const apiBobinasUrl = 'https://serviacrilico.com/admin/api/apibobina_media';

        // Función para obtener los anchos de pedidos pendientes desde la API
        async function obtenerPedidosPendientes() {
            try {
                const response = await fetch(apiPedidosUrl);
                const data = await response.json();
                return data
                    .filter(pedido => pedido.estado === "PENDIENTE")
                    .map(pedido => parseInt(pedido.ancho));
            } catch (error) {
                console.error("Error al obtener pedidos:", error);
                return [];
            }
        }

        // Función para obtener bobinas desde la API y aplicar el ajuste de -30 mm para refile
        async function obtenerBobinas() {
            try {
                const response = await fetch(apiBobinasUrl);
                const data = await response.json();
                // Aplicar el ajuste de refile de -30 mm
                return data.map(bobina => parseInt(bobina.ancho) - 30);
            } catch (error) {
                console.error("Error al obtener bobinas:", error);
                return [];
            }
        }

        // Función para calcular la cobertura y la cantidad de bobinas necesarias
        async function calcularCobertura() {
            const pedidos = await obtenerPedidosPendientes();
            const bobinas = await obtenerBobinas();
            let resultados = '';
            let pedidosPendientes = [...pedidos]; // Copia del arreglo de pedidos
            let pedidosCubiertos = []; // Para marcar los pedidos que ya han sido cubiertos

            // Iterar sobre cada bobina
            bobinas.forEach(bobina => {
                let bobinasNecesarias = 0;
                let detallesCobertura = []; // Para almacenar detalles de los pedidos cubiertos por cada bobina

                // Mientras queden pedidos pendientes, intentamos cubrirlos
                while (pedidosPendientes.length > 0) {
                    let pedidosCubiertosEstaBobina = []; // Para almacenar los pedidos cubiertos en esta bobina
                    let bobinaDisponible = bobina; // Restamos el ancho de la bobina conforme se vayan agregando pedidos
                    let cubiertoEnEstaBobina = false;

                    // Buscar combinaciones para cubrir la bobina con 2 pedidos
                    for (let i = 0; i < pedidosPendientes.length; i++) {
                        let pedidoActual = pedidosPendientes[i];

                        if (pedidosCubiertos.includes(pedidoActual)) {
                            // Si el pedido ya fue cubierto, lo saltamos
                            continue;
                        }

                        for (let j = i + 1; j < pedidosPendientes.length; j++) {
                            let siguientePedido = pedidosPendientes[j];
                            if (pedidosCubiertos.includes(siguientePedido)) {
                                // Si el segundo pedido ya fue cubierto, lo saltamos
                                continue;
                            }

                            // Si la suma de ambos pedidos es menor o igual al ancho de la bobina
                            if (pedidoActual + siguientePedido <= bobina) {
                                // Los pedidos se pueden cubrir juntos
                                pedidosCubiertosEstaBobina.push(pedidoActual, siguientePedido);
                                pedidosCubiertos.push(pedidoActual, siguientePedido); // Marcamos ambos pedidos como cubiertos
                                pedidosPendientes.splice(i, 1); // Eliminar el primer pedido
                                pedidosPendientes.splice(j - 1, 1); // Eliminar el segundo pedido (ajustamos el índice)
                                cubiertoEnEstaBobina = true;
                                break; // Salir del bucle si encontramos una combinación válida
                            }
                        }

                        if (cubiertoEnEstaBobina) break; // Si ya cubrimos la bobina, dejamos de buscar más combinaciones
                    }

                    // Si no se cubrieron 2 pedidos en esta bobina, buscar una más grande
                    if (!cubiertoEnEstaBobina) {
                        let siguienteBobina = bobinas.find(b => b > bobina && b >= pedidosPendientes[0]);
                        if (siguienteBobina) {
                            bobina = siguienteBobina;
                        } else {
                            // Si no hay bobinas más grandes, cubrir el siguiente pedido individualmente
                            let pedidoIndividual = pedidosPendientes[0];
                            pedidosCubiertos.push(pedidoIndividual);
                       
