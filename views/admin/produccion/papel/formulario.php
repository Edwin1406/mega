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

<script>
    function actualizarCamposPorClasificacion() {
        // Map de clasificación a los campos que deben mostrarse
        const camposPorClasificacion = {
            'a': ['SF', 'LG'],           // OPERATIVO
            'b': ['ERRO', 'HUN'],        // NO OPERATIVO
            'c': ['MDO']                 // ADMINISTRATIVO
        };

        // Ocultar todos los campos primero
        const todosLosCampos = ['SF', 'LG', 'ERRO', 'HUN', 'MDO'];
        todosLosCampos.forEach(id => {
            const campo = document.getElementById(id)?.closest('.formulario__campo');
            if (campo) campo.style.display = 'none';
        });

        // Obtener los checkboxes marcados
        const checkboxes = document.querySelectorAll('input[name="MDO[]"]:checked');
        checkboxes.forEach(chk => {
            const claves = camposPorClasificacion[chk.value];
            if (claves) {
                claves.forEach(id => {
                    const campo = document.getElementById(id)?.closest('.formulario__campo');
                    if (campo) campo.style.display = '';
                });
            }
        });
    }

    // Ejecutar cuando se cambie un checkbox
    document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
        chk.addEventListener('change', actualizarCamposPorClasificacion);
    });

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', actualizarCamposPorClasificacion);
</script>
