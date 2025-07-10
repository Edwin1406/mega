<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/tabla">
    <i class="fa-regular fa-eye"></i>
        VER ARCHIVO 
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>


<?php if(isset($resultado) && $resultado === 1): ?>
    <div class="alerta alerta--exito">
        <p>Archivo registrado correctamente</p>
    </div>
<?php elseif(isset($resultado) && $resultado === 0): ?>
    <div class="alerta alerta--error">
        <p>Error al registrar el archivo</p>
    </div>
<?php endif; ?>

    <form method="POST" action="/admin/vendedor/cliente/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Archivo">

        
    </form>

</div>