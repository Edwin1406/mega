<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingresar visor </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_cliente">Nombre Cliente</label>
        <input
            type="text"
            name="nombre_cliente"
            id="nombre_cliente"
            class="formulario__input"
            placeholder="nombre cliente"
            value="<?php echo $cliente->nombre_cliente ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_producto">Nombre Producto</label>
        <input
            type="text"
            name="nombre_producto"
            id="nombre_producto"
            class="formulario__input"
            placeholder="nombre_producto"
            value="<?php echo $cliente->nombre_producto ?? '' ?>">
    </div>
   

    <div class="formulario__campo">
    <label class="formulario__label" for="imagen">Subir PDF</label>
    <input
        type="file"
        name="imagen"
        id="imagen"
        class="formulario__input"
        placeholder="imagen del cliente"
        value="<?php echo $cliente->imagen ?? '' ?>">
</div>

<label class="formulario__label" for="imagen">Subir PDF</label>
            <div id="drop-zone">
                Arrastra tu archivo aquí o haz clic para seleccionar un archivo
            </div>
            <input
                type="file"
                name="imagen"
                id="imagen"
                class="formulario__input"
                accept=".pdf"
                style="display: none;">



    
</fieldset>