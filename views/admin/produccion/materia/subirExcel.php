<fieldset class="formulario__fieldset">


    <legend class="formulario__legend">Subir Excel</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="excel">Excel</label>
        <input
            type="file"
            name="excel"
            id="excel"
            class="formulario__input"
            placeholder="Excel"
            accept=".xls,.xlsx"
            value="<?php echo $materia->excel ?? '' ?>">
    </div>
</fieldset>