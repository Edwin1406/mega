<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/crear">
        <i class="fa-solid fa-plus"></i>
        NUEVO PAPEL
    </a>
</div>


<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Materia Prima">

        
    </form>

</div>