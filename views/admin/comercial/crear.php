<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/tabla" >
        <i class="fa-solid fa-circle-arrow-left"></i>
            TABLA
    </a>
</div>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/subirexcelreclamos">
        <i class="fa-solid fa-arrow-right"></i>
        SUBIR EXCEL
    </a>
</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/comercial/crear "  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" name="guardar" type="submit" value="Registrar Reclamo">

        
    </form>

</div>