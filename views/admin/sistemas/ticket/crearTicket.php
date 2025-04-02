<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>



<style>
    /* Ocultar la barra lateral en dispositivos móviles */
    @media (max-width: 768px) {
        .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
    }
</style>

<!-- Agregar CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Agregar jQuery (requerido para Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Agregar JS de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {
        $('#computadora_id').select2();
    });
</script>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/sistemas/ticket/crearTicket" class="formulario" enctype="multipart/form-data">


        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend"> Generar Ticket</legend>



            <!-- crear un select  -->
            <div class="formulario__campo">
                <label class="formulario__label" for="computadora_id">Seleccione el Usuario asignado</label>
                <select
                    name="computadora_id"
                    id="computadora_id"
                    class="formulario__input">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($computadoras as $computadora) : ?>
                        <option
                            <?php echo $computadora->id === $computadora->id ? 'selected' : '' ?>
                            value="<?php echo $computadora->id?>"><?php echo $computadora->usuario_asignado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label class="formulario__label" for="descripcion">Descripcion del Problema:</label>
                <input
                    type="text"
                    name="descripcion"
                    id="descripcion"
                    class="formulario__input"
                    placeholder="Descripcion del Producto"
                    value="<?php echo $ticket->descripcion ?? '' ?>">
            </div>

            <div class="formulario__campo">
                <label class="formulario__label" for="prioridad">Prioridad:</label>
                <select
                    name="prioridad"
                    id="prioridad"
                    class="formulario__input">
                    <option value="urgente" <?php echo (isset($ticket->prioridad) && $ticket->prioridad == 'urgente') ? 'selected' : ''; ?>>Urgente</option>
                    <option value="no urgente" <?php echo (isset($ticket->prioridad) && $ticket->prioridad == 'no_urgente') ? 'selected' : ''; ?>>No urgente</option>
                </select>
            </div>


            <div class="formulario__campo">
                <label class="formulario__label" for="categoria">Categoría:</label>
                <select
                    name="categoria"
                    id="categoria"
                    class="formulario__input">
                    <option value="soporte" <?php echo (isset($ticket->categoria) && $ticket->categoria == 'soporte') ? 'selected' : ''; ?>>Soporte</option>
                    <option value="mantenimiento" <?php echo (isset($ticket->categoria) && $ticket->categoria == 'mantenimiento') ? 'selected' : ''; ?>>Mantenimiento</option>
                    <option value="consulta" <?php echo (isset($ticket->categoria) && $ticket->categoria == 'consulta') ? 'selected' : ''; ?>>Consulta</option>
                </select>
            </div>




        </fieldset>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Generar Ticket">


    </form>

</div>