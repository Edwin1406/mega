<fieldset class="formulario-troquelado__fieldset">
    <legend class="formulario-troquelado__legend">Control Empaqe </legend>

    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="fecha">Fecha </label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            class="formulario-troquelado__input"
            value="<?php echo $control->fecha ?? '' ?>">
    </div>

    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="turnos">Nº Turnos:</label>
        <input
            type="number"
            name="turnos"
            id="turnos"
            class="formulario-troquelado__input"
            placeholder="Nº Turnos"
            value="<?php echo $control->n_turno ?? '' ?>">
    </div>


    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="personal">Personal</label>
        <select
            name="personal"
            id="personal"
            class="formulario-troquelado__input">
            <option value="">Selecciona una opción</option>
            <option value="Luis Govea" <?php echo (isset($control->personal) && $control->personal == 'Luis Govea') ? 'selected' : ''; ?>>Luis Govea</option>
            <option value="Guillermo Bonilla" <?php echo (isset($control->personal) && $control->personal == 'Guillermo Bonilla') ? 'selected' : ''; ?>>Guillermo Bonilla</option>
            <option value="Carlos Govea" <?php echo (isset($control->personal) && $control->personal == 'Carlos Govea') ? 'selected' : ''; ?>>Carlos Govea</option>
        </select>
    </div>

    
    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="producto">Producto</label>
        <select
            name="producto"
            id="producto"
            class="formulario-troquelado__input">
            <option value="">Selecciona una opción</option>
            <option value="Producto 1" <?php echo (isset($control->producto) && $control->producto == 'Producto 1') ? 'selected' : ''; ?>>Producto 1</option>
            <option value="Producto 2" <?php echo (isset($control->producto) && $control->producto == 'Producto 2') ? 'selected' : ''; ?>>Producto 2</option>
            <option value="Producto 3" <?php echo (isset($control->producto) && $control->producto == 'Producto 3') ? 'selected' : ''; ?>>Producto 3</option>
        </select>
    </div>

    <!-- medidas -->
    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="medidas">Medidas</label>
        <input
            type="text"
            name="medidas"
            id="medidas"
            class="formulario-troquelado__input"
            placeholder="Medidas"
            value="<?php echo $control->medidas ?? '' ?>">
    </div>

<!-- hora de inicio -->
    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="hora_inicio">Hora de Inicio</label>
        <input
            type="time"
            name="hora_inicio"
            id="hora_inicio"
            class="formulario-troquelado__input"
            value="<?php echo $control->hora_inicio ?? '' ?>">
    </div>

<!-- hora de fin -->
    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="hora_fin">Hora de Fin</label>
        <input
            type="time"
            name="hora_fin"
            id="hora_fin"
            class="formulario-troquelado__input"
            value="<?php echo $control->hora_fin ?? '' ?>">
    </div>
    <!-- cantidad -->
    <div class="formulario-troquelado__campo">
        <label class="formulario-troquelado__label" for="cantidad">Cantidad</label>
        <input
            type="number"
            name="cantidad"
            id="cantidad"
            class="formulario-troquelado__input"
            placeholder="Cantidad"
            value="<?php echo $control->cantidad ?? '' ?>">
    </div>




</fieldset>


