

<script>

document.addEventListener("DOMContentLoaded", () => {
    let pedidos = JSON.parse(localStorage.getItem("pedidosFiltrados")) || [];




    

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


console.log(pedidos);

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

let comboCounter = 1; // Contador de combos para asignar números automáticamente

const encontrarMejorTrimado = (combinaciones) => {
    let mejorDupla = null;
    let menorSobrante = Infinity;

    combinaciones.forEach(combo => {
        bobinas.forEach(bobina => {
            const sobrante = bobina - combo.total_ancho;

            if (sobrante >= 0 && sobrante < menorSobrante) {
                menorSobrante = sobrante;
                mejorDupla = {
                    ...combo,
                    mejorBobina: bobina,
                    sobrante,
                    comboNumero: comboCounter++ // Asigna el número de combo y aumenta el contador
                };
            }
        });
    });

    return mejorDupla;
};

// Generar combinaciones y encontrar la mejor
const combinaciones = generarCombinaciones(pedidosCalculadosAgrupados);

const mejorTrimado = encontrarMejorTrimado(combinaciones);
console.log(combinaciones);
console.log(mejorTrimado);

function creathtml() {
    const tbody = document.querySelector('tbody');

    if (!tbody) {
        console.error("No se encontró el <tbody>. Verifica que la tabla está en el HTML.");
        return;
    }

    tbody.innerHTML = ''; // Limpiar la tabla antes de agregar datos

    // Primera fila: Mostrar el combo con su número asignado dinámicamente
    const tr1 = document.createElement('tr');
    tr1.innerHTML = `
        <td rowspan="2">Combo ${mejorTrimado.comboNumero}</td>
        <td>${mejorTrimado.pedido_1?.id || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.nombre || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.cavidad || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.cortes || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.cantidad || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.cantidad_producida || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.cantidad_faltante || '0'}</td>
        <td>${mejorTrimado.pedido_1?.metros_lineales || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.ancho_utilizado || 'N/A'}</td>
        <td>${mejorTrimado.pedido_1?.porcentaje1 || 'N/A'}</td>
        <td rowspan="2">${mejorTrimado.total_ancho || 'N/A'}</td>
        <td rowspan="2">${mejorTrimado.mejorBobina || 'N/A'}</td>
        <td rowspan="2">${mejorTrimado.sobrante || 'N/A'}</td>
    `;
    
    // Segunda fila: Segundo pedido dentro del mismo combo
    const tr2 = document.createElement('tr');
    tr2.innerHTML = `
        <td>${mejorTrimado.pedido_2?.id || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.nombre || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.cavidad || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.cortes || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.cantidad || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.cantidad_producida || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.cantidad_faltante || '0'}</td>
        <td>${mejorTrimado.pedido_2?.metros_lineales || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.ancho_utilizado || 'N/A'}</td>
        <td>${mejorTrimado.pedido_2?.porcentaje2 || 'N/A'}</td>
    `;

    tbody.appendChild(tr1);
    tbody.appendChild(tr2);
}

creathtml();



















});



    



</script>