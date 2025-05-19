<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">RELCAMOS Y QUEJAS  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="responsable_reporte">responsable</label>
        <input
            type="text"
            name="responsable_reporte"
            id="responsable_reporte"
            class="formulario__input"
            placeholder="responsable_reporte"
            value="<?php echo $comercial->responsable_reporte ?? '' ?>">
    </div>

 <!-- option de clientes  -->
    <div class="formulario__campo">
        <label class="formulario__label" for="cliente">cliente</label>
        <select name="cliente" id="cliente" class="formulario__input">
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach ($clientes as $cliente) : ?>
                <option <?php echo $cliente->cliente === $cliente->id ? 'selected' : ''; ?> value="<?php echo $cliente->id; ?>"><?php echo $cliente->nombre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    

    <div class="formulario__campo">
        <label class="formulario__label" for="per_reporta_reclamo">per_reporta_reclamo</label>
        <input
            type="text"
            name="per_reporta_reclamo"
            id="per_reporta_reclamo"
            class="per_reporta_reclamo"
            placeholder="per_reporta_reclamo"
            value="<?php echo $comercial->per_reporta_reclamo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="factura">factura</label>
        <input
            type="text"
            name="factura"
            id="trafacturader"
            class="formulario__input"
            placeholder="Nombre del factura"
            value="<?php echo $comercial->factura ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_factura">fecha_factura</label>
        <input
            type="text"
            name="fecha_factura"
            id="fecha_factura"
            class="formulario__input"
            placeholder="Nombre de la fecha_factura"
            value="<?php echo $comercial->fecha_factura ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion_producto">descripcion_producto</label>
        <input
            type="text"
            name="descripcion_producto"
            id="descripcion_producto"
            class="formulario__input"
            placeholder="Nombre de la descripcion_producto"
            value="<?php echo $comercial->descripcion_producto ?? '' ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="motivo_reclamo">motivo_reclamo</label>
        <input
            type="text"
            name="motivo_reclamo"
            id="motivo_reclamo"
            class="formulario__input"
            placeholder="motivo_reclamo"
            value="<?php echo $comercial->motivo_reclamo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="accion_solicitada">accion_solicitada</label>
        <input
            type="text"
            name="accion_solicitada"
            id="accion_solicitada"
            class="formulario__input"
            placeholder="accion_solicitada)"
            value="<?php echo $comercial->accion_solicitada ?? '' ?>">
    </div>

</fieldset>




