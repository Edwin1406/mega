<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<!-- <div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/control/tabla?id=<?php echo $token; ?>">
        <i class="fa-regular fa-eye"></i>
        VER TABLA
    </a>
</div> -->

<div class="dashboard__formulario">



    <?php if (isset($resultado) && $resultado == 1): ?>
        <div class="alerta exito">
            <p>Archivo registrado correctamente</p>
        </div>
    <?php elseif (isset($resultado) && $resultado == 0): ?>
        <div class=" alerta error">
            <p>Error al registrar el archivo</p>
        </div>
    <?php endif; ?>


    <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/control/crear" class="formulario-troquelado" enctype="multipart/form-data">


        <?php include_once __DIR__ . '/formulario.php'  ?>

        <input class="formulario-troquelado__submit formulario-troquelado__submit--registrar" type="submit" value="Registrar Control de Producción">


    </form>

</div>





  <iframe 
    src="https://app.powerbi.com/links/zTR1Xvjtsk?ctid=ab7267a0-b08e-48e3-abb3-a296fae02e3b&pbi_source=linkShare"
    allowfullscreen="true">
  </iframe>