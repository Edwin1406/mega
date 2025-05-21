<!-- Estilos para dos columnas -->
<style>
  .formulario__grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
  }

  .formulario__campo {
      display: flex;
      flex-direction: column;
  }

  .formulario__input{
        padding: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
  }

  @media (max-width: 768px) {
      .formulario__grid {
          grid-template-columns: 1fr;
      }
  }
</style>

<!-- jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Formulario -->
<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">RECLAMOS Y QUEJAS</legend>

  <div class="formulario__grid">
    <!-- RESPONSABLE -->
    <div class="formulario__campo">
      <label class="formulario__label" for="responsable_reporte">RESPONSABLE DEL REPORTE</label>
      <input type="text" name="responsable_reporte" id="responsable_reporte" class="formulario__input" placeholder="responsable_reporte" value="<?= htmlspecialchars($_POST['responsable_reporte'] ?? '') ?>">
    </div>

    <!-- CLIENTE -->
    <div class="formulario__campo">
      <label class="formulario__label" for="cliente">CLIENTE</label>
      <select id="selectCliente" name="cliente" onchange="this.form.submit()" class="formulario__input">
        <option value="">-- Seleccione --</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente->cliente ?>" <?= $cliente->cliente === $clienteSeleccionado ? 'selected' : '' ?>>
            <?= $cliente->cliente ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- NRO FACTURA -->
    <div class="formulario__campo">
      <label class="formulario__label" for="factura">NRO.Factura</label>
      <select id="selectFactura" name="factura" class="formulario__input" onchange="this.form.submit()">
        <option value="">-- Seleccione factura --</option>
        <?php foreach ($facturas as $factura): ?>
          <option value="<?= $factura ?>" <?= $factura === $facturaSeleccionada ? 'selected' : '' ?>>
            <?= $factura ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- FECHA FACTURA -->
    <div class="formulario__campo">
      <label class="formulario__label" for="fecha_factura">Fecha Factura</label>
      <input type="text" name="fecha_factura" id="fecha_factura" class="formulario__input" placeholder="Nombre de la fecha_factura" value="<?= htmlspecialchars($fecha_factura ?? '') ?>" readonly>
    </div>

    <!-- DESCRIPCION DEL PRODUCTO -->
    <div class="formulario__campo" style="grid-column: 1 / -1;">
      <label class="formulario__label">DESCRIPCIÓN DEL PRODUCTO</label>
      <?php foreach ($descripciones as $desc): ?>
        <div>
          <input type="checkbox" name="descripcion_producto[]" value="<?= htmlspecialchars($desc) ?>" <?= (isset($descripcionSeleccionada) && in_array($desc, (array)$descripcionSeleccionada)) ? 'checked' : '' ?> id="<?= md5($desc) ?>">
          <label for="<?= md5($desc) ?>"><?= $desc ?></label>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- PERSONA QUE REPORTA -->
    <div class="formulario__campo">
      <label class="formulario__label" for="per_reporta_reclamo">PERSONA QUE REPORTA EL RECLAMO</label>
      <input type="text" name="per_reporta_reclamo" id="per_reporta_reclamo" class="formulario__input" placeholder="Nombre del per_reporta_reclamo" value="<?= htmlspecialchars($_POST['per_reporta_reclamo'] ?? '') ?>">
    </div>

    <!-- MOTIVO -->
    <div class="formulario__campo">
      <label class="formulario__label" for="motivo_reclamo">MOTIVO DEL RECLAMO</label>
      <select name="motivo_reclamo" id="motivo_reclamo" class="formulario__input">
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="IMPRESIÓN">IMPRESIÓN</option>
        <option value="CALIDAD DE PAPEL">CALIDAD DE PAPEL</option>
        <option value="PEGADO">PEGADO</option>
        <option value="EMPAQUE">EMPAQUE</option>
      </select>
    </div>

    <!-- ACCIÓN -->
    <div class="formulario__campo">
      <label class="formulario__label" for="accion_solicitada">ACCIÓN SOLICITADA</label>
      <select name="accion_solicitada" id="accion_solicitada" class="formulario__input">
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="CLASIFICACION">CLASIFICACION</option>
        <option value="REPOSICION">REPOSICION</option>
        <option value="NOTA DE CREDITO">NOTA DE CREDITO</option>
        <option value="DESCUENTO 5%">DESCUENTO 5%</option>
        <option value="DESCUENTO 10%">DESCUENTO 10%</option>
        <option value="DESCUENTO AUTORIZADO">DESCUENTO AUTORIZADO</option>
      </select>
    </div>


  </div>
</fieldset>

<!-- Activar Select2 -->
<script>
  $(document).ready(function () {
    $('#selectCliente, #selectFactura').select2({
      placeholder: "-- Seleccione --",
      allowClear: true
    });

    document.querySelectorAll('input[name="descripcion_producto[]"]').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        this.form.submit();
      });
    });
  });
</script>
