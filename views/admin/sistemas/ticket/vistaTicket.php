<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>




<style>
    /* Ocultar la barra lateral en dispositivos móviles */
    @media (max-width: 768px) {
        .dashboard__sidebar {
            /* Suponiendo que el contenedor tiene la clase .barra-lateral */
            display: none;
        }
    }


    .dashboard__ticket {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 2rem;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;

        width: 100%;

    }


    .dashboard__ticket--info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;

    }


    .dashboard__ticket--heading {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
    }

    h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
</style>

<!-- visualizar el ticket generado  -->
<div class="dashboard__ticket">
    <div class="dashboard__ticket--info">
        <h2 class="dashboard__ticket--heading">Ticket #<?php echo $ticket->id ?></h2>
        <p class="dashboard__ticket--fecha"><b>Fecha de creación:</b> <?php echo $ticket->fecha_creacion ?></p>
        <p class="dashboard__ticket--estado"
        style="color: <?php echo $ticket->estado == 'abierto' ? 'green' : 'red'; ?>;">
        <b>Estado:</b> <?php echo $ticket->estado; ?>
        </p>

        <p class="dashboard__ticket--prioridad"><b>Prioridad: </b><?php echo $ticket->prioridad ?></p>
        <p class="dashboard__ticket--categoria"><b>Categoría: </b><?php echo $ticket->categoria ?></p>
        <p class="dashboard__ticket--calificacion"><b>Calificación:</b> <?php echo $ticket->calificacion ?></p>
    </div>

    <div class="dashboard__ticket--descripcion">
        <h3>Descripción del problema:</h3>
        <p><?php echo $ticket->descripcion ?></p>
    </div>
</div>