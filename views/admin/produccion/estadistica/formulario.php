<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingreso de la información para estadistica de las graficas </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="import">Import</label>
        <input
            type="text"
            name="import"
            id="import"
            class="formulario__input"
            placeholder="Numero de import"
            value="<?php echo $maquina->nombre ?? '' ?>">
    </div>


</fieldset>