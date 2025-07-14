<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/crear" class="formulario" enctype="multipart/form-data">

        <div class="formulario__campo">
            <label class="formulario__label" for="turnos">Nº Turnos:</label>
            <input
                type="number"
                name="turnos"
                id="turnos"
                class="formulario__input"
                placeholder="Nº Turnos"
                value="<?php echo $control->n_turno ?? '' ?>">
        </div>


        <div class="formulario__campo">
            <label class="formulario__label" for="operador">Operadores</label>
            <select
                name="operador"
                id="operador"
                class="formulario__input">
                <option value="">Selecciona una opción</option>
                <option value="Luis Govea" <?php echo (isset($control->operadores) && $control->operadores == 'Luis Govea') ? 'selected' : ''; ?>>Luis Govea</option>
                <option value="Guillermo Bonilla" <?php echo (isset($control->operadores) && $control->operadores == 'Guillermo Bonilla') ? 'selected' : ''; ?>>Guillermo Bonilla</option>
            </select>
        </div>
        <br>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">
    </form>

</div>