<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


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

<div class="container">
    <div class="item"><a href="/admin/produccion/materia/crear?id=8080"> <i class="fas fa-home"></i> INICIO</a></div>
    <!-- <div class="item"><a href="/admin/produccion/materia/corrugador"> <i class="fas fa-industry"></i> CORRUGADOR</a></div> -->
    <div class="item"><a href="/admin/produccion/materia/corrugadorVentana"> <i class="fas fa-industry"></i> CORRUGADOR</a></div>
  <div class="item"><a href="/admin/produccion/materia/microcorrugador"> <i class="fas fa-scroll"></i> MICRO CORRUGADOR</a></div>
  <div class="item"><a href="/admin/produccion/materia/periodico">  <i class="fas fa-newspaper"></i> PERIÓDICO</a></div>
  <div class="item"><a href="/admin/produccion/materia/excel"><i class="fa-solid fa-arrow-right"></i> SUBIR EXCEL</a></div>
</div>

<!-- <div class="dashboard__contenedor-boton-izquierdo">
    <a class="dashboard__boton" href="/admin/produccion/materia/graficas">
        <i class="fa-solid fa-arrow-right"></i>
        Ver Graficas
    </a>
</div>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/tabla">
        <i class="fa-solid fa-arrow-right"></i>
        Ver a Materia Prima
    </a>
</div> -->
<!-- <div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/excel">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div> -->


<ul class="lista-areas-produccion">
    <!-- <li class="areas-produccion"  data-aos="flip-left">
        <a href="/admin/produccion/materia/corrugador">
            <i class="fas fa-industry"></i> CORRUGADOR
        </a>
    </li>
    <li class="areas-produccion-craft" data-aos="flip-left">
        <a href="/admin/produccion/materia/microcorrugador">
            <i class="fas fa-scroll"></i> MICRO CORRUGADOR
        </a>
    </li>
    <li class="areas-produccion-medium" data-aos="flip-left">
        <a href="/admin/produccion/materia/periodico">
            <i class="fas fa-newspaper"></i> PERIODICO 
        </a>
    </li> -->
    <li class="areas-produccion-estatico"  data-aos="flip-up">
        <a >
            <i class="fas fa-industry"></i> EXISTENCIA CORRUGADOR :
            <?php if ($totalExistenciaCaja > 0) : ?>
                <span id="valor1"  class="areas-produccion__numero"> <?php echo $totalExistenciaCaja ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-estatico-craft"  data-aos="flip-up">
        <a >
            <i class="fas fa-scroll"></i> EXISTENCIA MICRO CORRUGADOR :
            <?php if ($totalExistenciaMicro > 0) : ?>
                <span id="valor2"  class="areas-produccion__numero"> <?php echo $totalExistenciaMicro ?> KG</span>
            <?php endif; ?>
        </a>

    </li>

    <li class="areas-produccion-estatico-medium"  data-aos="flip-up">
        <a>
            <i class="fas fa-newspaper"></i> EXISTENCIA PERIODICO :
            <?php if ($totalExistenciaPeriodico > 0) : ?>
                <span id="valor3" class="areas-produccion__numero"> <?php echo $totalExistenciaPeriodico ?> KG</span>
            <?php endif; ?>
        </a>
    </li>
</ul>


<div class="centrar">

    <div class="card" data-aos="zoom-in">
        <div class="side-bar"></div>
        <div class="content">
            <div class="percentage">TOTAL KILOGRAMOS</div>
            <div class="amount"><?php echo $allkilos ?> KG</div>

            <div class="label">KG</div>
        </div>
    </div>
</div>



<style>


.centrar {
    display: flex;
    justify-content: center;
    align-items: center;
}
   
   .card {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 30%;
            position: relative;
            justify-content: center;
        }
        .side-bar {
            background: red;
            width: 10px;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            border-radius: 10px 0 0 10px;
        }
        .content {
            display: flex;
            flex-direction: column;
            margin-left: 15px;
        }
        .percentage {
            color: red;
            font-size: 16px;
            font-weight: bold;
        }
        .amount {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .chart {
            width: 100%;
            height: 50px;
            background: linear-gradient(to top, #ddd, #8a5ba3);
            border-radius: 5px;
            margin-top: 10px;
        }
        .label {
            font-size: 14px;
            color: gray;
            margin-top: 5px;
            text-align: center;
        }
        .chart .bar {
            width: 50%;
            /* height: 100%; */
            background: red;
            border-radius: 5px;
        }

        .index_graficas {
    display: flex;
    justify-content: center;    
    align-items: center;         
    margin: 20px auto;           
    width: 70%;
    height: 70%;              
    /* background-color: #ddd; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 1rem;
}

/* #existenciaChart {
    max-width: 60%;
    height: auto;
    padding: 0;
} */

#cantidadInfo{
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 1rem;
    padding: 1rem;
    background-color: #fff;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}
      
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<div class="index_graficas">
<canvas id="existenciaChart"></canvas>

    <div id="cantidadInfo">
        <div>TOTAL CORRU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $totalExistenciaCaja ?> KG</div>
        <div>TOTAL MICRO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $totalExistenciaMicro ?> KG</div>
        <div>TOTAL PERIÓDICO: <?php echo $totalExistenciaPeriodico ?> KG</div>
    </div>

</div>







<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.add('loaded');
});

    // Obtener los valores del DOM y convertirlos en números
    const existenciaCorrugadorTotal = parseFloat(document.querySelector('#valor1').textContent.replace(' KG', '').replace('.', '').replace(',', '.'));
    const existenciaCorrugadorMicroTotal = parseFloat(document.querySelector('#valor2').textContent.replace(' KG', '').replace('.', '').replace(',', '.'));
    const existenciaPeriodicaTotal = parseFloat(document.querySelector('#valor3').textContent.replace(' KG', '').replace('.', '').replace(',', '.'));
    
    

    // Calcular el total
    const total = existenciaCorrugadorTotal + existenciaCorrugadorMicroTotal + existenciaPeriodicaTotal;


    // Calcular los porcentajes
    const datos = [
        (existenciaCorrugadorTotal / total) * 100,
        (existenciaCorrugadorMicroTotal / total) * 100,
        (existenciaPeriodicaTotal / total) * 100
    ];

    // Configuración de la gráfica
    const ctx = document.getElementById('existenciaChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',  // Gráfica tipo doughnut
        data: {
            labels: ['Corrugador Total', 'Micro Corrugador Total', 'Periódico Total'],
            datasets: [{
                label: 'Porcentaje de Existencias',
                data: datos,
                backgroundColor: ['#6c757d', '#20c997', '#d63384'], // Colores personalizados
                hoverBackgroundColor: ['#495057', '#17a2b8', '#c82373'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: 'Arial',
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw.toFixed(2)}%`;
                        }
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        size: 16,
                        weight: 'bold'
                    },
                    formatter: (value) => `${value.toFixed(2)}%`,
                    anchor: 'center',
                    align: 'center'
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        },
        plugins: [ChartDataLabels]
    });
</script>


<!-- 

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div> -->








