(function(){

    let test ={
        liner_id : '',
        pedido_id : '',
        pedido2_id : '',
        bobinaInterna_id : '',
        bobinaIntermedia_id : '',
        bobinaExterna_id : ''
        }
    
  
    // obtener datos del api de test
    async function ApiTest(){
        const {liner_id} = test;
        try {
            const url = `${location.origin}/admin/api/test?liner_id=${liner_id}`;
            const resultado = await fetch(url);
            const apitest = await resultado.json();
            // mostrarApiTest(apitest);
           console.log(apitest)
        } catch (e) {
          console.log(e);
            
        }
    
    }   
    
   




    async function ApiBobinas(){
        const {bobinaInterna_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobinas?bobinaInterna_id=${bobinaInterna_id}`;
            const resultado = await fetch(url);
            const apibobinas = await resultado.json();
            sumadegramaje(apibobinas);
           
        } catch (e) {
          console.log(e);
            
        }
    
    }

    async function ApiBobina_externa(){
        const {bobinaExterna_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobina_externa?bobinaExterna_id=${bobinaExterna_id}`;
            const resultado = await fetch(url);
            const apibobina_externa = await resultado.json();
            sumadegramaje(apibobina_externa);
           
           
        } catch (e) {
          console.log(e);
            
        }
    
    }
    async function ApiBobina_media(){
        const {bobinaIntermedia_id} = test;
        try {
            const url = `${location.origin}/admin/api/apibobina_media?bobinaIntermedia_id=${bobinaIntermedia_id}`;
            const resultado = await fetch(url);
            const apibobina_media = await resultado.json();
            sumadegramaje(apibobina_media);
           
        } catch (e) {
          console.log(e);
            
        }
    
    }

 
    let arrayBobinas = [];
    let arrayBobina_externa = [];
    let arrayBobina_media = [];

    function sumadegramaje(apibobinas){
        arrayBobinas.push(apibobinas.gramaje)
        console.log(arrayBobinas)
    }


    function sumadegramaje(apibobina_externa){
        arrayBobina_externa.push(apibobina_externa.gramaje)
        console.log(arrayBobina_externa)
    }

    function sumadegramaje(apibobina_media){
        arrayBobina_media.push(apibobina_media.gramaje)
        console.log(arrayBobina_media)
    }










    

    const pedidos = document.querySelectorAll('#pedido')

    // if(pedidos ){
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
        // console.log(test)
        ApiBobinas();
        ApiTest();
        ApiBobina_externa();
        ApiBobina_media();
    }

}


})();