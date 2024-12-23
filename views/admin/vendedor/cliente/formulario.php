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
   

    <label for="pdf">Archivo PDF:</label>
<input type="file" id="pdf" accept="application/pdf" name="propiedad[pdf]">

<?php if($propiedad->pdf) { ?>
    <a href="/uploads/pdf/<?php echo htmlspecialchars($propiedad->pdf); ?>" target="_blank">Ver PDF subido</a>
<?php } ?>





    
</fieldset>