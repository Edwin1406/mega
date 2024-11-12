(function(){

    let test ={
        liner_id : '',
        pedido_id : '',
        pedido2_id : '',
        bobinaInterna_id : '',
        bobinaIntermedia_id : '',
        bobinaExterna_id : ''
        }
    

           
    // let copiaTest = []
    // let copiaBobinas = []
  
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
            if (pesoTest === gramajeTotal) {
                console.log("Gramaje total:", gramajeTotal);
                document.getElementById("gramaje_total").value = gramajeTotal;
                Swal.fire({ 
                    title: "Gramaje correcto",
                    text: `El gramaje total de las bobinas seleccionadas es: ${gramajeTotal} gr`,
                    icon: "success",
                    iconColor: "#28a745",  // Color del ícono
                    confirmButtonText: "Entendido",
                    confirmButtonColor: "#3085d6",
                    background: "#d4edda", // Color de fondo del cuadro de alerta
                    color: "#155724", // Color del texto
                    customClass: {
                        popup: 'swal-wide'  // Clase CSS personalizada para ajustar el ancho
                    },
                });


                return gramajeTotal;
            } else {
                
                Swal.fire({
                    title: "Gramaje no coincide",
                    text: `Gramaje recomendado para el test ${test.test} : Int: ${test.liner_interno}` + "gr, Media: " + test.liner_medio + "gr, Externo: " + test.liner_externo + "gr",
                    icon: "error",
                    iconColor: "#ff0000",  // Color del ícono
                    confirmButtonText: "Entendido",
                    confirmButtonColor: "#3085d6",
                    background: "#f8d7da", // Color de fondo del cuadro de alerta
                    color: "#721c24", // Color del texto
                    customClass: {
                        popup: 'swal-wide'  // Clase CSS personalizada para ajustar el ancho
                    },
                });
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

            // Verificamos que los campos de ancho no estén vacíos
            if (anchoInterno && anchoMedia) {
                // Comprobamos si los anchos son iguales
                if (anchoInterno === anchoMedia) {
                    Swal.fire({
                        title: "Anchos correctos",
                        text: `Los anchos de las bobinas seleccionadas son iguales: ${anchoInterno} cm`,
                        icon: "success",
                        iconColor: "#28a745",  // Color del ícono
                        confirmButtonText: "Entendido",
                        confirmButtonColor: "#3085d6",
                        background: "#d4edda", // Color de fondo del cuadro de alerta
                        color: "#155724", // Color del texto
                        customClass: {
                            popup: 'swal-wide'  // Clase CSS personalizada para ajustar el ancho
                        },
                    });
                } else {
                   Swal.fire({ 
                        title: "Anchos incorrectos",
                        text: `Los anchos de las bobinas seleccionadas no coinciden: Int: ${anchoInterno} cm, Media: ${anchoMedia} cm`,
                        icon: "error",
                        iconColor: "#ff0000",  // Color del ícono
                        confirmButtonText: "Entendido",
                        confirmButtonColor: "#3085d6",
                        background: "#f8d7da", // Color de fondo del cuadro de alerta
                        color: "#721c24", // Color del texto
                        customClass: {
                            popup: 'swal-wide'  // Clase CSS personalizada para ajustar el ancho
                        },
                    });
                }
            } else {
                console.log("Error: Los anchos internos y medios deben estar llenos");
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
        verificarAnchoBobinas();
    }

}
    }


})();