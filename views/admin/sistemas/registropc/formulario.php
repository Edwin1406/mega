<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de Registro de computadora</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="numero_interno">ID DEL EQUIPO</label>
        <input
            type="text"
            name="numero_interno"
            id="numero_interno"
            class="formulario__input"
            placeholder="numero interno"
            value="<?php echo $maquina->numero_interno ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="area">AREA</label>
        <input
            type="text"
            name="area"
            id="area"
            class="formulario__input"
            placeholder="area"
            value="<?php echo $maquina->area ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="usuario_asignado">USUARIO ASIGNADO</label>
        <input
            type="text"
            name="usuario_asignado"
            id="usuario_asignado"
            class="formulario__input"
            placeholder="usuario_asignado"
            value="<?php echo $maquina->usuario_asignado ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_compra">FECHA COMPRA </label>
        <input
            type="date"
            name="fecha_compra"
            id="fecha_compra"
            class="formulario__input"
            placeholder="fecha_compra"
            value="<?php echo $maquina->fecha_compra ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="marca_modelo">MARCA O MODELO </label>
        <input
            type="text"
            name="marca_modelo"
            id="marca_modelo"
            class="formulario__input"
            placeholder="marca_modelo"
            value="<?php echo $maquina->marca_modelo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="procesador">PROCESADOR </label>
        <input
            type="text"
            name="procesador"
            id="procesador"
            class="formulario__input"
            placeholder="procesador"
            value="<?php echo $maquina->procesador ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ram">RAM </label>
        <input
            type="text"
            name="ram"
            id="ram"
            class="formulario__input"
            placeholder="ram"
            value="<?php echo $maquina->ram ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="disco_duro">DISCO </label>
        <input
            type="text"
            name="disco_duro"
            id="disco_duro"
            class="formulario__input"
            placeholder="disco_duro"
            value="<?php echo $maquina->disco_duro ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="sistema_operativo">SISTEMA OPERATIVO </label>
        <input
            type="text"
            name="sistema_operativo"
            id="sistema_operativo"
            class="formulario__input"
            placeholder="sistema_operativo"
            value="<?php echo $maquina->sistema_operativo ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="estado_actual">ESTADO ACTUAL </label>
        <select name="estado_actual" id="estado_actual" class="formulario__input">
            <option value="Nuevo">Nuevo</option>
            <option value="Bueno">Bueno</option>
            <option value="Regular">Regular</option>
            <option value="Mal estado">Mal Estado</option>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="direccion_ip">DIRECCION IP </label>
        <input
            type="text"
            name="direccion_ip"
            id="direccion_ip"
            class="formulario__input"
            placeholder="direccion ip"
            value="">
    </div>



   <div class="formulario__campo">
        <label class="formulario__label" for="contrasena">contraseña</label>
        <input
            type="text"
            name="contrasena"
            id="contrasena"
            class="formulario__input"
            placeholder="contrasena"
            value="">
    </div>
</fieldset>