
const bobinas= [1600,1100];
const trim = 30;


// restar el trim a la bobina sin modificar el array original
const bobinasTrim = bobinas.map(bobina => bobina - trim);

// agregar de nuevo a bobina el array ya modificado
console.log(bobinasTrim);
console.log(bobinas);




const cavidades = [1,2,3,4];

const pedidos = [
    {
        id: 6,
        alto: "0",
        ancho: "538",
        cantidad: "1050",
        fecha_entrega: "2025-02-27",
        fecha_ingreso: "2025-02-10",
        flauta: "C",
        largo: "1530",
        metros_cuadrados: "864.30",
        nombre_pedido: "caja san jose ideal",
        test: "250"
    },
    {
        id: 7,
        alto: "0",
        ancho: "493",
        cantidad: "1050",
        fecha_entrega: "2025-02-27",
        fecha_ingreso: "2025-02-18",
        flauta: "C",
        largo: "1286",
        metros_cuadrados: "667.05",
        nombre_pedido: "caja tel celca",
        test: "250"
    },
    {
        id: 8,
        alto: "0",
        ancho: "417",
        cantidad: "3150",
        fecha_entrega: "2025-02-27",
        fecha_ingreso: "2025-02-18",
        flauta: "C",
        largo: "1230",
        metros_cuadrados: "667.05",
        nombre_pedido: "caja de prueba",
        test: "250"
    },

    {
        id: 9,
        alto: "0",
        ancho: "417",
        cantidad: "3150",
        fecha_entrega: "2025-02-27",
        fecha_ingreso: "2025-02-18",
        flauta: "C",
        largo: "1230",
        metros_cuadrados: "667.05",
        nombre_pedido: "caja de prueba",
        test: "250"
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

// console.log(pedidos)


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


console.log("generar combinaciones",generarCombinaciones(pedidosCalculadosAgrupados));

// Evaluar la mejor combinación de pedidos según el menor sobrante en una bobina
const encontrarMejorCombo = (combinaciones) => {
    return combinaciones.map(combo => {
        // Encontrar la mejor bobina que se ajuste a la combinación
        const mejorBobina = bobinasTrim.reduce((mejor, bobina) => {
            const sobrante = bobina - combo.total_ancho;
            return sobrante >= 0 && sobrante < mejor.sobrante ? { bobina, sobrante } : mejor;
        }, { bobina: null, sobrante: Infinity });

        return {
            ...combo,
            mejorBobina
        };
    }).filter(combo => combo.mejorBobina.bobina !== null); // Filtrar solo combos viables
};



console.log("pedidosd",encontrarMejorCombo(generarCombinaciones(pedidosCalculadosAgrupados)));

let comboCounter =1; // Contador de combos para asignar números automáticamente
const encontrarMejorTrimado = (combinaciones, pedidos) => {
    let combinacionesValidas = combinaciones.filter(combo =>
        combo.pedido_1.cantidad_faltante >= 0 && combo.pedido_2.cantidad_faltante >= 0
    );

    combinacionesValidas.sort((a, b) => a.sobrante - b.sobrante);

    let mejoresCombos = [];
    let idsVistos = new Set();

    combinacionesValidas.forEach(combo => {
        if (!idsVistos.has(combo.pedido_1.id) && !idsVistos.has(combo.pedido_2.id)) {
            idsVistos.add(combo.pedido_1.id);
            idsVistos.add(combo.pedido_2.id);
            combo.comboNumero = comboCounter++;

            // Calcular mejor bobina
            let mejorBobina = bobinas.reduce((mejor, bobina) => {
                let sobrante = bobina - combo.total_ancho;
                return (sobrante >= 0 && sobrante < mejor.sobrante) ? { bobina, sobrante } : mejor;
            }, { bobina: null, sobrante: Infinity });

            combo.mejorBobina = mejorBobina.bobina || "N/A";
            combo.sobrante = mejorBobina.sobrante === Infinity ? "N/A" : mejorBobina.sobrante;

            mejoresCombos.push(combo);
        }
        if (mejoresCombos.length >= 2) return;
    });

    console.log("pedidos",mejoresCombos);

    return mejoresCombos;
};




// Generar combinaciones y encontrar la mejor
const combinaciones = generarCombinaciones(pedidosCalculadosAgrupados);

const mejorTrimado = encontrarMejorTrimado(combinaciones);
console.log("combinaciones 3",combinaciones);
console.log("mejor trimado",mejorTrimado);




function creathtml() {
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = ''; // Limpiar la tabla antes de agregar datos

    mejorTrimado.forEach((combo) => {
        const tr1 = document.createElement('tr');
        tr1.innerHTML = `
            <td rowspan="2">Combo ${combo.comboNumero || "N/A"}</td>
            <td>${combo.pedido_1.id}</td>
            <td>${combo.pedido_1.nombre}</td>
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


creathtml();




