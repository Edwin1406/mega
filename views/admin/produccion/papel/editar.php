<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tabla" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST"   class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario2.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Papel">

        
    </form>

</div>