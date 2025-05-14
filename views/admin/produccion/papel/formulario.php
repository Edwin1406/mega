<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery y Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<style>
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #999;
    background-color: red;
    padding: 5px;
    border-radius: 4px;
}
    
</style>

<?php $editando = strpos($_SERVER['REQUEST_URI'], 'editar') !== false; ?>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Papel</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
        <select class="formulario__input select2" name="tipo_maquina" id="tipo_maquina">
            <option value="">-- Selecciona un tipo --</option>
            <option value="PREPRINTER" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'preprinter' ? 'selected' : '' ?>>PRE-PRINTER</option>
            <option value="CALDERO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'caldero' ? 'selected' : '' ?>>CALDERO</option>
            <option value="ELECTRICO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'electrico' ? 'selected' : '' ?>>ELECTRICO</option>
            <option value="COMPRESOR" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'compresor' ? 'selected' : '' ?>>COMPRESOR</option>
            <option value="HUMEDO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'humedo' ? 'selected' : '' ?>>HUMEDO</option>
            <option value="FRENO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'freno' ? 'selected' : '' ?>>FRENO</option>
            <option value="PRESION" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'presion' ? 'selected' : '' ?>>PRESION</option>
            <option value="DESPEGADO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'despegado' ? 'selected' : '' ?>>DESPEGADO</option>
            <option value="EXTRATRIM" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'extratrim' ? 'selected' : '' ?>>EXTRATRIM</option>
            <option value="OTRO" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'otro' ? 'selected' : '' ?>>OTRO</option>
        </select>
    </div>


    <script>
        $(document).ready(function() {
            $('#tipo_maquina').select2({
                placeholder: "-- Selecciona un tipo --",
                allowClear: true,
            });
        });
    </script>


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