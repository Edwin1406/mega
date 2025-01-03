<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/crear">
        <i class="fa-solid fa-plus"></i>
        NUEVO PAPEL
    </a>
</div>


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Materia Prima</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo">Tipo</label>
        <input
            type="text"
            name="tipo"
            id="tipo"
            class="formulario__input"
            placeholder="Tipo de materia prima"
            value="<?php echo $papel->tipo ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="text"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="ancho del papel"
            value="<?php echo $papel->ancho ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="peso">peso</label>
        <input
            type="text"
            name="peso"
            id="peso"
            class="formulario__input"
            placeholder="peso del papel"
            value="<?php echo $papel->peso ?? '' ?>">
    </div>
    
</fieldset>

