<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<style>
    .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
</style>
<!-- VER TABLA -->
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tablaconsumo">
        <i class="fa-regular fa-eye"></i>
        VER TABLA DE CONSUMO GENERAL
    </a>
</div>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/consumo_general" class="formulario" enctype="multipart/form-data">


        <div class="formulario__campo">
                     <div class="formulario__campo">
                <label class="formulario__label" for="accion">Accion:</label>
                <input
                    type="number"
                    name="accion"
                    id="accion"
                    class="formulario__input"
                    placeholder="accion"
                    value="<?php echo $consumo->accion ?? '' ?>">
            </div>
        </div>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Editar Consumo General">
    </form>
</div>