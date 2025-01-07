<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/tabla">
    <i class="fa-regular fa-eye"></i>
        VER ARCHIVO 
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST"   class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario_actualizar.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar ">

        
    </form>

</div>