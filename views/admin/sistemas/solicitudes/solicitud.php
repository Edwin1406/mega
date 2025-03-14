<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/sistemas/solicitudes/solicitudpost "  class="formulario" enctype="multipart/form-data">
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar solicitud">

        
    </form>

</div>