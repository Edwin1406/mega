<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton-izquierdo">
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
</div>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/excel">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div>


<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div>