
   <!-- jQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <!-- JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


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
                        <?php echo 
                        ' Test: ', s($test->test),
                        ' Peso: ', s($test->peso)
                        ?>

                    </option>
                 
                <?php endforeach; ?>
        </select>

        <ul id="resultList"></ul>

    </div>



    <div class="formulario__campo">
        <label class="formulario__label" for="pedido">Pedido 1</label>
        <select
            class="formulario__select"
            id="pedido1"
            name="pedido_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach($pedidos as $pedido): ?>
                <?php if ($pedido->estado === 'PENDIENTE'): // Mostrar solo pendientes ?>
                <option <?php echo s($pedido===$pedido->id)? 'selected':'' ?> value="<?php echo s($pedido->id); ?>"><?php echo s($pedido->cliente),' Largo : ', s($pedido->largo) ,' x',' Ancho : ', s($pedido->ancho) ,' TEST: ',s($pedido->test) ,'  Cantidad :',s($pedido->cantidad); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>
<!-- <script>
     $(document).ready(function() {
        $('#pedido1').select2({
            placeholder: "-- Seleccione --",
            allowClear: false
        });

         // Evento para capturar la selección y mostrarla en consola
         $('#pedido1').on('change', function() {
                const selectedValue = $(this).val(); // Obtiene el valor seleccionado
                console.log("Valor seleccionado:", selectedValue);
            });

    });
</script> -->

    


    <div class="formulario__campo">
        <label class="formulario__label" for="pedido">Pedido 2</label>
        <?php echo s($totalPedidos) ?>
        <select
            class="formulario__select"
            id="pedido"
            name="pedido2_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach($pedidos as $pedido): ?>
                <?php if ($pedido->estado === 'PENDIENTE'): // Mostrar solo pendientes ?>
                <option <?php echo s($pedido===$pedido->id)? 'selected':'' ?> value="<?php echo s($pedido->id); ?>"><?php echo s($pedido->cliente),'    ',' Largo : ', s($pedido->largo) ,' x',' Ancho : ', s($pedido->ancho) , ' TEST: ',s($pedido->test) , '  Cantidad :' ,s($pedido->cantidad); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
            <p>El ancho de la bobina ideal es: <span id="bobinaIdealAncho">Cargando...</span></p>
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



<style>
 .swal-wide {
    width: 50% !important; /* Ancho del cuadro de alerta */
    height: 70% !important; /* Altura del cuadro de alerta */
    font-size: 18px; /* Tamaño del texto */
    padding: 20px; /* Espacio interior del cuadro de alerta */
}


</style>



<<h2>Resultados</h2>
<div id="resultado"></div>

<script>
   

   async function optimizar() {
    const bobinas = [1980, 1900]; // Tamaños disponibles de las bobinas
    const refile = 30; // Espacio reservado para el refile

    // Obtener los pedidos desde la API
    const pedidos = await AllPedidos(); // Cambié esto para obtener desde la API
    if (pedidos.length === 0) {
        alert('No se pudieron obtener pedidos desde la API.');
        return;
    }

    // Asegurarse de que los pedidos son números
    let pedidosNumeros = pedidos.map(pedido => parseInt(pedido.ancho, 10)).filter(Number); // Cambié const por let

    const objetoResultados = {
        resultados: [],
        pendientes: []
    };

    while (pedidosNumeros.length > 0) {
        let mejorCombinacion = null;

        // Ordenar pedidos de mayor a menor para optimizar el espacio
        pedidosNumeros.sort((a, b) => b - a);

        // Probar cada bobina para encontrar la combinación óptima
        for (let i = 0; i < bobinas.length; i++) {
            let bobinaDisponible = bobinas[i] - refile;

            // Buscar combinaciones de pedidos para la bobina
            let combinacion = [];
            let suma = 0;

            for (let j = 0; j < pedidosNumeros.length; j++) {
                if (suma + pedidosNumeros[j] <= bobinaDisponible) {
                    suma += pedidosNumeros[j];
                    combinacion.push(pedidosNumeros[j]);
                }

                if (suma === bobinaDisponible || suma + Math.min(...pedidosNumeros) > bobinaDisponible) {
                    break;
                }
            }

            const sobrante = bobinaDisponible - suma;

            // Evaluar si es la mejor combinación hasta ahora
            if (
                combinacion.length > 0 &&
                (!mejorCombinacion || sobrante < mejorCombinacion.sobrante)
            ) {
                mejorCombinacion = {
                    bobina: bobinas[i],
                    pedidos: combinacion,
                    sobrante: sobrante
                };
            }
        }

        // Si se encontró una combinación válida, asignar
        if (mejorCombinacion) {
            objetoResultados.resultados.push(mejorCombinacion);

            // Eliminar los pedidos asignados
            pedidosNumeros = pedidosNumeros.filter(
                pedido => !mejorCombinacion.pedidos.includes(pedido)
            );
        } else {
            // Si no se pudo asignar ningún pedido, añadir a pendientes
            objetoResultados.pendientes.push(...pedidosNumeros);
            break;
        }
    }

    // Mostrar los resultados
    mostrarResultados(objetoResultados);
    console.log("Resultados finales:", objetoResultados); // Mostrar el objeto en la consola
}

function mostrarResultados(objetoResultados) {
    const resultadoDiv = document.getElementById("resultado");
    resultadoDiv.innerHTML = "";

    let tablaHTML = `
        <table>
            <thead>
                <tr>
                    <th>Bobina</th>
                    <th>Pedidos Usados</th>
                    <th>Sobrante</th>
                </tr>
            </thead>
            <tbody>
    `;

    objetoResultados.resultados.forEach(resultado => {
        const claseSobrante = resultado.sobrante <= 10 ? "sobrante-optimo" : "";
        tablaHTML += `
            <tr>
                <td>${resultado.bobina}</td>
                <td>${resultado.pedidos.join(", ")}</td>
                <td class="${claseSobrante}">${resultado.sobrante}</td>
            </tr>
        `;
    });

    if (objetoResultados.pendientes.length > 0) {
        tablaHTML += `
            <tr>
                <td colspan="3" class="espera">A la espera de más pedidos: ${objetoResultados.pendientes.join(", ")}</td>
            </tr>
        `;
    }

    tablaHTML += `
            </tbody>
        </table>
    `;

    resultadoDiv.innerHTML = tablaHTML;
}

async function AllPedidos() {
    try {
        const url = `${location.origin}/admin/api/allpedidos`;
        const resultado = await fetch(url);
        const allpedidos = await resultado.json();
        console.log("Pedidos obtenidos desde la API:", allpedidos);
        return allpedidos;
    } catch (e) {
        console.error("Error al obtener los pedidos desde la API:", e);
        return [];
    }
}

// Llamar a la función optimizar cuando sea necesario
optimizar();











    function mostrarResultados(objetoResultados) {
        const resultadoDiv = document.getElementById("resultado");
        resultadoDiv.innerHTML = "";

        let tablaHTML = `
            <table>
                <thead>
                    <tr>
                        <th>Bobina</th>
                        <th>Pedidos Usados</th>
                        <th>Sobrante</th>
                    </tr>
                </thead>
                <tbody>
        `;

        objetoResultados.resultados.forEach(resultado => {
            const claseSobrante = resultado.sobrante <= 10 ? "sobrante-optimo" : "";
            tablaHTML += `
                <tr>
                    <td>${resultado.bobina}</td>
                    <td>${resultado.pedidos.join(", ")}</td>
                    <td class="${claseSobrante}">${resultado.sobrante}</td>
                </tr>
            `;
        });

        if (objetoResultados.pendientes.length > 0) {
            tablaHTML += `
                <tr>
                    <td colspan="3" class="espera">A la espera de más pedidos: ${objetoResultados.pendientes.join(", ")}</td>
                </tr>
            `;
        }

        tablaHTML += `
                </tbody>
            </table>
        `;

        resultadoDiv.innerHTML = tablaHTML;
    }

    async function AllPedidos() {
        try {
            const url = `${location.origin}/admin/api/allpedidos`;
            const resultado = await fetch(url);
            const allpedidos = await resultado.json();
            console.log("Pedidos obtenidos desde la API:", allpedidos);
            return allpedidos;
        } catch (e) {
            console.error("Error al obtener los pedidos desde la API:", e);
            return [];
        }
    }

    // Llamar a la función optimizar cuando sea necesario
    optimizar();
</script>
