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
    
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    
    .item:nth-child(1), .item:nth-child(2), .item:nth-child(3), .item:nth-child(4), .item:nth-child(5) {
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

<div class="container">
    <div class="item"><a href="/admin/sistemas/index?id=80ad04ffdfb4872f9b4603cdf4932f23"> <i class="fas fa-home"></i> INICIO</a></div>
    <div class="item"><a href="/admin/sistemas/productos/crear"> <i class="fas fa-industry"></i> PRODUCTOS</a></div>
  <div class="item"><a href="/admin/sistemas/productos/tabla"> <i class="fas fa-scroll"></i> TABLA</a></div>
  <div class="item"><a href="/admin/sistemas/movimiento/movimientos">  <i class="fas fa-newspaper"></i> MOVIMIENTOS</a></div>
  <div class="item"><a href="/admin/sistemas/solicitudes/solicitud"><i class="fa-solid fa-arrow-right"></i> GASTOS</a></div>
</div>




<ul class="lista-areas-produccion">

    <li class="areas-produccion-estatico" data-aos="fade-up">
        <a>
            <i class="fas fa-scroll"></i> INVETARIO REGISTRADO:
            <?php if ($registros > 0) : ?>
                <span class="areas-produccion__numero">  <?php echo $registros ?>  </span>
            <?php endif; ?>
        </a>
    </li>


</ul>


<b></b>


<style>
    .contenido-graficos{
        display: flex;
    }
</style>



<div class="contenido-graficos">
    
    <canvas id="myChart"></canvas>
    
    <canvas id="totalgeneral"></canvas>
</div>

    

<script>
document.addEventListener('DOMContentLoaded', async function() {
    await datosapi();
});

async function datosapi() {
    const url = 'https://megawebsistem.com/admin/api/apimovimientos';
    const response = await fetch(url);
    const datos = await response.json();
    console.log(datos);

    // Filtrar los datos por el mes actual
    const currentMonth = new Date().getMonth(); // Obtener el mes actual (0 - 11)
    const currentYear = new Date().getFullYear(); // Obtener el año actual
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const monthName = monthNames[currentMonth]; // Obtener el nombre del mes

    const filteredData = datos.filter(item => {
        const itemDate = new Date(item.fecha_movimiento);
        return itemDate.getMonth() === currentMonth && itemDate.getFullYear() === currentYear;
    });

    console.log("Datos del mes actual:", filteredData);

    // Agrupar los datos por área
    const areas = {};
    filteredData.forEach(item => {
        if (!areas[item.area]) {
            areas[item.area] = 0;
        }
        areas[item.area] += parseFloat(item.valor); // Sumar la cantidad de cada área
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
            borderColor: 'rgba(75, 192, 192, 1)',
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
                    text: `Datos del mes de ${monthName} ${currentYear}` // Título con el mes y año actual
                }
            }
        }
    };

    // Creación del gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, config);
}

document.addEventListener("DOMContentLoaded", function () {
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
                        Toastify({
                            text: `⚠️ Sin Stock: ${producto.nombre_producto} (Stock: ${producto.stock_actual}) (Area: ${producto.area} ) (Categoria: ${producto.categoria})`,
                            duration: 5000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                            stopOnFocus: true,
                            borderradius: "1rem",


                            onClick: function() {
                                // Redirigir a la página de productos
                                window.location.href = "/admin/sistemas/movimiento/movimientos";
                            }
                        }).showToast();

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



async function sumadevaloresdeapi(){
    const url = 'https://megawebsistem.com/admin/api/apimovimientos';
    const respuesta = await fetch(url);
    const resultado = await respuesta.json();

    console.log("Datos obtenidos de la API:", resultado);

    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    
    let monthlyTotals = {};
    monthNames.forEach((month, index) => {
        monthlyTotals[index] = 0;
    });

    resultado.forEach(item => {
        const itemDate = new Date(item.fecha_movimiento);
        console.log("Fecha procesada:", itemDate, "Mes:", itemDate.getMonth());

        const monthIndex = itemDate.getMonth();
        monthlyTotals[monthIndex] += Number(item.valor); 
    });

    console.log("Total acumulado por mes:", monthlyTotals);

    let filteredLabels = [];
    let filteredData = [];

    Object.entries(monthlyTotals).forEach(([monthIndex, total]) => {
        if (total > 0) {
            filteredLabels.push(monthNames[monthIndex]); 
            filteredData.push(total); 
        }
    });

    console.log("Meses con datos:", filteredLabels);
    console.log("Valores acumulados:", filteredData);

    if (filteredData.length === 0) {
        console.warn("No hay datos para mostrar en el gráfico.");
    }

    // Paleta de colores para 12 meses
    const backgroundColors = [
        'rgba(255, 99, 132, 0.5)',  // Rojo
        'rgba(255, 159, 64, 0.5)',  // Naranja
        'rgba(255, 205, 86, 0.5)',  // Amarillo
        'rgba(75, 192, 192, 0.5)',  // Verde agua
        'rgba(54, 162, 235, 0.5)',  // Azul
        'rgba(153, 102, 255, 0.5)', // Morado
        'rgba(201, 203, 207, 0.5)', // Gris
        'rgba(255, 140, 0, 0.5)',   // Naranja fuerte
        'rgba(0, 206, 209, 0.5)',   // Azul turquesa
        'rgba(220, 20, 60, 0.5)',   // Rojo oscuro
        'rgba(46, 139, 87, 0.5)',   // Verde oscuro
        'rgba(128, 0, 128, 0.5)'    // Púrpura
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





</script>





