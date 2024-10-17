<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">INGRESE LA AREA</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="area">AREA</label>
        <input
            type="text"
            name="area"
            id="area"
            class="formulario__input"
            placeholder="ingrese el area"
            value="<?php echo isset($area->area) ? trim($area->area) : ''; ?>">

    </div>








</fieldset>