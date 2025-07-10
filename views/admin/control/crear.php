


<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/control/tabla?id=<?php echo $token;?>">
    <i class="fa-regular fa-eye"></i>
        VER TABLA
    </a>

</div>


<?php if(isset($resultado) && $resultado == 1): ?>
    <div class=" alerta--exito">
        <p>Archivo registrado correctamente</p>
    </div>
<?php elseif(isset($resultado) && $resultado == 0): ?>
    <div class=" alerta--error">
        <p>Error al registrar el archivo</p>
    </div>
<?php endif; ?>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/control/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Control de Producción">

        
    </form>

</div>