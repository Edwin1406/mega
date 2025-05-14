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
                CONTROLABLE
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="MDO[]" value="b" checked>
                NO CONTROLABLE
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
    <!-- CORRUGADOR  CONTROLABLE -->


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
        <label class="formulario__label" for="EMPALME">EMPALME</label>
        <input
            type="number"
            name="EMPALME"
            id="EMPALME"
            class="formulario__input"
            placeholder="EMPALME"
            value="<?php echo $papel->EMPALME ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="RECUB">RECUB</label>
        <input
            type="number"
            name="RECUB"
            id="RECUB"
            class="formulario__input"
            placeholder="RECUB"
            value="<?php echo $papel->RECUB ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="MECANICO">MECANICO </label>
        <input
            type="number"
            name="MECANICO"
            id="MECANICO"
            class="formulario__input"
            placeholder="MECANICO"
            value="<?php echo $papel->MECANICO ?? '' ?>">
    </div>

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
            placeholder="HUMEDO"
            value="<?php echo $papel->HUMEDO ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="COMBADO">COMBADO</label>
        <input
            type="number"
            name="COMBADO"
            id="COMBADO"
            class="formulario__input"
            placeholder="COMBADO"
            value="<?php echo $papel->COMBADO ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="DESPE">DESPE</label>
        <input
            type="number"
            name="DESPE"
            id="DESPE"
            class="formulario__input"
            placeholder="DESPE"
            value="<?php echo $papel->DESPE ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ERROM">ERROM</label>
        <input
            type="number"
            name="ERROM"
            id="ERROM"
            class="formulario__input"
            placeholder="ERROM"
            value="<?php echo $papel->ERROM ?? '' ?>">
    </div>


    <!-- CORRUGADOR NO CONTROLABLE  -->
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
        <label class="formulario__label" for="CAMBIO_PEDIDO">CAMBIO PEDIDO</label>
        <input
            type="number"
            name="CAMBIO_PEDIDO"
            id="CAMBIO_PEDIDO"
            class="formulario__input"
            placeholder="CAMBIO_PEDIDO"
            value="<?php echo $papel->CAMBIO_PEDIDO ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="FILOS_ROTOS">FILOS ROTOS</label>
        <input
            type="number"
            name="FILOS_ROTOS"
            id="FILOS_ROTOS"
            class="formulario__input"
            placeholder="FILOS_ROTOS"
            value="<?php echo $papel->FILOS_ROTOS ?? '' ?>">
    </div>

    

    <div class="formulario__campo">
        <label class="formulario__label" for="OTROS">OTROS</label>
        <input
            type="number"
            name="OTROS"
            id="OTROS"
            class="formulario__input"
            placeholder="OTROS"
            value="<?php echo $papel->OTROS ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="PEDIDOS_CORTOS">PEDIDOS CORTOS</label>
        <input
            type="number"
            name="PEDIDOS_CORTOS"
            id="PEDIDOS_CORTOS"
            class="formulario__input"
            placeholder="PEDIDOS_CORTOS"
            value="<?php echo $papel->PEDIDOS_CORTOS ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="DIFER_ANCHO">DIFER-ANCHO</label>
        <input
            type="number"
            name="DIFER_ANCHO"
            id="DIFER_ANCHO"
            class="formulario__input"
            placeholder="DIFER_ANCHO"
            value="<?php echo $papel->DIFER_ANCHO ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="CAMBIO_GRAMAJE">CAMBIO GRAMAJE</label>
        <input
            type="number"
            name="CAMBIO_GRAMAJE"
            id="CAMBIO_GRAMAJE"
            class="formulario__input"
            placeholder="CAMBIO_GRAMAJE"
            value="<?php echo $papel->CAMBIO_GRAMAJE ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="EXTRA_TRIM">EXTRA TRIM </label>
        <input
            type="number"
            name="EXTRA_TRIM"
            id="EXTRA_TRIM"
            class="formulario__input"
            placeholder="EXTRA_TRIM"
            value="<?php echo $papel->EXTRA_TRIM ?? '' ?>">
    </div>

<!-- PRE PRINTER   CONTROLABLE  -->

    <div class="formulario__campo">
        <label class="formulario__label" for="HOLA">HOLA</label>
        <input
            type="number"
            name="HOLA"
            id="HOLA"
            class="formulario__input"
            placeholder="HOLA"
            value="<?php echo $papel->HOLA ?? '' ?>">
    </div>

    <!-- PRE PRINTER   NO CONTROLABLE  -->
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
            'a': ['HOLA'], // CONTROLABLE
            'b': ['MDO'],  // NO CONTROLABLE
        },
        'CORRUGADOR': {
            'a': ['SINGLEFACE','EMPALME', 'RECUB', 'MECANICO','GALLET', 'HUMEDO', 'COMBADO', 'DESPE', 'ERROM'],
            'b': ['DESHOJE', 'CAMBIO_PEDIDO', 'FILOS_ROTOS', 'OTROS', 'PEDIDOS_CORTOS', 'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM'],
        }
    };

    const todosLosCampos = [
        'SINGLEFACE', 'EMPALME', 'RECUB', 'MECANICO', 'GALLET', 'HUMEDO', 'COMBADO', 'DESPE', 'ERROM',
        'DESHOJE', 'CAMBIO_PEDIDO', 'FILOS_ROTOS', 'OTROS', 'PEDIDOS_CORTOS', 'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM'
    ];

    function ocultarTodosLosCampos() {
        todosLosCampos.forEach(id => {
            const campo = document.getElementById(id)?.closest('.formulario__campo');
            if (campo) campo.style.display = 'none';
        });
    }

    function resetearCheckboxes() {
        document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
            chk.checked = false;
            chk.disabled = false; // Opcional: puedes desactivar si no hay tipo
        });
    }

    function mostrarCamposSeleccionados() {
        const tipoMaquina = document.getElementById('tipo_maquina').value;
        const clasificaciones = document.querySelectorAll('input[name="MDO[]"]:checked');

        clasificaciones.forEach(chk => {
            const clasificacion = chk.value;
            const campos = camposPorMaquinaYClasificacion[tipoMaquina]?.[clasificacion] || [];
            campos.forEach(id => {
                const campo = document.getElementById(id)?.closest('.formulario__campo');
                if (campo) campo.style.display = '';
            });
        });
    }

    function alCambiarMaquina() {
        ocultarTodosLosCampos();
        resetearCheckboxes();
    }

    function alCambiarClasificacion() {
        ocultarTodosLosCampos();
        mostrarCamposSeleccionados();
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Select2
        $('#tipo_maquina').select2({
            placeholder: "-- Selecciona un tipo --",
            allowClear: true,
        });

        // Cambio de tipo de máquina
        document.getElementById('tipo_maquina').addEventListener('change', alCambiarMaquina);

        // Cambio de clasificación
        document.querySelectorAll('input[name="MDO[]"]').forEach(chk => {
            chk.addEventListener('change', alCambiarClasificacion);
        });

        // Estado inicial
        ocultarTodosLosCampos();
    });
</script>

