
const bobinas= [1600,1700];
const trim = 30;


// restar el trim a la bobina sin modificar el array original
const bobinasTrim = bobinas.map(bobina => bobina - trim);

// agregar de nuevo a bobina el array ya modificado
// console.log(bobinasTrim);
// console.log(bobinas);




const cavidades = [1,2,3];

// const pedidos = [
//     {
//         id: 6,
//         alto: 0,
//         ancho: 538,
//         cantidad: 1050,
//         fecha_entrega: "2025-02-27",
//         fecha_ingreso: "2025-02-10",
//         flauta: "C",
//         largo: 1530,
//         metros_cuadrados: "864.30",
//         nombre_pedido: "caja san jose ideal",
//         test: 250
//     },
//     {
//         id: 7,
//         alto: 0,
//         ancho: 493,
//         cantidad: 1050,
//         fecha_entrega: "2025-02-27",
//         fecha_ingreso: "2025-02-18",
//         flauta: "C",
//         largo: 1286,
//         metros_cuadrados: "667.05",
//         nombre_pedido: "caja tel celca",
//         test: 250
//     },
//     {
//         id: 8,
//         alto: 0,
//         ancho: 417,
//         cantidad: 3150,
//         fecha_entrega: "2025-02-27",
//         fecha_ingreso: "2025-02-18",
//         flauta: "C",
//         largo: 1230,
//         metros_cuadrados: "667.05",
//         nombre_pedido: "caja de prueba",
//         test: 250
//     },

//     {
//         id: 9,
//         alto: 0,
//         ancho: 417,
//         cantidad: 3150,
//         fecha_entrega: "2025-02-27",
//         fecha_ingreso: "2025-02-18",
//         flauta: "C",
//         largo: 1230,
//         metros_cuadrados: "667.05",
//         nombre_pedido: "caja de prueba",
//         test: 250
//     },

//     {
//         id: 10,
//         alto: 0,
//         ancho: 339,
//         cantidad: 1575,
//         fecha_entrega: "2025-02-27",
//         fecha_ingreso: "2025-02-18",
//         flauta: "C",
//         largo: 1230,
//         metros_cuadrados: "667.05",
//         nombre_pedido: "caja de 10",
//         test: 250
//     },

//     // {
//     //     id: 6,
//     //     alto: 0,
//     //     ancho: 1234,
//     //     cantidad: 1050,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 2220,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "CJ-TAPA TABACO JUMBO TIEMPO FLOWERS K/K TEST 250",
//     //     test: 250
//     // },
//     // {
//     //     id: 7,
//     //     alto: 0,
//     //     ancho: 668,
//     //     cantidad: 1200,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 1406,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "REG 21 CJ- FONDO TABACO USA BOUQUET 950X206X224 K/K TEST 250",
//     //     test: 250
//     // },
//     // {
//     //     id: 8,
//     //     alto: 0,
//     //     ancho: 979,
//     //     cantidad: 700,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 1688,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "CJ- TAPA TABACO 10 ECOROSES 992X 277 X344 K/K TEST 250	",
//     //     test: 250
//     // },
//     // {
//     //     id: 9,
//     //     alto: 0,
//     //     ancho: 417,
//     //     cantidad: 3150,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 1230,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "PL- PLANCHA 970X710 K/K FLAUTA C TEST 150",
//     //     test: 250
//     // },
//     // {
//     //     id: 10,
//     //     alto: 0,
//     //     ancho: 550,
//     //     cantidad: 3150,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 1230,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "PL- PLANCHA 970X710 K/K FLAUTA C TEST 150",
//     //     test: 250
//     // },
//     // {
//     //     id: 11,
//     //     alto: 0,
//     //     ancho: 550,
//     //     cantidad: 500,
//     //     fecha_entrega: "2025-02-27",
//     //     fecha_ingreso: "2025-02-10",
//     //     flauta: "C",
//     //     largo: 1230,
//     //     metros_cuadrados: "864.30",
//     //     nombre_pedido: "PL- PLANCHA 970X710 K/K FLAUTA C TEST 150",
//     //     test: 250
//     // },
    
  

    
// ];


const pedidos = [
    {
        "id": 1,
        "alto": 0,
        "ancho": 538,
        "cantidad": 1050,
        "fecha_entrega": "2025-02-27",
        "fecha_ingreso": "2025-02-10",
        "flauta": "C",
        "largo": 1530,
        "metros_cuadrados": "864.30",
        "nombre_pedido": "caja san jose ideal",
        "test": 250
    },
    {
        "id": 2,
        "alto": 0,
        "ancho": 493,
        "cantidad": 1050,
        "fecha_entrega": "2025-02-27",
        "fecha_ingreso": "2025-02-18",
        "flauta": "C",
        "largo": 1286,
        "metros_cuadrados": "667.05",
        "nombre_pedido": "caja tel celca",
        "test": 250
    },
    {
        "id": 3,
        "alto": 0,
        "ancho": 417,
        "cantidad": 3150,
        "fecha_entrega": "2025-02-27",
        "fecha_ingreso": "2025-02-18",
        "flauta": "C",
        "largo": 1230,
        "metros_cuadrados": "667.05",
        "nombre_pedido": "caja de prueba",
        "test": 250
    },
    {
        "id": 4,
        "alto": 0,
        "ancho": 417,
        "cantidad": 3150,
        "fecha_entrega": "2025-02-27",
        "fecha_ingreso": "2025-02-18",
        "flauta": "C",
        "largo": 1230,
        "metros_cuadrados": "667.05",
        "nombre_pedido": "caja de prueba",
        "test": 250
    },
    {
        "id": 5,
        "alto": 0,
        "ancho": 339,
        "cantidad": 1575,
        "fecha_entrega": "2025-02-27",
        "fecha_ingreso": "2025-02-18",
        "flauta": "C",
        "largo": 1230,
        "metros_cuadrados": "667.05",
        "nombre_pedido": "caja de 10",
        "test": 250
    },
    {
        "id": 6,
        "alto": 0,
        "ancho": 647,
        "cantidad": 2372,
        "fecha_entrega": "2025-03-14",
        "fecha_ingreso": "2025-02-24",
        "flauta": "B",
        "largo": 1286,
        "metros_cuadrados": "1973.6",
        "nombre_pedido": "REG 21 CJ- FONDO TABACO USA BOUQUET 950X206X224 K/K TEST 250",
        "test": 250
    },
    {
        "id": 7,
        "alto": 0,
        "ancho": 511,
        "cantidad": 1654,
        "fecha_entrega": "2025-02-13",
        "fecha_ingreso": "2025-02-05",
        "flauta": "C",
        "largo": 1530,
        "metros_cuadrados": "1293.15",
        "nombre_pedido": "caja tel celca",
        "test": 250
    },
    {
        "id": 8,
        "alto": 0,
        "ancho": 451,
        "cantidad": 1613,
        "fecha_entrega": "2025-03-19",
        "fecha_ingreso": "2025-02-27",
        "flauta": "E",
        "largo": 1530,
        "metros_cuadrados": "2346.96",
        "nombre_pedido": "caja tel celca",
        "test": 250
    },
    {
        "id": 9,
        "alto": 0,
        "ancho": 777,
        "cantidad": 640,
        "fecha_entrega": "2025-02-20",
        "fecha_ingreso": "2025-02-05",
        "flauta": "E",
        "largo": 1230,
        "metros_cuadrados": "611.65",
        "nombre_pedido": "caja de prueba",
        "test": 250
    },
    {
        "id": 10,
        "alto": 0,
        "ancho": 484,
        "cantidad": 2780,
        "fecha_entrega": "2025-02-21",
        "fecha_ingreso": "2025-02-13",
        "flauta": "B",
        "largo": 1530,
        "metros_cuadrados": "2058.65",
        "nombre_pedido": "PL- PLANCHA 970X710 K/K FLAUTA C TEST 150",
        "test": 250
    },
    
];


const pedidosCalculadosAgrupados = pedidos.map(pedido => ({
    id: pedido.id, 
    nombre_pedido: pedido.nombre_pedido,
    ancho: pedido.ancho,
    alto: pedido.alto,
    largo: pedido.largo,
    variaciones: cavidades.map(cavidad => {
        const cantidad = pedido.cantidad;
        const largo = pedido.largo; 
        const ancho = pedido.ancho;
        
        const cortes = Math.ceil(cantidad / cavidad);
        const cantidad_producida = cortes * cavidad;
        const cantidad_faltante = cantidad - cantidad_producida;
        const metros_lineales = Math.floor(((cantidad_producida * largo) / cavidad) / 1000); 
        const ancho_utilizado = Math.ceil( ancho * cavidad);
        const porcentaje = cantidad_faltante === cantidad ? 100 : Math.floor((cantidad_faltante * 100) / cantidad);

        return {
            cavidad,
            cortes,
            cantidad,
            largo,
            cantidad_producida,
            cantidad_faltante,
            metros_lineales,
            ancho_utilizado,
            porcentaje
        };
    })
}));

console.log(pedidos)






console.log("pedidos calculados agrupados",pedidosCalculadosAgrupados);


// Generar todas las combinaciones de variaciones entre los pedidos
const generarCombinaciones = (pedidos) => {
    let combinaciones = [];

    for (let i = 0; i < pedidos.length - 1; i++) {
        for (let j = i + 1; j < pedidos.length; j++) {
            pedidos[i].variaciones.forEach(var1 => {
                pedidos[j].variaciones.forEach(var2 => {
                    // Recalcular valores para cada variación
                    const cortes1 = Math.ceil(var1.cantidad / var1.cavidad);
                    const cantidad_producida1 = cortes1 * var1.cavidad;
                    const cantidad_faltante1 = var1.cantidad - cantidad_producida1;
                    const metros_lineales1 = Math.floor(((cantidad_producida1 * var1.largo) / var1.cavidad) / 1000);
                    const porcentajep1 = cantidad_producida1 === var1.cantidad ? 100 : Math.floor((cantidad_producida1 * 100) / var1.cantidad);

                    const cortes2 = Math.ceil(var2.cantidad / var2.cavidad);
                    const cantidad_producida2 =Math.floor((metros_lineales1/var2.largo)*1000);
                    const cantidad_faltante2 = Math.floor(var2.cantidad - cantidad_producida2);
                    const metros_lineales2 = Math.floor(((cantidad_producida2 * var2.largo) / var2.cavidad) / 1000);
                    // const porcentajep2 = cantidad_producida2 === var2.cantidad ? 100 : Math.floor((cantidad_producida2 * 100) / var2.cantidad);
                    const porcentajep2 = cantidad_producida2 === var2.cantidad ? 100: ((cantidad_producida2 * 100) / var2.cantidad).toFixed(2);
                    // un sobrante por cada combinacion

                    combinaciones.push({
                        pedido_1: {
                            id: pedidos[i].id,
                            nombre: pedidos[i].nombre_pedido,
                            ancho_utilizado: var1.ancho_utilizado,
                            cantidad: var1.cantidad,
                            cavidad: var1.cavidad,
                            largo: var1.largo,
                            cortes: cortes1,
                            cantidad_producida: cantidad_producida1,
                            cantidad_faltante: cantidad_faltante1,
                            metros_lineales: metros_lineales1,
                            porcentaje1: porcentajep1
                        },
                        pedido_2: {
                            id: pedidos[j].id,
                            nombre: pedidos[j].nombre_pedido,
                            ancho_utilizado: var2.ancho_utilizado,
                            cantidad: var2.cantidad,
                            cavidad: var2.cavidad,
                            largo: var2.largo,
                            cortes: cortes2,
                            cantidad_producida: cantidad_producida2,
                            cantidad_faltante: cantidad_faltante2,
                            metros_lineales: metros_lineales2,
                            porcentaje2: porcentajep2
                        },
                        total_ancho: var1.ancho_utilizado + var2.ancho_utilizado
                    });
                });
            });
        }
    }

    return combinaciones;
};


// console.log("generar combinaciones",generarCombinaciones(pedidosCalculadosAgrupados));



let comboCounter = 1; // Contador de combos para asignar números automáticamente
const encontrarMejorTrimado = (combinaciones, pedidos) => {
    let combinacionesValidas = combinaciones.filter(combo =>
        combo.pedido_1.cantidad_faltante >= 0 && combo.pedido_2.cantidad_faltante >= 0
    );

    // Ordenar combinaciones por sobrante más bajo
    combinacionesValidas.sort((a, b) => a.sobrante - b.sobrante);

    let mejoresCombos = [];
    let idsVistos = new Set();

    combinacionesValidas.forEach(combo => {
        // Solo procesar si ambos pedidos no han sido vistos previamente y menor sobrante y si 
        if (!idsVistos.has(combo.pedido_1.id) && !idsVistos.has(combo.pedido_2.id )) {
            // Buscar mejor bobina que minimice el sobrante
            let mejorBobina = bobinas.reduce((mejor, bobina) => {
                // console.log("bobina",bobina);
                let sobrante = bobina - combo.total_ancho;
                if (sobrante >= 0 && sobrante < mejor.sobrante) {
                    return { bobina, sobrante }; // Encontramos una mejor opción
                }
                return mejor; // Si no es mejor, mantenemos la opción anterior
            }, { bobina: null, sobrante: Infinity });
            
            // Asignar la mejor bobina encontrada
            combo.mejorBobina = mejorBobina.bobina || "N/A";
            combo.sobrante = mejorBobina.sobrante === Infinity ? "N/A" : mejorBobina.sobrante;
            
            // Asignar número de combo solo si es una combinación válida
            combo.comboNumero = comboCounter++;
            
    


            // Agregar a la lista de mejores combos
            mejoresCombos.push(combo);


        }
    });
    
    console.log("mejores combos",mejoresCombos);

    eliminarNan(mejoresCombos);
    return mejoresCombos;

};




    
let todosLosCombosFinales = [];








function eliminarNan(mejoresCombos) {
    let idsVistos = new Set();
    const trim = 30; // Ajuste de 30 unidades

    // Filtrar combos con 'N/A' en el sobrante
    let mejoresCombosSinNan = mejoresCombos.filter(combo => combo.sobrante !== 'N/A');

    // Ajustar el sobrante restando el trim
    mejoresCombosSinNan = mejoresCombosSinNan.map(combo => {
        // Restar el trim (30) a cada sobrante
        combo.sobrante = combo.sobrante - trim;
        return combo;
    });

    // Ordenar los combos por el menor sobrante
    mejoresCombosSinNan.sort((a, b) => a.sobrante - b.sobrante);

    // Filtrar combos con el menor sobrante y sin repetir IDs
    let mejoresCombosFinales = [];
    mejoresCombosSinNan.forEach(combo => {
        // Si el sobrante es negativo, buscamos otro combo con el sobrante más pequeño posible
        if (combo.sobrante >= 0 && !idsVistos.has(combo.pedido_1.id) && !idsVistos.has(combo.pedido_2.id)) {
            idsVistos.add(combo.pedido_1.id);
            idsVistos.add(combo.pedido_2.id);
            mejoresCombosFinales.push(combo);
        } else if (combo.sobrante < 0) {
            // Si el sobrante es negativo, buscar el combo con el sobrante más pequeño posible
            let siguienteCombo = mejoresCombosSinNan.find(c => !idsVistos.has(c.pedido_1.id) && !idsVistos.has(c.pedido_2.id) && c.sobrante >= 0);
            if (siguienteCombo) {
                idsVistos.add(siguienteCombo.pedido_1.id);
                idsVistos.add(siguienteCombo.pedido_2.id);
                mejoresCombosFinales.push(siguienteCombo);
                // console.log("Se asignó un nuevo combo con sobrante positivo: ", siguienteCombo);
            }
        }
    });


  
    
    
        ejemplopruebadevariable(idsVistos,mejoresCombos,mejoresCombosFinales);
        
        todosLosCombosFinales.push(...mejoresCombosFinales);
    console.log("mejores combos sin nan", mejoresCombosFinales);

    // como poener global mejoresCombosFinales
    return mejoresCombosFinales;
}
var pedidosNuevos = []; 





// genera combinaciones de los pedidos que tuve que duplicar para que se puedan combinar



// Generar combinaciones y encontrar la mejor
const combinaciones = generarCombinaciones(pedidosCalculadosAgrupados);

const mejorTrimado = encontrarMejorTrimado(combinaciones);




// console.log("combinaciones 3",combinaciones);
// console.log("mejor trimado",mejorTrimado);





//revisar desde aqui porque desde aqui  se ejecuta el codigo de todo el proceso.

function ejemplopruebadevariable(idsVistos,mejoresCombos,mejoresCombosFinales) {




            // Verificar los pedidos que no han sido asignados a un combo
            let pedidosLibres = mejoresCombos.filter(combo => 
                !idsVistos.has(combo.pedido_1.id) || !idsVistos.has(combo.pedido_2.id)
            );

            console.log("pedidos libres sin asignar a un combo aaaaa",pedidosLibres);
        

        pedidosLibres.forEach(combo => {
            // Buscar el pedido_1 completo utilizando el id
            if (!idsVistos.has(combo.pedido_1.id)) {
                const pedido1 = pedidos.find(pedido => pedido.id === combo.pedido_1.id);
                console.log("Pedido sin combo: ", pedido1); // Mostrar el pedido completo
                idsVistos.add(combo.pedido_1.id); // Marcar pedido_1 como visto
                pedidosNuevos.push(pedido1); 
            }

            // // Buscar el pedido_2 completo utilizando el id
            if (!idsVistos.has(combo.pedido_2.id)) {
                const pedido2 = pedidos.find(pedido => pedido.id === combo.pedido_2.id);
                console.log("Pedido sin combo: ", pedido2); // Mostrar el pedido completo
                idsVistos.add(combo.pedido_2.id); // Marcar pedido_2 como visto
                pedidosNuevos.push(pedido2); 
            }

        });




        for(const contruye of mejoresCombosFinales){
            // Traer el pedido original y verificar si hay cantidad faltante para duplicar el pedido sin modificar el original y verificar el porcentaje del pedido

            const pedido1 = pedidos.find(pedido => pedido.id === contruye.pedido_1.id);
            const pedido2 = pedidos.find(pedido => pedido.id === contruye.pedido_2.id);


            // Verifica si hay cantidad faltante para el pedido 1
            if(contruye.pedido_1.cantidad_faltante > 1){
                console.log("Cantidad faltante para el pedido 1: ", contruye.pedido_1.cantidad_faltante);
                
                const nuevoPedido = {
                    ...pedido1,
                    // Remplazar la cantidad por la cantidad faltante
                    cantidad: contruye.pedido_1.cantidad_faltante
                };
                // console.log("Nuevo pedido 1 creado: ", nuevoPedido);
                
                // Agregar el nuevo pedido al array de pedidos nuevos
                pedidosNuevos.push(nuevoPedido);
            } else {
                // console.log("No hay cantidad faltante para el pedido 1, se ignora.");
            }

            // Verifica si hay cantidad faltante para el pedido 2
            if(contruye.pedido_2.cantidad_faltante > 1){
                // console.log("Cantidad faltante para el pedido 2: ", contruye.pedido_2.cantidad_faltante);
                
                const nuevoPedido = {
                    ...pedido2,
                    // Remplazar la cantidad por la cantidad faltante
                    cantidad: contruye.pedido_2.cantidad_faltante
                };
                console.log("Nuevo pedido 2 creado: ", nuevoPedido);
                
                // Agregar el nuevo pedido al array de pedidos nuevos
                pedidosNuevos.push(nuevoPedido);
            } else {
                // console.log("No hay cantidad faltante para el pedido 2, se ignora.");
            }

            // console.log("pedido 1:", pedido1);
            // console.log("pedido 2:", pedido2);
        }

                // Mostrar el array con los pedidos nuevos
        // console.log("Pedidos nuevos:", pedidosNuevos);

        // ordenar de menor cantidad a mayor cantidad
        pedidosNuevos.sort((a,b) => a.cantidad - b.cantidad);

        return pedidosNuevos;

       
    }


console.log("pedidos nuevos en arreglo",pedidosNuevos);










const pedidosCalculadosAgrupadosNuevos = pedidosNuevos.map(pedido => ({
    id: pedido.id,
    nombre_pedido: pedido.nombre_pedido,
    ancho: pedido.ancho,
    alto: pedido.alto,
    largo: pedido.largo,

    variaciones: cavidades.map(cavidad => {
        const cantidad = pedido.cantidad;
        const largo = pedido.largo;
        const ancho = pedido.ancho;

        const cortes = Math.ceil(cantidad / cavidad);
        const cantidad_producida = cortes * cavidad;
        const cantidad_faltante = cantidad - cantidad_producida;
        const metros_lineales = Math.floor(((cantidad_producida * largo) / cavidad) / 1000);
        const ancho_utilizado = Math.ceil(ancho * cavidad);
        const porcentaje = cantidad_faltante === cantidad ? 100 : Math.floor((cantidad_faltante * 100) / cantidad);
    
        return {
            cavidad,
            cortes,
            cantidad,
            largo,
            cantidad_producida,
            cantidad_faltante,
            metros_lineales,
            ancho_utilizado,
            porcentaje
        };
    }
)
    
}));



    const generarCombinacionesNuevas = (pedidosNuevos) => {
        let combinacionesnuevas = [];
        for (let i = 0; i < pedidosNuevos.length - 1; i++) {
            for (let j = i + 1; j < pedidosNuevos.length; j++) {
                // Verificar si 'variaciones' existe antes de usar 'forEach'
                if (pedidosNuevos[i].variaciones && pedidosNuevos[j].variaciones) {
  
                    pedidosNuevos[i].variaciones.forEach(var1 => {
                        pedidosNuevos[j].variaciones.forEach(var2 => {
                            const cortes1 = Math.ceil(var1.cantidad / var1.cavidad);
                            const cantidad_producida1 = cortes1 * var1.cavidad;
                            const cantidad_faltante1 = var1.cantidad - cantidad_producida1;
                            const metros_lineales1 = Math.floor(((cantidad_producida1 * var1.largo) / var1.cavidad) / 1000);
                            const porcentajep1 = cantidad_producida1 === var1.cantidad ? 100 : Math.floor((cantidad_producida1 * 100) / var1.cantidad);
    
                            const cortes2 = Math.ceil(var2.cantidad / var2.cavidad);
                            const cantidad_producida2 = Math.floor((metros_lineales1 / var2.largo) * 1000);
                            const cantidad_faltante2 = Math.floor(var2.cantidad - cantidad_producida2);
                            const metros_lineales2 = Math.floor(((cantidad_producida2 * var2.largo) / var2.cavidad) / 1000);
                            const porcentajep2 = cantidad_producida2 === var2.cantidad ? 100 : ((cantidad_producida2 * 100) / var2.cantidad).toFixed(2);
    
                            combinacionesnuevas.push({
                                pedido_1: {
                                    id: pedidosNuevos[i].id,
                                    nombre: pedidosNuevos[i].nombre_pedido,
                                    ancho_utilizado: var1.ancho_utilizado,
                                    cantidad: var1.cantidad,
                                    cavidad: var1.cavidad,
                                    largo: var1.largo,
                                    cortes: cortes1,
                                    cantidad_producida: cantidad_producida1,
                                    cantidad_faltante: cantidad_faltante1,
                                    metros_lineales: metros_lineales1,
                                    porcentaje1: porcentajep1
                                },
                                pedido_2: {
                                    id: pedidosNuevos[j].id,
                                    nombre: pedidosNuevos[j].nombre_pedido,
                                    ancho_utilizado: var2.ancho_utilizado,
                                    cantidad: var2.cantidad,
                                    cavidad: var2.cavidad,
                                    largo: var2.largo,
                                    cortes: cortes2,
                                    cantidad_producida: cantidad_producida2,
                                    cantidad_faltante: cantidad_faltante2,
                                    metros_lineales: metros_lineales2,
                                    porcentaje2: porcentajep2
                                },
                                total_ancho: var1.ancho_utilizado + var2.ancho_utilizado
                            });
                        });
                    });
                }
            }
        }
    
        console.log("combinaciones nuevas trimado 1", combinacionesnuevas);
        return combinacionesnuevas;
    };



    let comboCounterNuevos = 1; // Contador de combos para asignar números automáticamente

    const encontrarMejorTrimadoNuevos = (combinacionesnuevas, pedidosNuevos) => {
        let combinacionesValidas2 = combinacionesnuevas.filter(combo => {
            console.log(combo.pedido_1.cantidad_faltante, combo.pedido_2.cantidad_faltante);
            return combo.pedido_1.cantidad_faltante >= 0 && combo.pedido_2.cantidad_faltante >= 0;
        });
        

        // Ordenar combinaciones por sobrante más bajo
        combinacionesValidas2.sort((a,b) => a.sobrante - b.sobrante);


        
        
        let mejoresCombosNuevos = [];
        let idsVistoss = new Set();

        combinacionesValidas2.forEach(combo => {
            // Solo procesar si ambos pedidos no han sido vistos previamente y menor sobrante
            if (!idsVistoss.has(combo.pedido_1.id) && !idsVistoss.has(combo.pedido_2.id)) {
                // Buscar mejor bobina que minimice el sobrante
                let mejorBobina = bobinas.reduce((mejor, bobina) => {
                    let sobrante = bobina - combo.total_ancho;
                    if (sobrante >= 0 && sobrante < mejor.sobrante) {
                        return { bobina, sobrante }; // Encontramos una mejor opción
                    }
                    return mejor; // Si no es mejor, mantenemos la opción anterior
                }, { bobina: null, sobrante: Infinity });

                // Asignar la mejor bobina encontrada
                combo.mejorBobina = mejorBobina.bobina || "N/A";
                combo.sobrante = mejorBobina.sobrante === Infinity ? "N/A" : mejorBobina.sobrante;

                // Asignar número de combo solo si es una combinación válida
                combo.comboNumero = comboCounterNuevos++;

                
                // Agregar a la lista de mejores combos
                mejoresCombosNuevos.push(combo);
            }
        });
        
        console.log("mejores",mejoresCombosNuevos);
        
        eliminarNanNuevos(mejoresCombosNuevos);
        return mejoresCombosNuevos;
    };
    


    function eliminarNanNuevos(mejoresCombosNuevos) {
        let idsVistos = new Set();
        const trim = 30; // Ajuste de 30 unidades

        // Filtrar combos con 'N/A' en el sobrante
        let mejoresCombosSinNan = mejoresCombosNuevos.filter(combo => combo.sobrante !== 'N/A');

        // Ajustar el sobrante restando el trim
        mejoresCombosSinNan = mejoresCombosSinNan.map(combo => {
            // Restar el trim (30) a cada sobrante
            combo.sobrante = combo.sobrante - trim;
            return combo;
        });

        // Ordenar los combos por el menor sobrante

        mejoresCombosSinNan.sort((a, b) => a.sobrante - b.sobrante);
        
        // Filtrar combos con el menor sobrante y sin repetir IDs
        let mejoresCombosFinalesNuevos = [];
        mejoresCombosSinNan.forEach(combo => {
            // Si el sobrante es negativo, buscamos otro combo con el sobrante más pequeño posible
            if (combo.sobrante >= 0 && !idsVistos.has(combo.pedido_1.id) && !idsVistos.has(combo.pedido_2.id)) {
                idsVistos.add(combo.pedido_1.id);
                idsVistos.add(combo.pedido_2.id);
                mejoresCombosFinalesNuevos.push(combo);
            } else if (combo.sobrante < 0) {
                // Si el sobrante es negativo, buscar el combo con el sobrante más pequeño posible
                let siguienteCombo = mejoresCombosSinNan.find(c => !idsVistos.has(c.pedido_1.id) && !idsVistos.has(c.pedido_2.id) && c.sobrante >= 0);
                if (siguienteCombo) {
                    idsVistos.add(siguienteCombo.pedido_1.id);
                    idsVistos.add(siguienteCombo.pedido_2.id);
                    mejoresCombosFinalesNuevos.push(siguienteCombo);
                    // console.log("Se asignó un nuevo combo con sobrante positivo: ", siguienteCombo);
                }
            }
        });



    



            console .log("mejores combos finales nuevoss de prueba ", mejoresCombosFinalesNuevos);





                    
                        // Agregarlos al arreglo externo
                todosLosCombosFinales.push(...mejoresCombosFinalesNuevos);

                console.log("mejores combos finales nuevoss", todosLosCombosFinales);

            // segundo trimado de sobrantes
                ejemplopruebadevariable2(idsVistos,mejoresCombosNuevos,mejoresCombosFinalesNuevos);


                // crear tabla de los nuevos pedidos

        const tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; // Limpiar la tabla antes de agregar datos


        todosLosCombosFinales.forEach((combo) => {
            const tr1 = document.createElement('tr');
            tr1.innerHTML = `
                <td rowspan="2">Combo ${combo.comboNumero || "N/A"}</td>
                <td>${combo.pedido_1.id}</td>
                <td>${combo.pedido_1.nombre}</td>
                <td>${combo.pedido_1.largo}</td>
                <td>${combo.pedido_1.cavidad}</td>
                <td>${combo.pedido_1.cortes}</td>
                <td>${combo.pedido_1.cantidad}</td>
                <td>${combo.pedido_1.cantidad_producida}</td>
                <td>${combo.pedido_1.cantidad_faltante}</td>
                <td>${combo.pedido_1.metros_lineales}</td>
                <td>${combo.pedido_1.ancho_utilizado}</td>
                <td>${combo.pedido_1.porcentaje1}</td>
                <td rowspan="2">${combo.total_ancho}</td>
                <td rowspan="2">${combo.mejorBobina || 'N/A'}</td>
                <td rowspan="2">${combo.sobrante !== undefined ? combo.sobrante : 'N/A'}</td>
            `;
            const tr2 = document.createElement('tr');
            tr2.innerHTML = `
                <td>${combo.pedido_2.id}</td>
                <td>${combo.pedido_2.nombre}</td>
                <td>${combo.pedido_2.largo}</td>
                <td>${combo.pedido_2.cavidad}</td>
                <td>${combo.pedido_2.cortes}</td>
                <td>${combo.pedido_2.cantidad}</td>
                <td>${combo.pedido_2.cantidad_producida}</td>
                <td>${combo.pedido_2.cantidad_faltante}</td>
                <td>${combo.pedido_2.metros_lineales}</td>
                <td>${combo.pedido_2.ancho_utilizado}</td>
                <td>${combo.pedido_2.porcentaje2}</td>
            `;
            tbody.appendChild(tr1);
            tbody.appendChild(tr2);
        });

    }


var pedidosNuevos2 = [];

const combinacionesnuedvas = generarCombinacionesNuevas(pedidosCalculadosAgrupadosNuevos);
const mejorTrimadoNuevos = encontrarMejorTrimadoNuevos(combinacionesnuedvas,pedidosCalculadosAgrupadosNuevos);







// tercer trimado de sobrantes 

function ejemplopruebadevariable2(idsVistos,mejoresCombos,mejoresCombosFinalesNuevos){
    
        // Verificar de dentro de mejoresCombosFinalesNuevos los pedidos que aun tienen pedidos con sobrantes se vuelvan a agregar a pedidosNuevos 2
        
        let pedidosLibres = mejoresCombos.filter(combo => 
            !idsVistos.has(combo.pedido_1.id) || !idsVistos.has(combo.pedido_2.id)
        );
        console.log("pedidos libres sin asignar a un combo",pedidosLibres);

        pedidosLibres.forEach(combo => {
            // Buscar el pedido_1 completo utilizando el id
            if (!idsVistos.has(combo.pedido_1.id)) {
                const pedido1 = pedidos.find(pedido => pedido.id === combo.pedido_1.id);
                console.log("Pedido sin combo: ", pedido1); // Mostrar el pedido completo
                idsVistos.add(combo.pedido_1.id); // Marcar pedido_1 como visto
                pedidosNuevos2.push(pedido1); 
            }

            // Buscar el pedido_2 completo utilizando el id
            if (!idsVistos.has(combo.pedido_2.id)) {
                const pedido2 = pedidos.find(pedido => pedido.id === combo.pedido_2.id);
                console.log("Pedido sin combo: ", pedido2); // Mostrar el pedido completo
                idsVistos.add(combo.pedido_2.id); // Marcar pedido_2 como visto
                pedidosNuevos2.push(pedido2); 
            }

        });

            // Traer el pedido original y verificar si hay cantidad faltante para duplicar el pedido sin modificar el original y verificar el porcentaje del pedido

        for(const contruye of mejoresCombosFinalesNuevos){

            const pedido1 = pedidos.find(pedido => pedido.id === contruye.pedido_1.id);
            const pedido2 = pedidos.find(pedido => pedido.id === contruye.pedido_2.id);


            // // Verifica si hay cantidad faltante para el pedido 1
            // if(contruye.pedido_1.cantidad_faltante > 1){
            //     console.log("Cantidad faltante para el pedido 1: ", contruye.pedido_1.cantidad_faltante);
                
            //     const nuevoPedido = {
            //         ...pedido1,
            //         // Remplazar la cantidad por la cantidad faltante
            //         cantidad: contruye.pedido_1.cantidad_faltante
            //     };
            //     // console.log("Nuevo pedido 1 creado: ", nuevoPedido);
                
            //     // Agregar el nuevo pedido al array de pedidos nuevos
            //     pedidosNuevos2.push(nuevoPedido);
            // } else {
            //     // console.log("No hay cantidad faltante para el pedido 1, se ignora.");
            // }

            // // Verifica si hay cantidad faltante para el pedido 2
            // if(contruye.pedido_2.cantidad_faltante > 1){
            //     // console.log("Cantidad faltante para el pedido 2: ", contruye.pedido_2.cantidad_faltante);
                
            //     const nuevoPedido = {
            //         ...pedido2,
            //         // Remplazar la cantidad por la cantidad faltante
            //         cantidad: contruye.pedido_2.cantidad_faltante
            //     };
            //     console.log("Nuevo pedido 2 creado: ", nuevoPedido);
                
            //     // Agregar el nuevo pedido al array de pedidos nuevos
            //     pedidosNuevos2.push(nuevoPedido);
            // } else {
            //     // console.log("No hay cantidad faltante para el pedido 2, se ignora.");
            // }

        // si el pedido 1 o 2 vuelve a tener faltante se vuelve a agregar a pedidosNuevos2 y se trima solo sin buscar otro pedido

        if (contruye.pedido_1.cantidad_faltante > 1) {
            const nuevoPedido = {
                ...pedido1,
                cantidad: contruye.pedido_1.cantidad_faltante
            };
            pedidosNuevos2.push(nuevoPedido);

        } else if (contruye.pedido_2.cantidad_faltante > 1) {
            const nuevoPedido = {
                ...pedido2,
                cantidad: contruye.pedido_2.cantidad_faltante
            };
            console.log("Nuevo pedido 2 creado: ", nuevoPedido);
            
            pedidosNuevos2.push(nuevoPedido);

        } else {
            console.log("No hay cantidad faltante para el pedido 1 o 2, se ignora.");

        }






        }

        pedidosNuevos2.sort((a,b) => a.cantidad - b.cantidad);

        let pedidosSinDupl = [];

        pedidosNuevos2.forEach(pedido => {
            const emparejado = mejoresCombosFinalesNuevos.some(combo =>
                (combo.pedido_1.id === pedido.id && combo.pedido_1.cantidad === pedido.cantidad) ||
                (combo.pedido_2.id === pedido.id && combo.pedido_2.cantidad === pedido.cantidad)
            );
        
            if (!emparejado) {
                pedidosSinDupl.push(pedido);
                console.log("pedido sin duplicar",pedido);
            }
        });



        const pedidosCalculadosAgrupadosNuevos3= pedidosSinDupl.map(pedidosin => ({
            id: pedidosin.id,
            nombre_pedido: pedidosin.nombre_pedido,
            ancho: pedidosin.ancho,
            alto: pedidosin.alto,
            largo: pedidosin.largo,


            variaciones: cavidades.map(cavidad => {
                const cantidad = pedidosin.cantidad;
                const largo = pedidosin.largo;
                const ancho = pedidosin.ancho;

                const cortes = Math.ceil(cantidad / cavidad);
                const cantidad_producida = cortes * cavidad;
                const cantidad_faltante = cantidad - cantidad_producida;
                const metros_lineales = Math.floor(((cantidad_producida * largo) / cavidad) / 1000);
                const ancho_utilizado = Math.ceil(ancho * cavidad);
                const porcentaje = cantidad_faltante === cantidad ? 100 : Math.floor((cantidad_faltante * 100) / cantidad);
            
                return {
                    cavidad,
                    cortes,
                    cantidad,
                    largo,
                    cantidad_producida,
                    cantidad_faltante,
                    metros_lineales,
                    ancho_utilizado,
                    porcentaje
                };
            }
        )


        } ));


      

        


        console.log("pedidos calculados agrupados nuevos 3",pedidosCalculadosAgrupadosNuevos3);
        

        return pedidosNuevos2;
            
}



console.log("pedidos 2 nuevos ",pedidosNuevos2);




const pedidosCalculadosAgrupadosNuevos2 = pedidosNuevos2.map(data => ({
    id: data.id,
    nombre_pedido: data.nombre_pedido,
    ancho: data.ancho,
    alto: data.alto,
    largo: data.largo,

    variaciones: cavidades.map(cavidad => {
        const cantidad = data.cantidad;
        const largo = data.largo;
        const ancho = data.ancho;

        const cortes = Math.ceil(cantidad / cavidad);
        const cantidad_producida = cortes * cavidad;
        const cantidad_faltante = cantidad - cantidad_producida;
        const metros_lineales = Math.floor(((cantidad_producida * largo) / cavidad) / 1000);
        const ancho_utilizado = Math.ceil(ancho * cavidad);
        const porcentaje = cantidad_faltante === cantidad ? 100 : Math.floor((cantidad_faltante * 100) / cantidad);
    
        return {
            cavidad,
            cortes,
            cantidad,
            largo,
            cantidad_producida,
            cantidad_faltante,
            metros_lineales,
            ancho_utilizado,
            porcentaje
        };
    }
)
    
}));


console.log("pedidos calculados agrupados nuevos222222",pedidosCalculadosAgrupadosNuevos2);




const generarCombinacionesNuevas2 = (pedidosNuevos2) => {
    let combinacionesnuevas2 = [];
    for (let i = 0; i < pedidosNuevos2.length - 1; i++) {
        for (let j = i + 1; j < pedidosNuevos2.length; j++) {
            // Verificar si 'variaciones' existe antes de usar 'forEach'
            if (pedidosNuevos2[i].variaciones && pedidosNuevos2[j].variaciones) {
  
                pedidosNuevos2[i].variaciones.forEach(var1 => {
                    pedidosNuevos2[j].variaciones.forEach(var2 => {
                        const cortes1 = Math.ceil(var1.cantidad / var1.cavidad);
                        const cantidad_producida1 = cortes1 * var1.cavidad;
                        const largo1 = var1.largo;
                        const cantidad_faltante1 = var1.cantidad - cantidad_producida1;
                        const metros_lineales1 = Math.floor(((cantidad_producida1 * var1.largo) / var1.cavidad) / 1000);
                        const porcentajep1 = cantidad_producida1 === var1.cantidad ? 100 : Math.floor((cantidad_producida1 * 100) / var1.cantidad);

                        const cortes2 = Math.ceil(var2.cantidad / var2.cavidad);
                        const cantidad_producida2 = Math.floor((metros_lineales1 / var2.largo) * 1000);
                        const cantidad_faltante2 = Math.floor(var2.cantidad - cantidad_producida2);
                        const metros_lineales2 = Math.floor(((cantidad_producida2 * var2.largo) / var2.cavidad) / 1000);
                        const porcentajep2 = cantidad_producida2 === var2.cantidad ? 100 : ((cantidad_producida2 * 100) / var2.cantidad).toFixed(2);

                        combinacionesnuevas2.push({
                            pedido_1: {
                                id: pedidosNuevos2[i].id,
                                nombre: pedidosNuevos2[i].nombre_pedido,
                                ancho_utilizado: var1.ancho_utilizado,
                                cantidad: var1.cantidad,
                                cavidad: var1.cavidad,
                                largo: var1.largo,
                                cortes: cortes1,
                                cantidad_producida: cantidad_producida1,
                                cantidad_faltante: cantidad_faltante1,
                                metros_lineales: metros_lineales1,
                                porcentaje1: porcentajep1
                            },
                            pedido_2: {
                                id: pedidosNuevos2[j].id,
                                nombre: pedidosNuevos2[j].nombre_pedido,
                                ancho_utilizado: var2.ancho_utilizado,
                                cantidad: var2.cantidad,
                                cavidad: var2.cavidad,
                                largo: var2.largo,
                                cortes: cortes2,
                                cantidad_producida: cantidad_producida2,
                                cantidad_faltante: cantidad_faltante2,
                                metros_lineales: metros_lineales2,
                                porcentaje2: porcentajep2
                            },
                            total_ancho: var1.ancho_utilizado + var2.ancho_utilizado
                        });
                    });
                });
            }
        }
    }
    console.log("combinaciones nuevas trimado 2", combinacionesnuevas2);
    return combinacionesnuevas2;
};


const combinacionesnuedvas2 = generarCombinacionesNuevas2(pedidosCalculadosAgrupadosNuevos2);
const mejorTrimadoNuevos2 = encontrarMejorTrimadoNuevos(combinacionesnuedvas2,pedidosCalculadosAgrupadosNuevos2);

