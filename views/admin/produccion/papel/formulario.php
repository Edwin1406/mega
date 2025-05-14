<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery y Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>


/* Contenedor principal del select2 */
.select2-container .select2-selection--single {
    height: 42px;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 2rem;
    font-family: inherit;
    background-color: white;
    box-shadow: none;
    transition: border-color 0.2s ease-in-out;
}



</style>

<?php $editando = strpos($_SERVER['REQUEST_URI'], 'editar') !== false; ?>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Papel</legend>
   <!-- TIPO PRINCIPAL -->
<div class="formulario__campo">
  <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
  <select class="formulario__input select2" name="tipo_maquina" id="tipo_maquina">
    <option value="">-- Selecciona un tipo --</option>
    <option value="CORRUGADOR">CORRUGADOR</option>
    <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
  </select>
</div>

<!-- CLASIFICACIÓN -->
<div class="formulario__campo">
  <label class="formulario__label" for="clasificacion">Clasificación</label>
  <select class="formulario__input select2" name="clasificacion" id="clasificacion">
    <option value="">-- Selecciona clasificación --</option>
    <option value="OPERATIVO">OPERATIVO</option>
    <option value="NO OPERATIVO">NO OPERATIVO</option>
  </select>
</div>

<!-- DETALLE -->
<div class="formulario__campo">
  <label class="formulario__label" for="detalle_maquina">Detalle Máquina</label>
  <select class="formulario__input select2" name="detalle_maquina" id="detalle_maquina">
    <option value="">-- Selecciona detalle --</option>
  </select>
</div>

<!-- JS -->
<script>
  const datosMaquina = {
    CORRUGADOR: {
      OPERATIVO: ["GALLETAS TRUCK", "TRUCK", "CLAVES", "1600"],
      "NO OPERATIVO": ["REYMER 120", "REYMER 180"]
    },
    ADMINISTRATIVO: {
      OPERATIVO: ["PAPEL 300"],
      "NO OPERATIVO": ["BOM", "100"]
    }
  };

  $(document).ready(function () {
    // Inicializa select2
    $('#tipo_maquina, #clasificacion, #detalle_maquina').select2({
      placeholder: "-- Selecciona --",
      allowClear: true
    });

    // Al cambiar el tipo
    $('#tipo_maquina').on('change', function () {
      const tipo = $(this).val();
      if (!tipo) return;

      // Si tiene solo una clasificación (como en tu imagen), la selecciona automáticamente
      const clasificaciones = Object.keys(datosMaquina[tipo]);
      if (clasificaciones.length === 1) {
        $('#clasificacion').val(clasificaciones[0]).trigger('change');
      } else {
        $('#clasificacion').val('').trigger('change');
      }

      // Limpiar detalle
      $('#detalle_maquina').html('<option value="">-- Selecciona detalle --</option>').trigger('change');
    });

    // Al cambiar la clasificación
    $('#clasificacion').on('change', function () {
      const tipo = $('#tipo_maquina').val();
      const clasificacion = $(this).val();
      const detalles = (datosMaquina[tipo] && datosMaquina[tipo][clasificacion]) || [];

      // Rellenar detalle
      const opciones = detalles.map(op => `<option value="${op}">${op}</option>`).join('');
      $('#detalle_maquina').html('<option value="">-- Selecciona detalle --</option>' + opciones).trigger('change');
    });
  });
</script>



    <div class="formulario__campo">
        <label class="formulario__label" for="SF">SF</label>
        <input
            type="number"
            name="SF"
            id="SF"
            class="formulario__input"
            placeholder="SF"
            value="<?php echo $papel->SF ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="SF">LG</label>
        <input
            type="number"
            name="LG"
            id="LG"
            class="formulario__input"
            placeholder="LG"
            value="<?php echo $papel->LG ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ERRO">ERRO</label>
        <input
            type="number"
            name="ERRO"
            id="ERRO"
            class="formulario__input"
            placeholder="ERRO"
            value="<?php echo $papel->ERRO ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="HUN">HUN</label>
        <input
            type="number"
            name="HUN"
            id="HUN"
            class="formulario__input"
            placeholder="HUN"
            value="<?php echo $papel->HUN ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="MDO">MDO</label>
        <input
            type="number"
            name="MDO"
            id="MDO"
            class="formulario__input"
            placeholder="MDO"
            value="<?php echo $papel->MDO ?? '' ?>">
    </div>

    <?php if ($editando): ?>
        <div class="formulario__campo">
            <label class="formulario__label" for="consumo_papel">Consumo Papel</label>
            <input
                type="number"
                name="consumo_papel"
                id="consumo_papel"
                class="formulario__input"
                placeholder="Consumo Papel"
                value="<?php echo $papel->consumo_papel ?? '' ?>">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="TOTAL">TOTAL</label>
            <input
                type="number"
                name="TOTAL"
                id="TOTAL"
                class="formulario__input"
                placeholder="TOTAL"
                value="<?php echo $papel->TOTAL ?? '' ?>">
        </div>
    <?php endif; ?>

</fieldset>