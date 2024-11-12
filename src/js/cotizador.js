(function(){

    let test ={
        liner_id : '',
        pedido_id : '',
        pedido2_id : '',
        bobinaInterna_id : '',
        bobinaIntermedia_id : '',
        bobinaExterna_id : ''
        }
    
    // obtener datos del api de pedidos
    async function ApiPedidos(){
        const {pedido_id} = test;
        
        try {
            const url = `${location.origin}/admin/api/pedidos?pedido_id=${pedido_id}`;
            const resultado = await fetch(url);
            const apipedidos = await resultado.json();
            console.log(apipedidos);
            return apipedidos
        } catch (e) {
            console.log(e);
                
        }
    } 
    async function ApiPedido2(){
        const {pedido2_id} = test;
        
        try {
            const url = `${location.origin}/admin/api/apipedido2?pedido2_id=${pedido2_id}`;
            const resultado = await fetch(url);
            const apipedido2 = await resultado.json();
            console.log(apipedido2);
            return apipedido2
        } catch (e) {
            console.log(e);
                
        }
    } 

    async function AllBobinas(){
        try {   
            const url = `${location.origin}/admin/api/allbobinas`;
            const resultado = await fetch(url);
            const allbobinas = await resultado.json();
            console.log(allbobinas);
            return allbobinas
        } catch (error) {
            console.log(error);
        }
    }



    // obtener datos del api de test
    async function ApiTest(){
        const {liner_id} = test;
        try {
            const url = `${location.origin}/admin/api/test?liner_id=${liner_id}`;
            const resultado = await fetch(url);
            const apitest = await resultado.json();
            // copiarDatos(apitest);
           console.log(apitest)
           return apitest
        } catch (e) {
          console.log(e);
            
        }
    
    }   
 

    // obtener datos del api de bobinas

    async function ApiBobinas(){
        const {bobinaInterna_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobinas?bobinaInterna_id=${bobinaInterna_id}`;
            const resultado = await fetch(url);
            const apibobinas = await resultado.json();
            console.log(apibobinas);
           return apibobinas
           
        } catch (e) {
          console.log(e);
            
        }
    
    }


    async function ApiBobina_externa(){
        const {bobinaExterna_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobina_externa?bobinaExterna_id=${bobinaExterna_id}`;
            const resultado = await fetch(url);
            const apibobinasExterna = await resultado.json();
            console.log(apibobinasExterna);
            // mostrarApibobinas(apibobinas);
            return apibobinasExterna
           
        } catch (e) {
          console.log(e);
            
        }
    
    }
    async function ApiBobina_media(){
        const {bobinaIntermedia_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobina_media?bobinaIntermedia_id=${bobinaIntermedia_id}`;
            const resultado = await fetch(url);
            const apibobinasMedia = await resultado.json();
            console.log(apibobinasMedia);
            // mostrarApibobinas(apibobinas);
            return apibobinasMedia
           
        } catch (e) {
          console.log(e);
            
        }
    
    }


    // FUNCION PARA MOSTRAR ALERTA 

    function mostrarAlerta(titulo,mensaje,tipo,color,fondo){
        Swal.fire({ 
            title: titulo,
            text: mensaje,
            icon: tipo,
            iconColor: color,  // Color del ícono
            confirmButtonText: "Entendido",
            confirmButtonColor: "#3085d6",
            background: fondo, // Color de fondo del cuadro de alerta
            color: "#000000", // Color del texto
            customClass: {
                popup: 'swal-wide'  // Clase CSS personalizada para ajustar el ancho
            },
        });
       
    }

    // FUNCION PARA SUMAR EL GRAMAJE DE LAS BOBINAS Y COMPARAR CON EL TEST

    async function sumargramaje() {
       // Llamamos a cada API para obtener los datos
        const bobinaInterna = await ApiBobinas();
        const bobinaExterna = await ApiBobina_externa();
        const bobinaMedia = await ApiBobina_media();
        const test = await ApiTest();

        // Convertimos el gramaje de cada bobina a número y validamos que se hayan recibido correctamente
        const gramajeInterna = parseFloat(bobinaInterna.gramaje) || 0;
        const gramajeExterna = parseFloat(bobinaExterna.gramaje) || 0;
        const gramajeMedia = parseFloat(bobinaMedia.gramaje) || 0;

        // Calculamos el gramaje total
        const gramajeTotal = gramajeInterna + gramajeExterna + gramajeMedia;

        // Obtenemos el peso del test para la comparación
        const pesoTest = parseFloat(test.peso);

        // Verificamos que todas las bobinas tengan un gramaje válido antes de comparar
        if (gramajeInterna > 0 && gramajeExterna > 0 && gramajeMedia > 0) {
            verificarAnchoBobinas();
            if (pesoTest === gramajeTotal) {
                console.log("Gramaje total:", gramajeTotal);
                document.getElementById("gramaje_total").value = gramajeTotal;
                mostrarAlerta('Gramaje correcto',`El gramaje total de las bobinas seleccionadas es: ${gramajeTotal} gr`,'success','#28a745','#d4edda');

                return gramajeTotal;
            } else {
                
                mostrarAlerta('Gramaje no coincide',`Gramaje recomendado para el test ${test.test} : Int: ${test.liner_interno}` + "gr, Media: " + test.liner_medio + "gr, Externo: " + test.liner_externo + "gr",'error','#ff0000','#f8d7da');

                document.getElementById("gramaje_total").value = "";
                
                return;
            }
        } else {
            console.log("Aún no se han seleccionado todas las bobinas necesarias.");
        }

    }

   
        async function verificarAnchoBobinas() {
  
            // Llamamos a cada API para obtener los datos
        const bobinaInterna = await ApiBobinas();
        const bobinaExterna = await ApiBobina_externa();
        const bobinaMedia = await ApiBobina_media();
       // Obtenemos los anchos de las bobinas
        const anchoInterno = parseFloat(bobinaInterna.ancho) || 0;
        const anchoMedia = parseFloat(bobinaMedia.ancho) || 0;
        const anchoExterno = parseFloat(bobinaExterna.ancho) || 0;

        // Verificamos que los campos de ancho no estén vacíos
        if (anchoInterno && anchoMedia && anchoExterno) {
            // Comprobamos si los anchos son iguales
            if (anchoInterno === anchoMedia && anchoMedia === anchoExterno) {
             // Mostrar la alerta después de 30 segundos
                setTimeout(() => {
                    mostrarAlerta('Ancho correcto', `Los anchos de las bobinas seleccionadas son iguales: ${anchoInterno} cm`, 'success', '#28a745', '#d4edda');
                    
                }, 4000); 


            } else {
                setTimeout(() => {
                    mostrarAlerta('Anchos incorrectos', `Los anchos de las bobinas seleccionadas no coinciden: Int: ${anchoInterno} cm, Media: ${anchoMedia} cm`,'error','#ff0000','#f8d7da');
                
                    // const bobinaInterna = document.querySelector('[name="bobinaInterna_id"]')
                    // const bobinaIntermedia = document.querySelector('[name="bobinaIntermedia_id"]')
                    // const bobinaExterna = document.querySelector('[name="bobinaExterna_id"]')
                    // bobinaInterna.value = ''
                    // bobinaIntermedia.value = ''
                    // bobinaExterna.value = ''
                }, 4000); 

            }
        } else {
            console.log("Error: Los anchos internos y medios deben estar llenos");
        }

    }


    // funcion para sumar los anchos de los peddios 

    // async function sumarAnchosPedidos() {
    //     const anchoPedido1 = await ApiPedidos();
    //     const anchoPedido2 = await ApiPedido2();
    //     const allbobinas = await AllBobinas();
    
    //     const pedido1 = parseFloat(anchoPedido1.ancho) || 0;
    //     const pedido2 = parseFloat(anchoPedido2.ancho) || 0;
    
    //     const anchoTotal = pedido1 + pedido2;
    
    //     console.log("Ancho total de los pedidos:", anchoTotal);
    
    //     // Filtrar las bobinas que cumplen las condiciones: ancho >= anchoTotal y <= 2000
    //     const bobinasFiltradas = allbobinas.filter(bobina => {
    //         const anchoBobina = parseFloat(bobina.ancho);
    //         return anchoBobina >= anchoTotal && anchoBobina <= 2000;
    //     });
    
    //     // Eliminar duplicados usando un Set para los anchos
    //     const bobinasSinDuplicados = [];
    //     const anchosVistos = new Set();
    
    //     for (let bobina of bobinasFiltradas) {
    //         const anchoBobina = parseFloat(bobina.ancho);
    //         if (!anchosVistos.has(anchoBobina)) {
    //             bobinasSinDuplicados.push(bobina);
    //             anchosVistos.add(anchoBobina);
    //         }
    //     }
    
    //     // Ordenar las bobinas por la diferencia más pequeña con el anchoTotal
    //     const bobinasOrdenadas = bobinasSinDuplicados.sort((a, b) => {
    //         const diferenciaA = Math.abs(parseFloat(a.ancho) - anchoTotal);
    //         const diferenciaB = Math.abs(parseFloat(b.ancho) - anchoTotal);
    //         return diferenciaA - diferenciaB;
    //     });
    
    //     // Tomar las tres primeras bobinas de la lista ordenada
    //     const tresBobinasIdeales = bobinasOrdenadas.slice(0, 3);
    
    //     // Restar 30mm a cada bobina ideal como refile
    //     tresBobinasIdeales.forEach(bobina => {
    //         bobina.ancho = parseFloat(bobina.ancho) - 30;
    //     });
    
    //     if (tresBobinasIdeales.length > 0) {
               
    //         const bobinaideal = document.getElementById("bobinaIdealAncho");
    //         bobinaideal.innerHTML = tresBobinasIdeales.map(bobina => {
    //         return `<option value="${bobina.id}">${bobina.ancho} mm  sin refile:${bobina.ancho+30}</option>`;
    //         } );
    //     } else {
    //         console.log("No se encontraron bobinas que cumplan con los requisitos.");
    //     }
    // }
    
    

    async function sumarAnchosPedidos() {
        const anchoPedido1 = await ApiPedidos();
        const anchoPedido2 = await ApiPedido2();
        const allbobinas = await AllBobinas();
    
        const pedido1 = parseFloat(anchoPedido1.ancho) || 0;
        const pedido2 = parseFloat(anchoPedido2.ancho) || 0;
    
        const anchoTotal = pedido1 + pedido2;
    
        console.log("Ancho total de los pedidos:", anchoTotal);
    
        // Filtrar las bobinas que cumplen las condiciones: ancho >= anchoTotal y <= 2000
        const bobinasFiltradas = allbobinas.filter(bobina => {
            const anchoBobina = parseFloat(bobina.ancho);
            return anchoBobina >= anchoTotal && anchoBobina <= 2000;
        });
    
        // Eliminar duplicados usando un Set para los anchos
        const bobinasSinDuplicados = [];
        const anchosVistos = new Set();
    
        for (let bobina of bobinasFiltradas) {
            const anchoBobina = parseFloat(bobina.ancho);
            if (!anchosVistos.has(anchoBobina)) {
                bobinasSinDuplicados.push(bobina);
                anchosVistos.add(anchoBobina);
            }
        }
    
        // Ordenar las bobinas por la diferencia más pequeña con el anchoTotal
        const bobinasOrdenadas = bobinasSinDuplicados.sort((a, b) => {
            const diferenciaA = Math.abs(parseFloat(a.ancho) - anchoTotal);
            const diferenciaB = Math.abs(parseFloat(b.ancho) - anchoTotal);
            return diferenciaA - diferenciaB;
        });
    
        // Seleccionar solo la primera bobina ideal y aplicar el refile de -30 mm
        const bobinaIdeal = bobinasOrdenadas[0];
        if (bobinaIdeal) {
            const bobinaideal = document.getElementById("bobinaIdealAncho");
            bobinaideal.innerHTML = tresBobinasIdeales.map(bobina => {
            return `<option value="${bobina.id}">${bobina.ancho} mm  sin refile:${bobina.ancho+30}</option>`;
            });
        } else {
            console.log("No se encontró una bobina que cumpla con los requisitos.");
        }
    }
    

   

 

    const pedidos = document.querySelector('#pedido')

    if(pedidos ){
    const  liner = document.querySelector('[name="liner_id"]')
    const pedido = document.querySelector('[name="pedido_id"]')
    const pedido2 = document.querySelector('[name="pedido2_id"]')
    const bobinaInterna = document.querySelector('[name="bobinaInterna_id"]')
    const bobinaIntermedia = document.querySelector('[name="bobinaIntermedia_id"]')
    const bobinaExterna = document.querySelector('[name="bobinaExterna_id"]')

    liner.addEventListener('change', busqueda)
    pedido.addEventListener('change', busqueda)
    pedido2.addEventListener('change', busqueda)
    bobinaInterna.addEventListener('change', busqueda)
    bobinaIntermedia.addEventListener('change', busqueda)
    bobinaExterna.addEventListener('change', busqueda)

    function busqueda (e){

    // los pedidos no pueden ser iguales
    if ((e.target.name === 'pedido_id' || e.target.name === 'pedido2_id') && pedido.value === pedido2.value) {
        pedido2.value = ''
        Swal.fire("Pedido ya seleccionado", "No puede seleccionar el mismo pedido", "error");
        return    

    }else{
        test[e.target.name] = e.target.value.trim()
        console.log(test)
        ApiBobinas();
        ApiTest();
        ApiBobina_externa();
        ApiBobina_media();
        sumargramaje();
        ApiPedidos();
        ApiPedido2();
        sumarAnchosPedidos();

    }

}
    }


})();