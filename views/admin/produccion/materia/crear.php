<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

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
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/excel">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div>


<ul class="lista-areas-produccion">
    <li class="areas-produccion"  data-aos="flip-left">
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
    </li>
    <li class="areas-produccion-estatico"  data-aos="flip-up">
        <a >
            <i class="fas fa-industry"></i> TOTAL EXISTENCIA CORRUGADOR :
            <?php if ($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG</span>
            <?php endif; ?>
        </a>
    </li>

    <li class="areas-produccion-estatico-craft"  data-aos="flip-up">
        <a >
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA MICRO CORRUGADOR :
            <?php if ($totalExistenciaMicro > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistenciaMicro ?> KG</span>
            <?php endif; ?>
        </a>

    </li>

    <li class="areas-produccion-estatico-medium"  data-aos="flip-up">
        <a>
            <i class="fas fa-newspaper"></i> TOTAL EXISTENCIA PERIODICO :
            <?php if ($totalExistenciaPeriodico > 0) : ?>
                <span id="valor" class="areas-produccion__numero"> <?php echo $totalExistenciaPeriodico ?> KG</span>
            <?php endif; ?>
        </a>
    </li>
</ul>


<script>
// Selecciona el elemento con id "valor"
const valorElemento = document.querySelector('#valor');
const valorNumero = parseFloat(valorTexto.split(' ')[0]);


    console.log('Valor completo:', valorTexto);
    console.log('Valor numérico:', valorNumero);




</script>

<div class="centrar">

    <div class="card" data-aos="zoom-in">
        <div class="side-bar"></div>
        <div class="content">
            <div class="percentage">TOTAL KILOGRAMOS</div>
            <div class="amount"><?php echo $allkilos?> KG</div>
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
            height: 100%;
            background: red;
            border-radius: 5px;
        }
</style>

<!-- 

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div> -->