<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/cotizador">
    <i class="fa-regular fa-eye"></i>
        VER COTIZADOR
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/vendedor/cliente/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Cliente">

        
    </form>

</div>