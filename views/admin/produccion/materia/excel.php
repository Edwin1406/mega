
<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/materia/excel"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/subirExcel.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Subir Excel">

        
    </form>

</div>