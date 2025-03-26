<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de Registro de computadora</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">ID DEL EQUIPO</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del ponente"
            value="<?php echo $maquina->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="num_cuchillas">AREA</label>
        <input
            type="text"
            name="num_cuchillas"
            id="num_cuchillas"
            class="formulario__input"
            placeholder="cuchillas de la maquina"
            value="<?php echo $maquina->num_cuchillas ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ancho_maximo">USUARIO ASIGNADO</label>
        <input
            type="text"
            name="ancho_maximo"
            id="ancho_maximo"
            class="formulario__input"
            placeholder="ancho_maximo de la maquina"
            value="<?php echo $maquina->ancho_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">FECHA COMPRA </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">MARCA O MODELO </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">PROCESADOR </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">RAM </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

   <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">DISCO </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>
   <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_maximo">SISTEMA OPERATIVO  </label>
        <input
            type="text"
            name="gramaje_maximo"
            id="gramaje_maximo"
            class="formulario__input"
            placeholder="gramaje_maximo de la maquina"
            value="<?php echo $maquina->gramaje_maximo ?? '' ?>">
    </div>

    <div class="formulario__campo">
    <label class="formulario__label" for="estado_actual">ESTADO ACTUAL  </label>
    <select name="estado_actual" id="estado_actual" class="formulario__input">
        <option value="Bueno">Bueno</option>
        <option value="Regular">Regular</option>
        <option value="Mal estado">Mal Estado</option>
    </select>
    </div>

 
</fieldset>