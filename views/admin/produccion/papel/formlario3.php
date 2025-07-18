<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingreso de la información para estadistica de las graficas </legend>
      <div class="formulario__campo">
            <label class="formulario__label" for="tipo_maquina">Tipo Maquina</label>
            <select
                name="tipo_maquina"
                id="tipo_maquina"
                class="formulario__input">
                <option value="">Selecciona una opción</option>
                <option value="CORRUGADOR" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'CORRUGADOR') ? 'selected' : ''; ?>>CORRUGADOR</option>
                <option value="MICRO" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'MICRO') ? 'selected' : ''; ?>>MICRO</option>
                <option value="TROQUEL" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
                <option value="FLEXOGRAFICA" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'FLEXOGRAFICA') ? 'selected' : ''; ?>>FLEXOGRAFICA</option>
                <option value="PRE-PRINTER" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'PRE-PRINTER') ? 'selected' : ''; ?>>PRE-PRINTER</option>
                <option value="DOBLADO" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'DOBLADO') ? 'selected' : ''; ?>>DOBLADO</option>
                <option value="CORTE CEJA" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'CORTE CEJA') ? 'selected' : ''; ?>>CORTE CEJA</option>
                <option value="TROQUEL" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'TROQUEL') ? 'selected' : ''; ?>>TROQUEL</option>
                <option value="CONVERTIDOR" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'CONVERTIDOR') ? 'selected' : ''; ?>>CONVERTIDOR</option>
                <option value="GUILLOTINA LAMINA" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'GUILLOTINA LAMINA') ? 'selected' : ''; ?>>GUILLOTINA LAMINA</option>
                <option value="GUILLOTINA PAPEL" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'GUILLOTINA PAPEL') ? 'selected' : ''; ?>>GUILLOTINA PAPEL</option>
                <option value="EMPAQUE" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'EMPAQUE') ? 'selected' : ''; ?>>EMPAQUE</option>
                <option value="BODEGA" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'BODEGA') ? 'selected' : ''; ?>>BODEGA</option>

            </select>
        </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="total_general">Proyecto</label>
        <input
            type="number"
            name="total_general"
            id="total_general"
            class="formulario__input"
            placeholder="Número de Proyecto"
            value="<?php echo $pedido->total_general ?? '' ?>">
    </div>

</fieldset>