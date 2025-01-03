
<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Materia Prima</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_rollo">Nombre del Material</label>
        <input
            type="text"
            name="nombre_rollo"
            id="nombre_rollo"
            class="formulario__input"
            placeholder="Nombre del rollo"
            value="<?php echo $materia->nombre_rollo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="tipo">Tipo</label>
        <input
            type="text"
            name="tipo"
            id="tipo"
            class="formulario__input"
            placeholder="Tipo de materia prima"
            value="<?php echo $materia->tipo ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="text"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="ancho del papel"
            value="<?php echo $materia->ancho ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="peso">peso</label>
        <input
            type="text"
            name="peso"
            id="peso"
            class="formulario__input"
            placeholder="peso del papel"
            value="<?php echo $materia->peso ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje">Gramaje</label>
        <input
            type="text"
            name="gramaje"
            id="gramaje"
            class="formulario__input"
            placeholder="gramaje del papel"
            value="<?php echo $materia->gramaje ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ced">CED</label>
        <input
            type="text"
            name="ced"
            id="ced"
            class="formulario__input"
            placeholder="ced del papel"
            value="<?php echo $materia->ced ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="proveedor">proveedor</label>
        <input
            type="text"
            name="proveedor"
            id="proveedor"
            class="formulario__input"
            placeholder="proveedor del papel"
            value="<?php echo $materia->proveedor ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">precio</label>
        <input
            type="text"
            name="precio"
            id="precio"
            class="formulario__input"
            placeholder="precio del papel"
            value="<?php echo $materia->precio ?? '' ?>">
    </div>


</fieldset>

