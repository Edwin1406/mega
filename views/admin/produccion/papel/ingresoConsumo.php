<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tabla">
        <i class="fa-regular fa-eye"></i>
        VER PAPEL
    </a>

</div>



<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/ingresoConsumo" class="formulario" enctype="multipart/form-data">


        <div class="formulario__campo">
            <label class="formulario__label" for="id_orden">ID ORDEN</label>
            <input
                type="number"
                name="id_orden"
                id="id_orden"
                class="formulario__input"
                placeholder="id_orden "
                value="<?php echo $papel->id_orden ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="CONSUMO">CONSUMO PAPEL</label>
            <input
                type="decimal"
                name="CONSUMO"
                id="CONSUMO"
                class="formulario__input"
                placeholder="CONSUMO PAPEL"
                value="<?php echo $papel->CONSUMO ?? '' ?>">
        </div>
        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">
    </form>

</div>



