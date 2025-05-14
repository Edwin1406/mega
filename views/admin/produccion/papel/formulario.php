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
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
        <select class="formulario__input select2" name="tipo_maquina" id="tipo_maquina">
            <option value="">-- Selecciona un tipo --</option>
            <option value="PREPRINTER" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'preprinter' ? 'selected' : '' ?>>PRE-PRINTER</option>
            <option value="CORRUGADOR" <?= trim(strtolower($papel->tipo_maquina ?? '')) == 'corrugador' ? 'selected' : '' ?>>CORRUGADOR</option>
        </select>
    </div>



<div class="formulario__campo">
    <label class="formulario__label">CLASIFICACION</label>

    <div>
        <label>
            <input type="checkbox" name="MDO[]" value="a">
            OPERATIVO
        </label>
    </div>
    <div>
        <label>
            <input type="checkbox" name="MDO[]" value="b" checked>
            NO OPERATIVO
        </label>
    </div>
    <div>
        <label>
            <input type="checkbox" name="MDO[]" value="c" checked>
            ADMINISTRATIVO
        </label>
    </div>
</div>



    <script>
        $(document).ready(function() {
            $('#tipo_maquina').select2({
                placeholder: "-- Selecciona un tipo --",
                allowClear: true,
            });
        });
    </script>


    <div class="formulario__campo">
        <label class="formulario__label" for="GALLET">GALLET</label>
        <input
            type="number"
            name="GALLET"
            id="GALLET"
            class="formulario__input"
            placeholder="GALLET"
            value="<?php echo $papel->GALLET ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="HUMEDO">HUMEDO</label>
        <input
            type="number"
            name="HUMEDO"
            id="HUMEDO"
            class="formulario__input"
            placeholder="LG"
            value="<?php echo $papel->HUMEDO ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="DESHOJE">DESHOJE</label>
        <input
            type="number"
            name="DESHOJE"
            id="DESHOJE"
            class="formulario__input"
            placeholder="DESHOJE"
            value="<?php echo $papel->DESHOJE ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="SINGLEFACE">SINGLE FACE</label>
        <input
            type="number"
            name="SINGLEFACE"
            id="SINGLEFACE"
            class="formulario__input"
            placeholder="SINGLEFACE"
            value="<?php echo $papel->SINGLEFACE ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="EXTRATRIM">EXTRA TRIM</label>
        <input
            type="number"
            name="EXTRATRIM"
            id="EXTRATRIM"
            class="formulario__input"
            placeholder="EXTRATRIM"
            value="<?php echo $papel->EXTRATRIM ?? '' ?>">
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

    




</fieldset>
<script>
  const camposPorMaquinaYClasificacion = {
    'PREPRINTER': {
      'a': ['SF', 'LG'],            // OPERATIVO
      'b': ['ERRO', 'HUN'],         // NO OPERATIVO
      'c': ['MDO']                  // ADMINISTRATIVO
    },
    'CORRUGADOR': {
      'a': ['GALLET'],             // OPERATIVO
      'b': ['HUMEDO', 'DESHOJE'],  // NO OPERATIVO
      'c': ['SINGLEFACE', 'EXTRATRIM'] // ADMINISTRATIVO
    }
  };

  function actualizarVisibilidadCampos() {
    const tipoMaquina = document.getElementById('tipo_maquina').value;
    const clasificaciones = document.querySelectorAll('input[name="MDO[]"]:checked');

    // Ocultar todos los inputs conocidos
    const todosLosCampos = [
      'SF', 'LG', 'ERRO', 'HUN', 'MDO',
      'GALLET', 'HUMEDO', 'DESHOJE', 'SINGLEFACE', 'EXTRATRIM'
    ];

    todosLosCampos.forEach(id => {
      const campo = document.getElementById(id)?.closest('.formulario__campo');
      if (campo) campo.style.display = 'none';
    });

    // Mostrar según tipo y clasificación
    clasificaciones.forEach(chk => {
      const clasificacion = chk.value; // 'a', 'b', 'c'
      const campos = camposPorMaquinaYClasificacion[tipoMaquina]?.[clasificacion] || [];
      campos.forEach(id => {
        const campo = document.getElementById(id)?.closest('.formulario__campo');
        if (campo) campo.style.display = '';
      });
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('tipo_maquina').addEventListener('change', actualizarVisibilidadCampos);
    document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
      chk.addEventListener('change', actualizarVisibilidadCampos);
    });
    actualizarVisibilidadCampos();
  });
</script>
