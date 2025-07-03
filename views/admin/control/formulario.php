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
    <label class="formulario__label" for="pdf">Subir PDF</label>
    <input
        type="file"
        name="pdf"
        id="pdf"
        class="formulario__input"
        placeholder="Subir PDF del cliente">
</div>

<?php if(isset($cliente->pdf)) :?>
    <div class="formulario__campo">
        <a class="formulario__texto">Archivo Actual:</a>
        <div class="formulario__archivo">
            <a href="<?php echo $_ENV['HOST'] . '/src/visor/' . $cliente->pdf; ?>" target="_blank" class="formulario__enlace">
                Descargar/Ver PDF
            </a>
        </div>
    </div>
<?php endif;?>

</fieldset>

