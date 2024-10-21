(function(){
    const maquinaInput = document.querySelector('#maquina_id');
    if(maquinaInput){
        let maquinas= [];
        let maquinasFiltradas = [];
        obtenerMaquinas();

        maquinaInput.addEventListener('input',buscarMaquinas);

        async function obtenerMaquinas(){
            const url = `${location.origin}/admin/api/maquinas`;;
            const respuesta = await fetch(url);
            resultado = await respuesta.json();
            formatearMaquinas(resultado);
        }


        function formatearMaquinas(arrayMaquinas=[]){
            maquinas = arrayMaquinas.map(maquina => {
                return {
                    nombre: `${maquina.nombre.trim()}`,
                    id: maquina.id
                }
            });

            console.log(maquinas);

        }


        function buscarMaquinas(e){
           const busqueda = e.target.value;

            console.log(busqueda);
        }

    }
})();

