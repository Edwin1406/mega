<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del ponente"
            value="<?php echo $ponente->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input
            type="text"
            name="apellido"
            id="apellido"
            class="formulario__input"
            placeholder="Apellido del ponente"
            value="<?php echo $ponente->apellido ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input
            type="text"
            name="ciudad"
            id="ciudad"
            class="formulario__input"
            placeholder="Ciudad del ponente"
            value="<?php echo $ponente->ciudad ?? '' ?>">
    </div>








</fieldset>