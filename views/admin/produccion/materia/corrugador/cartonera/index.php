<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>



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
        onblur="this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.borderColor='#ccc';"
    >
</div>
<form method="GET" action="/admin/vendedor/cliente/cotizador">
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
    <?php if (!empty($pedidosTrimar)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                <th scope="col" class="table__th">ID</th>
                    <th scope="col" class="table__th">Numero Pedido</th>
                    <th scope="col" class="table__th">Nombre Pedido</th>
                    <th scope="col" class="table__th">Cantidad</th>
                    <th scope="col" class="table__th">Largo</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Alto</th>
                    <th scope="col" class="table__th">Flauta</th>
                    <th scope="col" class="table__th">Test</th>
                    <th scope="col" class="table__th">Fecha Ingreso</th>
                    <th scope="col" class="table__th">Fecha Entrada</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($pedidosTrimar as $pTrimar):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $pTrimar->id?></td>
                        <td class="table__td"><?php echo $pTrimar->numero_pedido?></td>
                        <td class="table__td"><?php echo $pTrimar->nombre_pedido?></td>
                        <td class="table__td"><?php echo $pTrimar->cantidad?></td>
                        <td class="table__td"><?php echo $pTrimar->largo?></td>
                        <td class="table__td"><?php echo $pTrimar->ancho?></td>
                        <td class="table__td"><?php echo $pTrimar->alto?></td>
                        <td class="table__td"><?php echo $pTrimar->flauta?></td>
                        <td class="table__td"><?php echo $pTrimar->test?></td>
                        <td class="table__td"><?php echo $pTrimar->fecha_ingreso?></td>
                        <td class="table__td"><?php echo $pTrimar->fecha_entrega?></td>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
    <?php endif; ?>
</div>




<?php echo $paginacion; ?>