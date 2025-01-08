<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la Maquina</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del ponente"
            value="<?php echo $maquina->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="num_cuchillas">numero cuchillas</label>
        <input
            type="text"
            name="num_cuchillas"
            id="num_cuchillas"
            class="formulario__input"
            placeholder="cuchillas de la maquina"
            value="<?php echo $maquina->num_cuchillas ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ancho_maximo">Ancho maximo</label>
        <input
            type="text"
            name="ancho_maximo"
            id="ancho_maximo"
            class="formulario__input"
            placeholder="ancho_maximo de la maquina"
            value="<?php echo $maquina->ancho_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">gramaje_maximo</label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

</fieldset>