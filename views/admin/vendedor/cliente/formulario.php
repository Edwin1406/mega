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

<!-- 
    <div class="formulario__campo">
        <label class="formulario__label" for="archivo">Subir PDF</label>
        <input
            type="file"
            name="archivo"
            id="archivo"
            class="formulario__input"
            placeholder="imagen del cliente"
            value="<?php echo $cliente->imagen ?? '' ?>">
    </div> -->

    <label for="imagen">Archivo PDF:</label>
    <input type="file" id="imagen" accept="application/pdf" name="cliente[imagen]">

    <?php if ($cliente->imagen) { ?>
        <p>Archivo actual: <a href="/src/visor/<?php echo $cliente->imagen ?>" target="_blank"><?php echo $cliente->imagen ?></a></p>
    <?php } ?>






</fieldset>