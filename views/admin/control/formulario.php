<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Control Troquelado </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha">Fecha </label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            class="formulario__input"
            value="<?php echo $cliente->fecha ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="n_turno">Nº Turnos:</label>
        <input
            type="number"
            name="n_turno"
            id="n_turno"
            class="formulario__input"
            placeholder="Nº Turnos"
            value="<?php echo $cliente->n_turno ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="operadores">Operadores</label>
        <select
            name="operadores"
            id="operadores"
            class="formulario__input">
            <option value="">Selecciona una opción</option>
            <option value="Luis Govea" <?php echo (isset($cliente->operadores) && $cliente->operadores == 'Luis Govea') ? 'selected' : ''; ?>>Luis Govea</option>
            <option value="Guillermo Bonilla" <?php echo (isset($cliente->operadores) && $cliente->operadores == 'Guillermo Bonilla') ? 'selected' : ''; ?>>Guillermo Bonilla</option>
            <option value="Carlos Govea" <?php echo (isset($cliente->operadores) && $cliente->operadores == 'Carlos Govea') ? 'selected' : ''; ?>>Carlos Govea</option>
        </select>
    </div>

    
    <div class="formulario__campo">
        <label class="formulario__label" for="estado">Estado</label>
        <select
            name="estado"
            id="estado"
            class="formulario__input">
            <option value="">Selecciona una opción</option>
            <option value="ENVIADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'ENVIADO') ? 'selected' : ''; ?>>ENVIADO</option>
            <option value="PAUSADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'PAUSADO') ? 'selected' : ''; ?>>PAUSADO</option>
            <option value="TERMINADO" <?php echo (isset($cliente->estado) && $cliente->estado == 'TERMINADO') ? 'selected' : ''; ?>>TERMINADO</option>
        </select>

    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="horas_programadas">Horas Programadas</label>
        <input
            type="time"
            name="horas_programadas"
            id="horas_programadas"
            class="formulario__input"
            value="<?php echo $cliente->horas_programadas ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="golpes_maquina">Golpes Máquina</label>
        <input
            type="number"
            name="golpes_maquina"
            id="golpes_maquina"
            class="formulario__input"
            placeholder="Golpes Máquina"
            value="<?php echo $cliente->golpes_maquina ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="golpes_maquina_hora">Golpes Máquina/Hora</label>
        <input
            type="number"
            name="golpes_maquina_hora"
            id="golpes_maquina_hora"
            class="formulario__input"
            placeholder="Golpes Máquina/Hora"
            value="<?php echo $cliente->golpes_maquina_hora ?? '' ?>">

    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cambios_medida">Nº Cambios de Medida</label>
        <input
            type="number"
            name="cambios_medida"
            id="cambios_medida"
            class="formulario__input"
            placeholder="Nº Cambios de Medida"
            value="<?php echo $cliente->cambios_medida ?? '' ?>">

    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad_separadores">Separadores</label>
        <input
            type="number"
            name="cantidad_separadores"
            id="cantidad_separadores"
            class="formulario__input"
            placeholder="Cantidad de Separadores"
            value="<?php echo $cliente->cantidad_separadores ?? '' ?>">

    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad_cajas">Cajas</label>
        <input
            type="number"
            name="cantidad_cajas"
            id="cantidad_cajas"
            class="formulario__input"
            placeholder="Cantidad de Cajas"
            value="<?php echo $cliente->cantidad_cajas ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad_papel">Papel</label>
        <input
            type="number"
            name="cantidad_papel"
            id="cantidad_papel"
            class="formulario__input"
            placeholder="Cantidad de Papel"
            value="<?php echo $cliente->cantidad_papel ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="desperdicio_kg">Desperdicio (Kg)</label>
        <input
            type="number"
            name="desperdicio_kg"
            id="desperdicio_kg"
            class="formulario__input"
            placeholder="Desperdicio en Kg"
            value="<?php echo $cliente->desperdicio_kg ?? '' ?>">
    </div>

    
    



</fieldset>

