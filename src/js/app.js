(function(){
    const maquinaInput = document.querySelector('#maquina_id');
    if(maquinaInput){
        let maquinas= [];
        let maquinasFiltradas = [];
        obtenerMaquinas();

        async function obtenerMaquinas(){
            const url = `${location.origin}/admin/api/maquinas`;;
            const respuesta = await fetch(url);
            resultado = await respuesta.json();
            formatearMaquinas(resultado);
        }


        function formatearMaquinas(arrayMaquinas=[]){
            maquinas = arrayMaquinas.map(maquina => {
                return {
                    id: maquina.id,
                    nombre: maquina.nombre
                }
            });
            console.log(maquinas);
        }

    }
})();

