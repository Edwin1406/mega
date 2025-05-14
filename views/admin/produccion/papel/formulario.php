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


<div class="formulario__campo campo-dinamico campo-corrug-operativo">
    <label class="formulario__label" for="EMPALME">EMPALME</label>
    <input
        type="text"
        name="EMPALME"
        id="EMPALME"
        class="formulario__input"
        placeholder=" EMPALME" 
        value="<?php echo $materia->EMPALME ?? '' ?>">
</div>


<!-- CORRUGADOR + OPERATIVO -->
<div class="formulario__campo campo-dinamico campo-corrug-operativo">
    <label class="formulario__label" for="EMPALME">EMPALME</label>
    <input type="text" name="EMPALME" id="EMPALME" class="formulario__input" placeholder=" EMPALME" value="<?php echo $materia->EMPALME ?? '' ?>">
</div>

<div class="formulario__campo campo-dinamico campo-corrug-operativo">
    <label class="formulario__label" for="CAMBIO">CAMBIO</label>
    <input type="text" name="CAMBIO" id="CAMBIO" class="formulario__input" placeholder=" CAMBIO" value="<?php echo $materia->CAMBIO ?? '' ?>">
</div>

<div class="formulario__campo campo-dinamico campo-corrug-operativo">
    <label class="formulario__label" for="RECUBRIMIENTO">RECUBRIMIENTO</label>
    <input type="text" name="RECUBRIMIENTO" id="RECUBRIMIENTO" class="formulario__input" placeholder=" RECUBRIMIENTO" value="<?php echo $materia->RECUBRIMIENTO ?? '' ?>">
</div>

<!-- ADMINISTRATIVO + NO OPERATIVO -->
<div class="formulario__campo campo-dinamico campo-admin-nooperativo">
    <label class="formulario__label" for="BOM">BOM</label>
    <input type="text" name="BOM" id="BOM" class="formulario__input" placeholder=" BOM" value="<?php echo $materia->BOM ?? '' ?>">
</div>

<div class="formulario__campo campo-dinamico campo-admin-nooperativo">
    <label class="formulario__label" for="CIEN">100</label>
    <input type="text" name="CIEN" id="CIEN" class="formulario__input" placeholder=" 100" value="<?php echo $materia->CIEN ?? '' ?>">
</div>






<script>
document.addEventListener('DOMContentLoaded', function () {
    const tipoMaquina = document.getElementById('tipo_maquina');
    const clasificacion = document.getElementById('clasificacion');
    
    function actualizarCampos() {
        const tipo = tipoMaquina.value.toLowerCase();
        const claseTipo = tipo === "corrugador" ? "corrug" : tipo === "administrativo" ? "admin" : "";
        const claseClasif = clasificacion.value.toLowerCase().includes("no") ? "nooperativo" : "operativo";

        // Ocultar todos los campos dinámicos
        document.querySelectorAll('.campo-dinamico').forEach(el => el.style.display = 'none');

        // Mostrar los que coinciden con la combinación
        const claseFinal = `.campo-${claseTipo}-${claseClasif}`;
        document.querySelectorAll(claseFinal).forEach(el => el.style.display = 'block');
    }

    tipoMaquina.addEventListener('change', actualizarCampos);
    clasificacion.addEventListener('change', actualizarCampos);

    // Llamada inicial por si ya viene cargado
    actualizarCampos();
});
</script>
