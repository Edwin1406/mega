<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingresar visor </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="codigo">Codigo</label>
        <input
            type="text"
            name="codigo"
            id="codigo"
            class="formulario__input"
            placeholder="Codigo del cliente"
            value="<?php echo $cliente->codigo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del cliente"
            value="<?php echo $cliente->nombre ?? '' ?>">
    </div>
   

    <div class="formulario__campo">
        <label class="formulario__label" for="imagen">Imagen</label>
        <input
            type="file"
            name="imagen"
            id="imagen"
            class="formulario__input"
            placeholder="imagen del cliente"
            value="<?php echo $cliente->imagen ?? '' ?>">
    </div>
    

    
</fieldset>