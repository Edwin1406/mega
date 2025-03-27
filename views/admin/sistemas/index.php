<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<style>
    .item {
        background-color: #24292d;
        color: #f8f2f2;
        padding: 10px 15px;
        transition: all 0.5s;
    }

    .containers {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .item:nth-child(1),
    .item:nth-child(2),
    .item:nth-child(3),
    .item:nth-child(4),
    .item:nth-child(5) {
        width: 10%;
    }

    .item:hover {
        background-color: #ac5353;
        scale: 1.1;
        text-align: center;
    }

    .item a {
        color: inherit;
        text-decoration: none;
        display: block;
    }

    @media (min-width: 1024px) {
        .item:nth-child(1) {
            width: 20%;
        }

        .item:nth-child(2) {
            width: 20%;
        }

        .item:nth-child(3) {
            width: 20%;
        }

        .item:nth-child(4) {
            width: 20%;
        }

        .item:nth-child(5) {
            width: 20%;
        }




    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<?php if (isset($_SESSION['email'])): ?>
    <div class="containers">
        <div class="item"><a href="/admin/sistemas/index?id=80ad04ffdfb4872f9b4603cdf4932f23"> <i class="fas fa-home"></i> INICIO</a></div>
        <div class="item"><a href="/admin/sistemas/productos/crear"> <i class="fas fa-industry"></i> PRODUCTOS</a></div>
        <div class="item"><a href="/admin/sistemas/solicitudes/tabla"> <i class="fas fa-scroll"></i> TABLA</a></div>
        <div class="item"><a href="/admin/sistemas/movimiento/movimientos"> <i class="fas fa-newspaper"></i> MOVIMIENTOS</a></div>
        <div class="item"><a href="/admin/sistemas/solicitudes/solicitud"><i class="fa-solid fa-arrow-right"></i> SOLICITUD</a></div>
        <div class="item"><a href="/admin/sistemas/registropc/version"><i class="fa-solid fa-arrow-right"></i>PC</a></div>
    </div>
<?php else: ?>

<?php endif; ?>





<ul class="lista-areas-produccion">

    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a href="/admin/sistemas/pdfinventario">
            <i class="fas fa-scroll"></i> INVETARIO REGISTRADO:
            <?php if ($registros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $registros ?> </span>
            <?php endif; ?>
        </a>
    </li>
    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> COSTO TOTAL POR MES:
            <span class="areas-produccion__numero totales"> </span>
        </a>
    </li>


</ul>


<b></b>


<style>
    .contenido-graficos {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;

    }


    .contenido-graficos2 {
        display: flex;
        /* width: 100%; */
    
        justify-content: center;
        margin-top: 1rem;


    }


    .grafico1 {
        width: 48%;
        /* background-image: linear-gradient(120deg,rgb(229, 235, 225) 0%,rgb(204, 212, 189) 100%); */
        background-color: white;
        border-radius: 10px;
        padding: 1rem;
    }


    .grafico2 {
        width: 48%;
        /* background-image: linear-gradient(120deg,rgb(226, 233, 236) 0%,rgb(202, 228, 226) 100%) */
        background-color: white;
        border-radius: 10px;
        padding: 1rem;
    }

    .grafico3 {
        width: 70%;
        /* background-image: linear-gradient(120deg,rgb(226, 233, 236) 0%,rgb(202, 228, 226) 100%) */
        background-color: white;
        border-radius: 10px;
        padding: 1rem;
    }

    /* version movil */

    @media (max-width: 768px) {
        .contenido-graficos {
            flex-direction: column;
        }

        .grafico1,
        .grafico2 {
            width: 100%;
        }
    }


button{
    border-radius: 1rem;
    background-color:rgb(197, 155, 155);

}


</style>
<!-- Modal -->
<div id="modalComputadora" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background: rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width: 400px; max-width: 90%;">
        <h2>Información de la Computadora</h2>
        <div id="contenidoModal" style="margin-bottom: 20px;"></div>
        <button id="btnMostrarID" style="padding:10px 15px;">Mostrar Mas</button>
        <button onclick="cerrarModal()" style="padding:10px 15px; float:right;">Cerrar</button>
    </div>
</div>



<div class="contenido-graficos">
    <div class="grafico1">

        <canvas id="myChart"></canvas>
    </div>
    <div class="grafico2">

        <canvas id="totalgeneral"></canvas>
    </div>
</div>


<div class="contenido-graficos">
    <div class="grafico1">

        <canvas id="productosStockMinimo"></canvas>
    </div>
    <div class="grafico2">

        <canvas id="entradasysalidas"></canvas>
    </div>

  

</div>

<div class="contenido-graficos2">
   

    <div class="grafico3">

        <canvas id="graficoAniosComputadoras"></canvas>
    </div>

</div>











<!-- grafica de pastel de movimientosd  -->




<script>
    document.addEventListener('DOMContentLoaded', async function() {
        await datosapi();
    });

    async function datosapi() {
        const url = 'https://megawebsistem.com/admin/api/apimovimientos';
        const response = await fetch(url);
        const datos = await response.json();
        // console.log(datos);

        // Filtrar los datos por el mes actual
        const currentMonth = new Date().getMonth(); // Obtener el mes actual (0 - 11)
        const currentYear = new Date().getFullYear(); // Obtener el año actual
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const monthName = monthNames[currentMonth]; // Obtener el nombre del mes

        const filteredData = datos.filter(item => {
            const itemDate = new Date(item.fecha_movimiento);
            return itemDate.getMonth() === currentMonth && itemDate.getFullYear() === currentYear;
        });

        // console.log("Datos del mes actual:", filteredData);

        // Agrupar los datos por área
        const areas = {};


        filteredData.forEach(item => {
            if (item.tipo_movimiento === 'Entrada') {
                if (!areas[item.area]) {
                    areas[item.area] = 0;
                }
                areas[item.area] += parseFloat(item.costo_nuevo * item.cantidad); // Sumar la cantidad de cada área
            }
        });

        // Labels para el gráfico (nombres de las áreas)
        const labels = Object.keys(areas);

        // Data para el gráfico
        const data = {
            labels: labels,
            datasets: [{
                label: 'valor',
                data: Object.values(areas),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgb(146, 192, 192)',
                borderWidth: 1
            }]
        };

        // Configuración del gráfico
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: `TOTAL POR AREA Y MES: ${monthName} ${currentYear}` // Título con el mes y año actual
                    }
                }
            }
        };

        // Creación del gráfico
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, config);
    }

    document.addEventListener("DOMContentLoaded", function() {
        // URL de la API
        const apiUrl = "https://megawebsistem.com/admin/api/apiproducts";

        // Set para rastrear productos ya notificados
        let notifiedProducts = new Set();

        // Función para obtener productos y mostrar alertas
        function checkStock() {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Filtrar productos con stock menor a 2
                    const lowStockProducts = data.filter(producto => parseInt(producto.stock_actual) === 0);

                    // Set temporal para los productos que deben notificarse en esta ejecución
                    let currentNotified = new Set();

                    lowStockProducts.forEach(producto => {
                        const productKey = `${producto.nombre_producto}-${producto.stock_actual}-${producto.area}-${producto.categoria}`;

                        // Verificar si ya fue notificado
                        if (!notifiedProducts.has(productKey)) {
                            // Verificar si el navegador tiene permisos para notificaciones
                            if (Notification.permission === "granted") {
                                new Notification(`⚠️ Sin Stock: ${producto.nombre_producto}`, {
                                    body: `Stock: ${producto.stock_actual} (Área: ${producto.area}) (Categoría: ${producto.categoria})`,
                                    icon: "/src/img/logo2.png",
                                }).onclick = function() {
                                    // Redirigir a la página de productos
                                    window.location.href = "/admin/sistemas/movimiento/movimientos";
                                };
                            } else if (Notification.permission !== "denied") {
                                // Si aún no se ha decidido el permiso, solicitarlo
                                Notification.requestPermission().then(permission => {
                                    if (permission === "granted") {
                                        new Notification(`⚠️ Sin Stock: ${producto.nombre_producto}`, {
                                            body: `Stock: ${producto.stock_actual} (Área: ${producto.area}) (Categoría: ${producto.categoria})`,
                                            icon: "/src/img/logo2.png",
                                        }).onclick = function() {
                                            window.location.href = "/admin/sistemas/movimiento/movimientos";
                                        };
                                    }
                                });
                            }

                            // Agregar a la lista de notificados
                            currentNotified.add(productKey);
                        }
                    });

                    // Actualizar el Set con las notificaciones de esta ejecución
                    notifiedProducts = currentNotified;
                })
                .catch(error => console.error("Error al obtener los productos:", error));
        }

        // Ejecutar la función cada 10 segundos
        checkStock(); // Ejecutar inmediatamente
        setInterval(checkStock, 10000); // Luego repetir cada 10 segundos
    });




    async function sumadevaloresdeapi() {
        const url = 'https://megawebsistem.com/admin/api/apimovimientos';
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();

        // console.log("Datos obtenidos de la API:", resultado);

        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        let monthlyTotals = {};
        monthNames.forEach((month, index) => {
            monthlyTotals[index] = 0;
        });

        resultado.forEach(item => {
            const itemDate = new Date(item.fecha_movimiento);
            //  solo entradas 
            if (item.tipo_movimiento === 'Entrada') {
                const monthIndex = itemDate.getMonth();
                monthlyTotals[monthIndex] += Number(item.costo_nuevo * item.cantidad);
            }

        });

        // console.log("Total acumulado por mes:", monthlyTotals);

        // VER EN EL HTML EL TOTAL GENERAL POR MES DEPENDIENDO DE QUE MES ESTE ME MOSTRARA EL TOTAL DE ESE MES
        let totalgeneralpormes = 0;
        let currentMonth = new Date().getMonth(); // Obtiene el mes actual (0 para enero, 1 para febrero, etc.)

        // Recorre los totales por mes
        for (const [monthIndex, total] of Object.entries(monthlyTotals)) {
            // solo si es Entrada no salida 


            if (parseInt(monthIndex) === currentMonth) { // Compara el índice del mes con el mes actual
                totalgeneralpormes += total;
                // Actualiza el contenido del span con el total correspondiente al mes actual
                document.querySelector('.areas-produccion__numero.totales').textContent = totalgeneralpormes + ' $';
            }
        }




        let filteredLabels = [];
        let filteredData = [];

        Object.entries(monthlyTotals).forEach(([monthIndex, total]) => {
            if (total > 0) {
                filteredLabels.push(monthNames[monthIndex]);
                filteredData.push(total);
            }
        });

        // console.log("Meses con datos:", filteredLabels);
        // console.log("Valores acumulados:", filteredData);



        if (filteredData.length === 0) {
            console.warn("No hay datos para mostrar en el gráfico.");
        }

        // Paleta de colores para 12 meses
        const backgroundColors = [
            'rgba(255, 99, 132, 0.5)', // Rojo
            'rgba(255, 159, 64, 0.5)', // Naranja
            'rgba(255, 205, 86, 0.5)', // Amarillo
            'rgba(75, 192, 192, 0.5)', // Verde agua
            'rgba(54, 162, 235, 0.5)', // Azul
            'rgba(153, 102, 255, 0.5)', // Morado
            'rgba(201, 203, 207, 0.5)', // Gris
            'rgba(255, 140, 0, 0.5)', // Naranja fuerte
            'rgba(0, 206, 209, 0.5)', // Azul turquesa
            'rgba(220, 20, 60, 0.5)', // Rojo oscuro
            'rgba(46, 139, 87, 0.5)', // Verde oscuro
            'rgba(128, 0, 128, 0.5)' // Púrpura
        ];

        const borderColors = backgroundColors.map(color => color.replace('0.5', '1')); // Bordes más oscuros

        const ctx = document.getElementById('totalgeneral').getContext('2d');

        const data = {
            labels: filteredLabels,
            datasets: [{
                label: 'TOTAL GENERAL POR MES',
                data: filteredData,
                backgroundColor: filteredLabels.map((_, index) => backgroundColors[index % 12]),
                borderColor: filteredLabels.map((_, index) => borderColors[index % 12]),
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        new Chart(ctx, config);
    }

    sumadevaloresdeapi();




    // async function productosconstockminimo() {
    //     const url = 'https://megawebsistem.com/admin/api/apiproducts';
    //     const response = await fetch(url);
    //     const datos = await response.json();
    //     // console.log(datos);

    //     // Filtrar productos con stock menor a 2
    //     const lowStockProducts = datos.filter(producto => parseInt(producto.stock_actual) >= 0);

    //     // Definir una lista de colores
    //     const colores = [
    //         'rgba(75, 192, 192, 0.2)',
    //         'rgba(255, 99, 132, 0.2)',
    //         'rgba(54, 162, 235, 0.2)',
    //         'rgba(153, 102, 255, 0.2)',
    //         'rgba(255, 159, 64, 0.2)',
    //         'rgba(255, 99, 132, 0.2)',
    //         'rgba(66, 133, 244, 0.2)',
    //         'rgba(234, 67, 53, 0.2)',
    //         'rgba(51, 51, 51, 0.2)',
    //         'rgba(243, 156, 18, 0.2)',
    //         'rgba(52, 152, 219, 0.2)',
    //         'rgba(39, 174, 96, 0.2)'
    //     ];

    //     // Si tienes más de 12 productos, lo que puedes hacer es reciclar colores o generar colores aleatorios

    //     // Asignar colores dinámicamente en función del índice
    //     const backgroundColors = lowStockProducts.map((_, index) => colores[index % colores.length]);

    //     // mostrar en una grafica de barras
    //     const labels = lowStockProducts.map(producto => producto.nombre_producto);
    //     const data = lowStockProducts.map(producto => parseInt(producto.stock_actual));

    //     const ctx = document.getElementById('productosStockMinimo').getContext('2d');
    //     new Chart(ctx, {
    //         type: 'bar',
    //         data: {
    //             labels: labels,
    //             datasets: [{
    //                 label: 'PRODUCTOS CON STOCK MINIMO',
    //                 data: data,
    //                 backgroundColor: backgroundColors,
    //                 borderColor: 'rgb(203, 223, 223)',
    //                 borderWidth: 1
    //             }]
    //         },
    //         options: {
    //             scales: {
    //                 y: {
    //                     beginAtZero: true
    //                 }
    //             }
    //         }
    //     });
    // }



    // productosconstockminimo();



    async function productosconstockminimo() {
    const url = 'https://megawebsistem.com/admin/api/apiproducts';
    const response = await fetch(url);
    const datos = await response.json();

    // Filtrar productos con stock menor a 2 y con categorías 'toner' o 'unidades de imagen'
    const lowStockProducts = datos.filter(producto => 
        parseInt(producto.stock_actual) < 2 && 
        (producto.categoria === 'Tóner' || producto.categoria === 'Unidades de Imagen')
    );

    // Definir una lista de colores
    const colores = [
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(66, 133, 244, 0.2)',
        'rgba(234, 67, 53, 0.2)',
        'rgba(51, 51, 51, 0.2)',
        'rgba(243, 156, 18, 0.2)',
        'rgba(52, 152, 219, 0.2)',
        'rgba(39, 174, 96, 0.2)'
    ];

    // Asignar colores dinámicamente en función del índice
    const backgroundColors = lowStockProducts.map((_, index) => colores[index % colores.length]);

    // Mostrar en una gráfica de barras
    const labels = lowStockProducts.map(producto => producto.nombre_producto);
    const data = lowStockProducts.map(producto => parseInt(producto.stock_actual));

    const ctx = document.getElementById('productosStockMinimo').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'PRODUCTOS CON STOCK MÍNIMO (TONER Y UNIDADES DE IMAGEN)',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: 'rgb(203, 223, 223)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

productosconstockminimo();




    async function entradasysalidas() {
        const url = 'https://megawebsistem.com/admin/api/apimovimientos';
        const response = await fetch(url);
        const datos = await response.json();
        // console.log(datos);

        // Filtrar los datos por el mes actual
        const currentMonth = new Date().getMonth(); // Obtener el mes actual (0 - 11)
        const currentYear = new Date().getFullYear(); // Obtener el año actual
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const monthName = monthNames[currentMonth]; // Obtener el nombre del mes

        // entradas y salidas del mes actual
        const filteredData = datos.filter(item => {
            const itemDate = new Date(item.fecha_movimiento);

            return itemDate.getMonth() === currentMonth && itemDate.getFullYear() === currentYear;

        });

        // Filtrar entradas y salidas por tipo de movimiento separando en dos grupos
        const entradas = filteredData.filter(item => item.tipo_movimiento === 'Entrada');
        const salidas = filteredData.filter(item => item.tipo_movimiento === 'Salida');

        // console.log("Entradas del mes actual:", entradas);
        // console.log("Salidas del mes actual:", salidas);

        // Agrupar las entradas por área
        const entradasPorArea = {};
        entradas.forEach(item => {
            if (!entradasPorArea[item.area]) {
                entradasPorArea[item.area] = 0;
            }
            entradasPorArea[item.area] += parseFloat(item.costo_nuevo * item.cantidad); // Sumar la cantidad de cada área
        });

        // Agrupar las salidas por área
        const salidasPorArea = {};

        salidas.forEach(item => {
            console.log(item.area); // Verifica qué valor tiene "area"

            if (!salidasPorArea[item.area]) {
                salidasPorArea[item.area] = 0;
            }
            salidasPorArea[item.area] += parseFloat(item.valor * item.cantidad); // Sumar la cantidad de cada área
        });


        // console.log("Entradas por área:", entradasPorArea);
        // console.log("Salidas por área:", salidasPorArea);

        const labels = Object.keys(entradasPorArea); // Las etiquetas (áreas)
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Entradas',
                    data: labels.map(area => entradasPorArea[area] || 0), // Asegurando que las entradas coincidan con las etiquetas
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(146, 192, 192)',
                    borderWidth: 1
                },
                {
                    label: 'Salidas',
                    data: labels.map(area => salidasPorArea[area] || 0), // Asegurando que las salidas coincidan con las etiquetas
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }
            ]
        };


        // Configuración del gráfico

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: `ENTRADAS Y SALIDAS POR AREA Y MES: ${monthName} ${currentYear}` // Título con el mes y año actual
                    }
                }
            }
        };


        // Creación del gráfico

        const ctx = document.getElementById('entradasysalidas').getContext('2d');
        new Chart(ctx, config);




    }



    entradasysalidas();





function cerrarModal() {
    document.getElementById('modalComputadora').style.display = 'none';
}

async function Apicomputadoras() {
    const url = 'https://megawebsistem.com/admin/api/apicomputadoras';
    const response = await fetch(url);
    const datos = await response.json();

    const colores = [
        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)',
        'rgba(199, 199, 199, 0.6)', 'rgba(83, 102, 255, 0.6)', 'rgba(120, 255, 108, 0.6)', 'rgba(255, 108, 255, 0.6)'
    ];

    const hoy = new Date();

    const computadorasConTiempos = datos
        .filter(pc => pc.fecha_compra)
        .map((pc, index) => {
            const fechaCompra = new Date(pc.fecha_compra);
            const diffTiempo = hoy - fechaCompra;
            const diffDiasTotales = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));
            const anios = Math.floor(diffDiasTotales / 365);
            const dias = diffDiasTotales % 365;

            return {
                idReal:pc.id,
                id: pc.numero_interno || "Sin ID",
                usuario: pc.usuario_asignado || "Sin usuario",
                area: pc.area || "Sin área",
                fecha: pc.fecha_compra,
                marca: pc.marca_modelo,
                estado: pc.estado_actual,
                tiempoTexto: `${anios} años ${dias} días`,
                diasTotales: diffDiasTotales,
                color: colores[index % colores.length]
            };
        });

    const etiquetas = computadorasConTiempos.map(pc => `${pc.id} (${pc.usuario})`);
    const datosDias = computadorasConTiempos.map(pc => pc.diasTotales);
    const coloresBackground = computadorasConTiempos.map(pc => pc.color);
    const etiquetasTooltip = computadorasConTiempos.map(pc => pc.tiempoTexto);

    const ctx = document.getElementById('graficoAniosComputadoras').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Antigüedad en días',
                data: datosDias,
                backgroundColor: coloresBackground,
                borderColor: 'rgba(0, 0, 0, 0.3)',
                borderWidth: 1
            }]
        },
        options: {
            onClick: (evt, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const compu = computadorasConTiempos[index];

                    // Llenamos el contenido del modal
                    document.getElementById('contenidoModal').innerHTML = `
                        <p><strong>ID:</strong> ${compu.id}</p>
                        <p><strong>Usuario:</strong> ${compu.usuario}</p>
                        <p><strong>Área:</strong> ${compu.area}</p>
                        <p><strong>Fecha de Compra:</strong> ${compu.fecha}</p>
                        <p><strong>Marca/Modelo:</strong> ${compu.marca}</p>
                        <p><strong>Estado:</strong> ${compu.estado}</p>
                        <p><strong>Antigüedad:</strong> ${compu.tiempoTexto}</p>
                    `;

                    // Mostrar el modal
                    document.getElementById('modalComputadora').style.display = 'flex';

                    // Botón que muestra el ID
                    document.getElementById('btnMostrarID').onclick = function () {

                        // url 
                        window.location.href = `/admin/sistemas/registropc/ver?id=${compu.idReal}`;
                    };
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const index = context.dataIndex;
                            return `Antigüedad: ${etiquetasTooltip[index]}`;
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Antigüedad de Computadoras (años + días)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total de días desde compra'
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 60,
                        minRotation: 30
                    }
                }
            }
        }
    });
}

Apicomputadoras();
</script>