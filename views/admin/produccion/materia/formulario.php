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
        <label class="formulario__label" for="peso">Peso</label>
        <input
            type="text"
            name="peso"
            id="peso"
            class="formulario__input"
            placeholder="peso del papel"
            value="<?php echo $materia->peso ?? '' ?>">
    </div>
      <?php if (isset($materia->id)): ?>
    <div class="formulario__campo">
        <label class="formulario__label" for="menos_peso">Menos Peso</label>
        <input
            type="text"
            name="menos_peso"
            id="menos_peso"
            class="formulario__input"
            placeholder="menos peso del papel"
            value="<?php echo $materia->menos_peso ?? '' ?>">
    </div>
    <?php endif; ?>

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
        <label class="formulario__label" for="proveedor">Proveedor</label>
        <input
            type="text"
            name="proveedor"
            id="proveedor"
            class="formulario__input"
            placeholder="proveedor del papel"
            value="<?php echo $materia->proveedor ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio</label>
        <input
            type="text"
            name="precio"
            id="precio"
            class="formulario__input"
            placeholder="precio del papel"
            value="<?php echo $materia->precio ?? '' ?>">
    </div>

</fieldset>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const url = window.location.href;
        const isEditable = url.includes('editar');
        const isCreating = url.includes('crear');
        const inputs = document.querySelectorAll('.formulario__input');

        inputs.forEach(input => {
            if (isCreating) {
                // Habilitar todos los campos si la URL contiene 'crear'
                input.removeAttribute('readonly');
            } else if (isEditable) {
                // Solo el campo "menos_peso" será editable
                if (input.id !== 'menos_peso') {
                    input.setAttribute('readonly', true);
                }
            } else {
                // Bloquear todos los campos si no es la URL correcta
                input.setAttribute('readonly', true);
            }
        });
    });
</script>

