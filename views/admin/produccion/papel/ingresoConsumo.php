<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tabla">
    <i class="fa-regular fa-eye"></i>
        VER PAPEL
    </a>

</div>





<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/ingresoConsumo"  class="formulario" enctype="multipart/form-data">

     
<div class="formulario__campo">
        <label class="formulario__label" for="CONSUMO">CONSUMO PAPEL</label>
        <input
            type="number"
            name="CONSUMO"
            id="CONSUMO"
            class="formulario__input"
            placeholder="CONSUMO PAPEL"
            value="<?php echo $papel->CONSUMO ?? '' ?>">
    </div>
        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">

        
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    