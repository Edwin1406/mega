<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>




<style>
    /* Ocultar la barra lateral en dispositivos móviles */
    @media (max-width: 768px) {
        .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
    }


    .dashboard__sidebar{
        border: 1px solid #ccc;
    }



</style>

<!-- visualizar el ticket generado  -->
<div class="dashboard__ticket">
    <div class="dashboard__ticket--info">
        <h2 class="dashboard__ticket--heading">Ticket #<?php echo $ticket->id ?></h2>
        <p class="dashboard__ticket--fecha">Fecha de creación: <?php echo $ticket->fecha_creacion ?></p>
        <p class="dashboard__ticket--estado">Estado: <?php echo $ticket->estado ?></p>
        <p class="dashboard__ticket--prioridad">Prioridad: <?php echo $ticket->prioridad ?></p>
        <p class="dashboard__ticket--categoria">Categoría: <?php echo $ticket->categoria ?></p>
        <p class="dashboard__ticket--calificacion">Calificación: <?php echo $ticket->calificacion ?></p>
    </div>

    <div class="dashboard__ticket--descripcion">
        <h3>Descripción del problema:</h3>
        <p><?php echo $ticket->descripcion ?></p>
    </div>
</div>