<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda -->
<div class="dashboard__contenedor"
    style="
        margin-bottom: 15px; 
        padding: 20px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
        transition: all 0.3s ease-in-out;
    ">
    <input
        type="text"
        id="filtros_ventas"
        class="dashboard__input"
        placeholder="Filtrar por nombre cliente o nombre producto"
        style="
            margin-bottom: 0; 
            padding: 12px 15px; 
            width: 100%; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            outline: none; 
            font-size: 16px; 
            background-color: #f9f9f9; 
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: all 0.2s ease-in-out;
        "
        onfocus="this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)'; this.style.borderColor='#007bff';"
        onblur="this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.borderColor='#ccc';">
</div>
<form method="GET" action="/admin/sistemas/ticket/tablaTicket">
    <input type="hidden" name="page" value="1">
    <label for="per_page">Registros por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" <?php echo ($_GET['per_page'] ?? '10') == '10' ? 'selected' : ''; ?>>10</option>
        <option value="25" <?php echo ($_GET['per_page'] ?? '') == '25' ? 'selected' : ''; ?>>25</option>
        <option value="50" <?php echo ($_GET['per_page'] ?? '') == '50' ? 'selected' : ''; ?>>50</option>
        <option value="all" <?php echo ($_GET['per_page'] ?? '') == 'all' ? 'selected' : ''; ?>>Todos</option>
    </select>
</form>



<div class="dashboard__contenedor">
    <?php if (!empty($tickets)): ?>
        <table class="tables" id="tabla">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">Nro.</th>
                    <th scope="col" class="tables__th">Computadora ID</th>
                    <th scope="col" class="tables__th">Descripcion</th>
                    <th scope="col" class="tables__th">estado</th>
                    <th scope="col" class="tables__th">Fecha de Ticket</th>
                    <th scope="col" class="tables__th">Prioridad</th>


                    <th scope="col" class="tables__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <?php foreach ($tickets as $ticket): ?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?php echo $ticket->id ?></td>
                        <td class="tables__td"><?php echo $ticket->computadora_id ?></td>
                        <td class="tables__td"><?php echo $ticket->descripcion ?></td>
                        <!-- <td class="tables__td"><?php echo $ticket->estado ?></td>
                          -->

                        <td class="tables__td" style="color: <?php echo $ticket->estado == 'abierto' ? 'green' : 'red'; ?>; font-weight: <?php echo $ticket->estado == 'abierto' ? 'bold' : 'bold'; ?>;">
                            <?php echo $ticket->estado ?>
                        </td>

                        <td class="tables__td"><?php echo $ticket->fecha_creacion ?></td>
                        <td class="tables__td"><?php echo $ticket->prioridad ?></td>

                        <td class="tables__td--acciones"><a class="tables__accion tables__accion--editar" href="/admin/sistemas/ticket/editarTicket?id=<?php echo $ticket->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>