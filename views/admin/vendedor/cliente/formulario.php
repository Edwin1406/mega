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
        <label class="formulario__label" for="proveedor">Proveedor</label>
        <input
            type="text"
            name="proveedor"
            id="proveedor"
            class="formulario__input"
            placeholder="proveedor"
            value="<?php echo $cliente->proveedor ?? '' ?>">
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
        <label class="formulario__label" for="codigo_producto">Cod.Producto</label>
        <input
            type="text"
            name="codigo_producto"
            id="codigo_producto"
            class="formulario__input"
            placeholder="codigo_producto"
            value="<?php echo $cliente->codigo_producto ?? '' ?>">
    </div>

    
    <div class="formulario__campo">
        <label class="formulario__label" for="estado">Estado</label>
        <select
            name="estado"
            id="estado"
            class="formulario__input">
            <option value="">Selecciona una opción</option>
            <option value="ENVIADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'ENVIADO') ? 'selected' : ''; ?>>ENVIADO</option>
            <option value="PAUSADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'PAUSADO') ? 'selected' : ''; ?>>PAUSADO</option>
            <option value="TERMINADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'TERMINADO') ? 'selected' : ''; ?>>TERMINADO</option>
        </select>
    </div>
    <div class="formulario__campo">
    <label class="formulario__label" for="pdf">Subir PDF</label>
    <input
        type="file"
        name="pdf"
        id="pdf"
        class="formulario__input"
        placeholder="Subir PDF del cliente">
</div>

<?php if(isset($cliente->pdf)) :?>
    <div class="formulario__campo">
        <a class="formulario__texto">Archivo Actual:</a>
        <div class="formulario__archivo">
            <a href="<?php echo $_ENV['HOST'] . '/src/visor/' . $cliente->pdf; ?>" target="_blank" class="formulario__enlace">
                Descargar/Ver PDF
            </a>
        </div>
    </div>
<?php endif;?>

</fieldset>

