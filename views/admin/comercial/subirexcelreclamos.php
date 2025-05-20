




<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/comercial/subirexcelreclamos"  class="formulario" enctype="multipart/form-data">

     <fieldset class="formulario__fieldset">


    <legend class="formulario__legend">Subir Excel</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="excel">Excel</label>
        <input
            type="file"
            name="file"
            id="file"
            class="formulario__input"
            placeholder="Excel"
            accept=".xls,.xlsx">
    </div>
</fieldset>

    

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Subir Excel">

        
    </form>

</div>