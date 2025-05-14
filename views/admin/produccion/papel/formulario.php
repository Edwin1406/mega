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
   <!-- Select principal -->
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

<!-- Segundo select dinámico -->
<div class="formulario__campo">
    <label class="formulario__label" for="opciones_subtipo">Subtipo</label>
    <select class="formulario__input select2" name="opciones_subtipo" id="opciones_subtipo">
        <option value="">-- Selecciona una opción --</option>
    </select>
</div>

<!-- Script para manejar las opciones dinámicas -->
<script>
    const opcionesPorTipo = {
        CORRUGADOR: ["PAPEL", "TRIM"],
        MICRO: ["MICRO1", "MICRO2"],
        PREPRINTER: ["TINTA", "PLACA"],
        KL: ["LINEA1", "LINEA2"],
        RESMAS: ["A4", "OFICIO", "CARTA"],
        DOBLADORA: ["MODO 1", "MODO 2"]
    };

    $(document).ready(function () {
        $('#tipo_maquina').select2({
            placeholder: "-- Selecciona un tipo --",
            allowClear: true
        });

        $('#opciones_subtipo').select2({
            placeholder: "-- Selecciona una opción --",
            allowClear: true
        });

        $('#tipo_maquina').on('change', function () {
            const seleccionado = $(this).val();
            const opciones = opcionesPorTipo[seleccionado] || [];

            // Reinicializar select2 con nuevas opciones
            const nuevoData = opciones.map(op => ({ id: op, text: op }));
            $('#opciones_subtipo').empty().select2({
                data: nuevoData,
                placeholder: "-- Selecciona una opción --",
                allowClear: true
            });
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