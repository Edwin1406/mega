<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>
    
        <form method="POST" action="/admin/vendedor/cliente/crear"  class="formulario
        " enctype="multipart/form-data">
            <fieldset>
                <legend>Información del Cliente</legend>
                <div class="formulario
                ">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del Cliente" value="<?php echo $cliente->nombre ?? '' ?>">
        </form>
</div>



<script>
    const respuesta = document.querySelector('div .alerta');
    if(respuesta) {
        setTimeout(() => {
            respuesta.remove();
        }, 3000);
    }


</script>