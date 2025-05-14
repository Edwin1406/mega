

<?php $editando = strpos($_SERVER['REQUEST_URI'], 'editar') !== false; ?>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Papel</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
        <select class="formulario__input" name="tipo_maquina" id="tipo_maquina">
            <option value="">-- Selecciona un tipo --</option>
            <option value="PREPRINTER" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'PRE-PRINTER' ? 'selected' : '' ?>>PRE-PRINTER</option>
            <option value="CALDERO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'CALDERO' ? 'selected' : '' ?>>CALDERO</option>
            <option value="ELECTRICO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'ELECTRICO' ? 'selected' : '' ?>>ELECTRICO</option>
            <option value="COMPRESOR" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'COMPRESOR' ? 'selected' : '' ?>>COMPRESOR</option>
            <option value="HUMEDO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'HUMEDO' ? 'selected' : '' ?>>HUMEDO</option>
            <option value="FRENO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'FRENO' ? 'selected' : '' ?>>FRENO</option>
            <option value="PRESION" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'PRESION' ? 'selected' : '' ?>>PRESION</option>
            <option value="DESPEGADO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'DESPEGADO' ? 'selected' : '' ?>>DESPEGADO</option>
            <option value="EXTRATRIM" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'EXTRATRIM' ? 'selected' : '' ?>>EXTRATRIM</option>
            <option value="OTRO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'OTRO' ? 'selected' : '' ?>>OTRO</option>

        </select>

    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="SF">SF</label>
        <input
            type="number"
            name="SF"
            id="SF"
            class="formulario__input"
            placeholder="SF"
            value="<?php echo $papel->SF ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="SF">LG</label>
        <input
            type="number"
            name="LG"
            id="LG"
            class="formulario__input"
            placeholder="LG"
            value="<?php echo $papel->LG ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ERRO">ERRO</label>
        <input
            type="number"
            name="ERRO"
            id="ERRO"
            class="formulario__input"
            placeholder="ERRO"
            value="<?php echo $papel->ERRO ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="HUN">HUN</label>
        <input
            type="number"
            name="HUN"
            id="HUN"
            class="formulario__input"
            placeholder="HUN"
            value="<?php echo $papel->HUN ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="MDO">MDO</label>
        <input
            type="number"
            name="MDO"
            id="MDO"
            class="formulario__input"
            placeholder="MDO"
            value="<?php echo $papel->MDO ?? '' ?>">
    </div>

<?php if ($editando): ?>
    <div class="formulario__campo">
        <label class="formulario__label" for="consumo_papel">Consumo Papel</label>
        <input
            type="number"
            name="consumo_papel"
            id="consumo_papel"
            class="formulario__input"
            placeholder="Consumo Papel"
            value="<?php echo $papel->consumo_papel ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="TOTAL">TOTAL</label>
        <input
            type="number"
            name="TOTAL"
            id="TOTAL"
            class="formulario__input"
            placeholder="TOTAL"
            value="<?php echo $papel->TOTAL ?? '' ?>">
    </div>
<?php endif; ?>

</fieldset>