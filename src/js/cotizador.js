(function(){


    obtenerTest();




    // obtener datos del api de test
    
    async function obtenerTest(){
        const url = `${location.origin}/admin/api/test`;
        const respuesta = await fetch(url);
        resultado = await respuesta.json();
        datosTest(resultado);
        
    }

 







    let test ={
    liner_id : '',
    pedido_id : '',
    pedido2_id : '',
    bobinaInterna_id : '',
    bobinaIntermedia_id : '',
    bobinaExterna_id : ''
    }

    const pedidos = document.querySelectorAll('#pedido')

    // if(pedidos ){
    const  liner = document.querySelector('[name="liner_id"]')
    const pedido = document.querySelector('[name="pedido_id"]')
    const pedido2 = document.querySelector('[name="pedido2_id"]')
    const bobinaInterna = document.querySelector('[name="bobinaInterna_id"]')
    const bobinaIntermedia = document.querySelector('[name="bobinaIntermedia_id"]')
    const bobinaExterna = document.querySelector('[name="bobinaExterna_id"]')

    liner.addEventListener('change', datosTest)
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
    }


    }

    function datosTest (e){
       const {id} = resultado;
       console.log(id)
        test[e.target.name] = e.target.value.trim()
        console.log(test)
    }





})();