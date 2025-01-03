<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Materia Prima</legend>
    <?php if (isset($materia->id)): ?>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_rollo">Nombre del Material</label>
        <input
            type="text"
            name="nombre_rollo"
            id="nombre_rollo"
            class="formulario__input"
            placeholder="Nombre del rollo"
            value="<?php echo $materia->nombre_rollo ?? '' ?>"
            readonly>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="tipo">Tipo</label>
        <input
            type="text"
            name="tipo"
            id="tipo"
            class="formulario__input"
            placeholder="Tipo de materia prima"
            value="<?php echo $materia->tipo ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="text"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="ancho del papel"
            value="<?php echo $materia->ancho ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="peso">Peso</label>
        <input
            type="text"
            name="peso"
            id="peso"
            class="formulario__input"
            placeholder="peso del papel"
            value="<?php echo $materia->peso ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="menos_peso">Menos Peso</label>
        <input
            type="text"
            name="menos_peso"
            id="menos_peso"
            class="formulario__input"
            placeholder="menos peso del papel"
            value="<?php echo $materia->menos_peso ?? '' ?>"
            <?php echo isset($materia->id) ? '' : 'readonly'; ?>>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje">Gramaje</label>
        <input
            type="text"
            name="gramaje"
            id="gramaje"
            class="formulario__input"
            placeholder="gramaje del papel"
            value="<?php echo $materia->gramaje ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ced">CED</label>
        <input
            type="text"
            name="ced"
            id="ced"
            class="formulario__input"
            placeholder="ced del papel"
            value="<?php echo $materia->ced ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="proveedor">Proveedor</label>
        <input
            type="text"
            name="proveedor"
            id="proveedor"
            class="formulario__input"
            placeholder="proveedor del papel"
            value="<?php echo $materia->proveedor ?? '' ?>"
            readonly>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio</label>
        <input
            type="text"
            name="precio"
            id="precio"
            class="formulario__input"
            placeholder="precio del papel"
            value="<?php echo $materia->precio ?? '' ?>"
            readonly>
    </div>
    <?php endif; ?>
</fieldset>
