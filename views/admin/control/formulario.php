<fieldset class="formulario__fieldset2">
    <legend class="formulario__legend2">Control Troquelado </legend>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="fecha">Fecha </label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            class="formulario__input2"
            value="<?php echo $control->fecha ?? '' ?>">
    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="turnos">Nº Turnos:</label>
        <input
            type="number"
            name="turnos"
            id="turnos"
            class="formulario__input2"
            placeholder="Nº Turnos"
            value="<?php echo $control->n_turno ?? '' ?>">
    </div>


    <div class="formulario__campo2">
        <label class="formulario__label2" for="operador">Operadores</label>
        <select
            name="operador"
            id="operador"
            class="formulario__input2">
            <option value="">Selecciona una opción</option>
            <option value="Luis Govea" <?php echo (isset($control->operadores) && $control->operadores == 'Luis Govea') ? 'selected' : ''; ?>>Luis Govea</option>
            <option value="Guillermo Bonilla" <?php echo (isset($control->operadores) && $control->operadores == 'Guillermo Bonilla') ? 'selected' : ''; ?>>Guillermo Bonilla</option>
            <option value="Carlos Govea" <?php echo (isset($control->operadores) && $control->operadores == 'Carlos Govea') ? 'selected' : ''; ?>>Carlos Govea</option>
        </select>
    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="horas_programadas">Horas Programadas</label>
        <input
            type="time"
            name="horas_programadas"
            id="horas_programadas"
            class="formulario__input2"
            value="<?php echo $control->horas_programadas ?? '' ?>">
    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="golpes_maquina">Golpes Máquina</label>
     <input
    type="number"
    step="any"
    name="golpes_maquina"
    id="golpes_maquina"
    class="formulario__input"
    placeholder="Golpes Máquina"
    value="<?php echo $control->golpes_maquina ?? '' ?>">

    </div>

  

    <div class="formulario__campo2">
        <label class="formulario__label2" for="cambios_medida">Nº Cambios de Medida</label>
        <input
            type="number"
            name="cambios_medida"
            id="cambios_medida"
            class="formulario__input"
            placeholder="Nº Cambios de Medida"
            value="<?php echo $control->cambios_medida ?? '' ?>">

    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="cantidad_separadores">Separadores</label>
        <input
            type="number"
            name="cantidad_separadores"
            id="cantidad_separadores"
            class="formulario__input"
            placeholder="Cantidad de Separadores"
            value="<?php echo $control->cantidad_separadores ?? '' ?>">

    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="cantidad_cajas">Cajas</label>
        <input
            type="number"
            name="cantidad_cajas"
            id="cantidad_cajas"
            class="formulario__input"
            placeholder="Cantidad de Cajas"
            value="<?php echo $control->cantidad_cajas ?? '' ?>">
    </div>
    <div class="formulario__campo2">
        <label class="formulario__label2" for="cantidad_papel">Papel</label>
        <input
            type="number"
            name="cantidad_papel"
            id="cantidad_papel"
            class="formulario__input"
            placeholder="Cantidad de Papel"
            value="<?php echo $control->cantidad_papel ?? '' ?>">
    </div>

    <div class="formulario__campo2">
        <label class="formulario__label2" for="desperdicio_kg">Desperdicio (Kg)</label>
        <input
            type="number"
            name="desperdicio_kg"
            id="desperdicio_kg"
            class="formulario__input"
            placeholder="Desperdicio en Kg"
            value="<?php echo $control->desperdicio_kg ?? '' ?>">
    </div>


    



</fieldset>

