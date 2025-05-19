<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">RELCAMOS Y QUEJAS </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="responsable_reporte">Responsable</label>
        <input
            type="text"
            name="responsable_reporte"
            id="responsable_reporte"
            class="formulario__input"
            placeholder="responsable_reporte"
            value="<?php echo $comercial->responsable_reporte ?? '' ?>">
    </div>

    <!-- option de clientes  -->
    <!-- <div class="formulario__campo">
        <label class="formulario__label" for="cliente">cliente</label>
        <select name="cliente" id="cliente" class="formulario__input">
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach ($clientes as $cliente) : ?>
                <option <?php echo $cliente->cliente === $cliente->id ? 'selected' : ''; ?> value="<?php echo $cliente->id; ?>"><?php echo $cliente->cliente; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
     -->


                <label class="formulario__label" for="cliente">Cliente</label>

        <select name="cliente" onchange="this.form.submit()" class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente->cliente ?>"
                    <?= $cliente->cliente === $clienteSeleccionado ? 'selected' : '' ?>>
                    <?= $cliente->cliente ?>
                </option>
            <?php endforeach; ?>
        </select>



        <div class="formulario__campo">
                            <label class="formulario__label" for="numero">N. Factura</label>

            <select name="factura" class="formulario__input" onchange="this.form.submit()">
                <option value="">-- Seleccione factura --</option>
                <?php foreach ($facturas as $factura): ?>
                    <option value="<?= $factura ?>"
                        <?= $factura === $facturaSeleccionada ? 'selected' : '' ?>>
                        <?= $factura ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>


        <div class="formulario__campo">
                <label class="formulario__label" for="descripcion">Descripcion</label>

            <select name="descripcion" onchange="this.form.submit()" class="formulario__input">
                <option value="">-- Seleccione descripción --</option>
                <?php foreach ($descripciones as $desc): ?>
                    <option value="<?= htmlspecialchars($desc) ?>"
                        <?= $desc === $descripcionSeleccionada ? 'selected' : '' ?>>
                        <?= $desc ?>
                    <?php endforeach; ?>
            </select>

        </div>

        <div class="formulario__campo">
                <label class="formulario__label" for="fecha_factura">Fecha Factura</label>

            <input
                type="text"
                name="fecha_factura"
                id="fecha_factura"
                class="formulario__input"
                placeholder="Nombre de la fecha_factura"
                value="<?= htmlspecialchars($fechaFactura ?? '') ?>"
                readonly>
        </div>





        <div class="formulario__campo">
            <label class="formulario__label" for="per_reporta_reclamo">per_reporta_reclamo</label>
            <input
                type="text"
                name="per_reporta_reclamo"
                id="per_reporta_reclamo"
                class="formulario__input"
                placeholder="Nombre del per_reporta_reclamo"
                value="<?php echo $comercial->per_reporta_reclamo ?? '' ?>">
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
            <select name="motivo_reclamo" id="motivo_reclamo" class="formulario__input">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="impresion">impresion</option>
                <option value="calidad papel">Calidad papel</option>
                <option value="pegado">Pegado</option>
                <option value="empaque">empaque</option>
            </select>
        </div>

        <div class="formulario__campo">
            <label class="formulario__label" for="accion_solicitada">accion_solicitada</label>
            <select name="accion_solicitada" id="accion_solicitada" class="formulario__input">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="CLASIFICACION">CLASIFICACION</option>
                <option value="REPOSICION">REPOSICION</option>
                <option value="NOTA DE VREDITO">NOTA DE VREDITO</option>
                <option value="DESCUENTO 5%">DESCUENTO 5%</option>
                <option value="DESCUENTO 10%">DESCUENTO 10%</option>
                <option value="DESCUENTO AUTORIZADO">DESCUENTO AUTORIZADO</option>
            
            </select>
        </div>




</fieldset>