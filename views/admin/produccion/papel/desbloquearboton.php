<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>


<style>
    .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
</style>
<!-- VER TABLA -->
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/tablaconsumo">
        <i class="fa-regular fa-eye"></i>
        VER TABLA DE CONSUMO GENERAL
    </a>
</div>

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
                <option value="OTRO" <?php echo (isset($consumo->tipo_maquina) && $consumo->tipo_maquina == 'OTRO') ? 'selected' : ''; ?>>OTRO</option>

            </select>

            <div class="formulario__campo">
                <label class="formulario__label" for="accion">Accion:</label>
                <input
                    type="number"
                    name="accion"
                    id="accion"
                    class="formulario__input"
                    placeholder="accion"
                    value="<?php echo $consumo->accion ?? '' ?>">
            </div>
        </div>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Editar Consumo General">
    </form>
</div>