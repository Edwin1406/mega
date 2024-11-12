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
        try {
            // Llamamos a cada API para obtener los datos
            const [bobinaInterna, bobinaExterna, bobinaMedia, test] = await Promise.all([
                ApiBobinas(),
                ApiBobina_externa(),
                ApiBobina_media(),
                ApiTest()
            ]);
    
            // Validamos el ancho de las bobinas y el gramaje
            const anchoInterna = parseFloat(bobinaInterna.ancho) || 0;
            const anchoExterna = parseFloat(bobinaExterna.ancho) || 0;
            const anchoMedia = parseFloat(bobinaMedia.ancho) || 0;
            const gramajeInterna = parseFloat(bobinaInterna.gramaje) || 0;
            const gramajeExterna = parseFloat(bobinaExterna.gramaje) || 0;
            const gramajeMedia = parseFloat(bobinaMedia.gramaje) || 0;
            
            // Verificar que todas las bobinas tengan el mismo ancho
            if (anchoInterna !== anchoExterna || anchoInterna !== anchoMedia) {
                Swal.fire({
                    title: "Error de Ancho",
                    text: "Las bobinas deben tener el mismo ancho.",
                    icon: "error",
                    confirmButtonText: "Entendido"
                });
                return;
            }
            
            // Calculamos el gramaje total si el ancho es válido
            const gramajeTotal = gramajeInterna + gramajeExterna + gramajeMedia;
    
            // Obtenemos el peso del test para la comparación
            const pesoTest = parseFloat(test.peso);
    
            // Verificamos el gramaje total
            if (gramajeInterna > 0 && gramajeExterna > 0 && gramajeMedia > 0) {
                if (pesoTest === gramajeTotal) {
                    console.log("Gramaje total:", gramajeTotal);
                    document.getElementById("gramaje_total").value = gramajeTotal;
                    return gramajeTotal;
                } else {
                    Swal.fire({
                        title: "Gramaje no coincide",
                        text: `Gramaje recomendado para el test ${test.test} : Int: ${test.liner_interno}gr, Media: ${test.liner_medio}gr, Externo: ${test.liner_externo}gr`,
                        icon: "error",
                        iconColor: "#ff0000",
                        confirmButtonText: "Entendido",
                        confirmButtonColor: "#3085d6",
                        background: "#f8d7da",
                        color: "#721c24",
                        customClass: {
                            popup: 'swal-wide'
                        },
                    });
                    return;
                }
            } else {
                console.log("Aún no se han seleccionado todas las bobinas necesarias.");
            }
    
        } catch (error) {
            console.error("Error al obtener los datos de las bobinas:", error);
            Swal.fire({
                title: "Error",
                text: "Hubo un problema al obtener los datos de las bobinas. Inténtalo de nuevo.",
                icon: "error",
                confirmButtonText: "Entendido"
            });
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
    }

}
    }


})();