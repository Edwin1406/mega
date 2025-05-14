<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Papel</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
        <select class="formulario__input" name="tipo_maquina" id="tipo_maquina">
            <option value="">-- Selecciona un tipo --</option>
            <option value="corrugador" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'corrugador' ? 'selected' : '' ?>>Corrugador</option>
            <option value="micro" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'micro' ? 'selected' : '' ?>>Micro</option>
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