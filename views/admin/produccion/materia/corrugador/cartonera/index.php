<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>







<form method="GET" action="/admin/produccion/materia/corrugador/cartonera/index">
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