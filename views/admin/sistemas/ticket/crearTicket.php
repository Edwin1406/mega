<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>

<div class="dashboard__formulario">

    <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/sistemas/productos/crear " class="formulario" enctype="multipart/form-data">


        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">INGRESO DE INSUMOS DE SISTEMAS </legend>



            <!-- crear un select  -->
            <div class="formulario__campo">
                <label class="formulario__label" for="usuario_asignado">Seleccione el Usuario asignado</label>
                <select
                    name="usuario_asignado"
                    id="usuario_asignado"
                    class="formulario__input">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($computadoras as $computadora) : ?>
                        <option
                            <?php echo $computadora->id === $computadora->id ? 'selected' : '' ?>
                            value="<?php echo $computadora->id ?>"><?php echo $computadora->usuario_asignado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label class="formulario__label" for="asunto">Asunto:</label>
                <input
                    type="text"
                    name="asunto"
                    id="asunto"
                    class="formulario__input"
                    placeholder="Nombre del Producto"
                    value="<?php echo $ticket->asunto ?? '' ?>">
            </div>



            <div class="formulario__campo">
                <label class="formulario__label" for="descripcion">Descripcion:</label>
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
                    <option value="no_urgente" <?php echo (isset($ticket->prioridad) && $ticket->prioridad == 'no_urgente') ? 'selected' : ''; ?>>No urgente</option>
                </select>
            </div>

            <div class="formulario__campo">
                <label class="formulario__label" for="estado">Estado:</label>
                <select
                    name="estado"
                    id="estado"
                    class="formulario__input">
                    <option value="abierto" <?php echo (isset($ticket->estado) && $ticket->estado == 'abierto') ? 'selected' : ''; ?>>Abierto</option>
                    <option value="cerrado" <?php echo (isset($ticket->estado) && $ticket->estado == 'cerrado') ? 'selected' : ''; ?>>Cerrado</option>
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


            <!-- comentario  -->

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













        </fieldset>












        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar producto">


    </form>

</div>