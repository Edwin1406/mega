<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>


    <form method="POST" action="/admin/produccion/papel/consumo_general" class="formulario" enctype="multipart/form-data">

        
        <div class="formulario__campo">
            <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
            <select
            name="tipo_maquina"
            id="tipo_maquina"
            class="formulario__input">
            <option value="">Selecciona una opción</option>
            <option value="CORRUGADOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CORRUGADOR') ? 'selected' : ''; ?>>CORRUGADOR</option>
            <option value="MICRO" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'MICRO') ? 'selected' : ''; ?>>MICRO</option>
            <option value="TROQUELADOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'TROQUELADOR') ? 'selected' : ''; ?>>TROQUELADOR</option>
            <option value="FLEXOGRAFICA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'FLEXOGRAFICA') ? 'selected' : ''; ?>>FLEXOGRAFICA</option>
            <option value="PRE PRINTER " <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'PRE PRINTER ') ? 'selected' : ''; ?>>PRE PRINTER </option>
            <option value="DOBLADO" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'DOBLADO') ? 'selected' : ''; ?>>DOBLADO</option>
            <option value="CORTE CEJA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CORTE CEJA') ? 'selected' : ''; ?>>CORTE CEJA</option>
            <option value="TROQUEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
            <option value="CONVERTIDOR" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'CONVERTIDOR') ? 'selected' : ''; ?>>CONVERTIDOR</option>
            <option value="GUILLOTINA LAMINA" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA LAMINA') ? 'selected' : ''; ?>>GUILLOTINA LAMINA</option>
            <option value="GUILLOTINA PAPEL" <?php echo (isset($control->tipo_maquina) && $control->tipo_maquina == 'GUILLOTINA PAPEL') ? 'selected' : ''; ?>>GUILLOTINA PAPEL</option>
         
        </select>
        
        <div class="formulario__campo">
            <label class="formulario__label" for="total_general">Total General:</label>
            <input
                type="number"
                name="total_general"
                id="total_general"
                class="formulario__input"
                placeholder="total_general"
                value="<?php echo $control->total_general ?? '' ?>">
        </div>

        </div>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Papel">
    </form>

</div>