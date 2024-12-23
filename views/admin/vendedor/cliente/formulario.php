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