
<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/sistemas/ticket/editarTicket?id=<?php echo $ticket->id; ?>" class="formulario" enctype="multipart/form-data">
    <div class="formulario__campo">
        <label class="formulario__label" for="estado">Actualizar estado Ticket:</label>
        <select name="estado" id="estado" class="formulario__input">
            <option value="">-- Seleccione --</option>
            <option value="cerrado" <?php echo (isset($ticket->estado) && $ticket->estado == 'cerrado') ? 'selected' : ''; ?>>Cerrado</option>
            <option value="abierto" <?php echo (isset($ticket->estado) && $ticket->estado == 'abierto') ? 'selected' : ''; ?>>Abierto</option>
        </select>
    </div>
    <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Ticket">
</form>


</div>

