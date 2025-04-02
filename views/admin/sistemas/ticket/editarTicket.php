<div class="formulario__campo">
    <label class="formulario__label" for="calificacion">Calificación:</label>
    <select
        name="calificacion"
        id="calificacion"
        class="formulario__input">
        <option value="1" <?php echo (isset($ticket->calificacion) && $ticket->calificacion == '1') ? 'selected' : ''; ?>>Malo</option>
        <option value="2" <?php echo (isset($ticket->calificacion) && $ticket->calificacion == '2') ? 'selected' : ''; ?>>Regular</option>
        <option value="3" <?php echo (isset($ticket->calificacion) && $ticket->calificacion == '3') ? 'selected' : ''; ?>>Bueno</option>
        <option value="4" <?php echo (isset($ticket->calificacion) && $ticket->calificacion == '4') ? 'selected' : ''; ?>>Muy Bueno</option>
        <option value="5" <?php echo (isset($ticket->calificacion) && $ticket->calificacion == '5') ? 'selected' : ''; ?>>Excelente</option>
    </select>
</div>