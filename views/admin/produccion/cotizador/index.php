<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/index" >
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Cotizador</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="tipo_papel">Tipo</label>
        <input
            type="text"
            name="tipo_papel"
            id="tipo_papel"
            class="formulario__input"
            placeholder="Tipo de papel"
            value="<?php echo $papel->tipo_papel ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje">Gramaje</label>
        <input
            type="text"
            name="gramaje"
            id="gramaje"
            class="formulario__input"
            placeholder="Gramaje del papel"
            value="<?php echo $papel->gramaje ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="text"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="ancho del papel"
            value="<?php echo $papel->ancho ?? '' ?>">
    </div>


</fieldset>