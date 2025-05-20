<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">RELCAMOS Y QUEJAS </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="responsable_reporte">RESPONDABLE DEL REPORTE</label>
        <input
            type="text"
            name="responsable_reporte"
            id="responsable_reporte"
            class="formulario__input"
            placeholder="responsable_reporte"
            value="<?php echo $comercial->responsable_reporte ?? '' ?>">
    </div>
    <?php         $responsable_reporte = $_POST['responsable_reporte'] ?? '';
?>
   

    <div class="formulario__campo">
        <label class="formulario__label" for="cliente">CLIENTE</label>

        <select name="cliente" onchange="this.form.submit()" class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente->cliente ?>"
                    <?= $cliente->cliente === $clienteSeleccionado ? 'selected' : '' ?>>
                    <?= $cliente->cliente ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="factura">NRO.Factura</label>
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
        <label class="formulario__label">DESCRICPION DEL PRODUCTO</label>
        <?php foreach ($descripciones as $desc): ?>
            <div>
                <input
                    type="checkbox"
                    name="descripcion_producto[]"
                    value="<?= htmlspecialchars($desc) ?>"
                    <?= (isset($descripcionSeleccionada) && in_array($desc, (array)$descripcionSeleccionada)) ? 'checked' : '' ?>
                    id="<?= md5($desc) ?>">
                <label for="<?= md5($desc) ?>"><?= $desc ?></label>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_factura">Fecha Factura</label>
        <input
            type="text"
            name="fecha_factura"
            id="fecha_factura"
            class="formulario__input"
            placeholder="Nombre de la fecha_factura"
            value="<?= htmlspecialchars($fecha_factura ?? '') ?>"
            readonly>
    </div>

    <script>
        document.querySelectorAll('input[name="descripcion_producto[]"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>




    <div class="formulario__campo">
        <label class="formulario__label" for="per_reporta_reclamo">PERSONA QUE REPORTA EL RECLAMO</label>
        <input
            type="text"
            name="per_reporta_reclamo"
            id="per_reporta_reclamo"
            class="formulario__input"
            placeholder="Nombre del per_reporta_reclamo"
            value="<?php echo $comercial->per_reporta_reclamo ?? '' ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="motivo_reclamo">MOTIVO DEL RECLAMO</label>
        <select name="motivo_reclamo" id="motivo_reclamo" class="formulario__input">
            <option value="" disabled selected>-- Seleccione --</option>
            <option value="impresion">impresion</option>
            <option value="calidad papel">Calidad papel</option>
            <option value="pegado">Pegado</option>
            <option value="empaque">empaque</option>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="accion_solicitada">ACCION SOLICITADA</label>
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