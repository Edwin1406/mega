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
<!-- SELECT TIPO MAQUINA -->
<div class="formulario__campo">
  <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
  <select class="formulario__input select2" name="tipo_maquina" id="tipo_maquina">
    <option value="">-- Selecciona un tipo --</option>
    <option value="CORRUGADOR">CORRUGADOR</option>
    <option value="MICRO">MICRO</option>
    <option value="PREPRINTER">PREPRINTER</option>
    <option value="KL">KL</option>
    <option value="RESMAS">RESMAS</option>
    <option value="DOBLADORA">DOBLADORA</option>
  </select>
</div>

<!-- SELECT CLASIFICACIÓN EDITABLE -->
<div class="formulario__campo">
  <label class="formulario__label" for="clasificacion">Clasificación</label>
  <select class="formulario__input select2" name="clasificacion" id="clasificacion">
    <option value="">-- Selecciona clasificación --</option>
    <option value="OPERATIVO">OPERATIVO</option>
    <option value="NO OPERATIVO">NO OPERATIVO</option>
  </select>
</div>

<!-- SCRIPT -->
<script>
  const datosMaquina = {
    CORRUGADOR: "OPERATIVO",
    MICRO: "OPERATIVO",
    PREPRINTER: "OPERATIVO",
    KL: "NO OPERATIVO",
    RESMAS: "NO OPERATIVO",
    DOBLADORA: "NO OPERATIVO"
  };

  $(document).ready(function () {
    $('#tipo_maquina, #clasificacion').select2({
      placeholder: "-- Selecciona --",
      allowClear: true
    });

    $('#tipo_maquina').on('change', function () {
      const seleccionado = $(this).val();
      const clasificacion = datosMaquina[seleccionado] || "";

      // Seleccionar automáticamente la clasificación correspondiente
      $('#clasificacion').val(clasificacion).trigger('change');
    });
  });
</script>
