(function(){
    const maquinaInput = document.getElementById('#maquina_id');
    if(maquinaInput){
        let maquinas= [];
        let maquinasFiltradas = [];
        obtenerMaquinas();

        async function obtenerMaquinas(){
            const url = 'http://localhost:3000/maquinas';
            const respuesta = await fetch(url);
            maquinas = await respuesta.json();
            console.log(maquinas);
        }

    }
})