<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
    <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($pedidosTrimar)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre pedido </th>
                    <th scope="col" class="table__th">Largo</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Alto</th>
                    <th scope="col" class="table__th">Flauta</th>
                    <th scope="col" class="table__th">Creado</th>
                    <th scope="col" class="table__th">Actualizado</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($pedidosTrimar as $trimar):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $trimar->nombre_pedido?></td>
                        <td class="table__td"><?php echo $trimar->largo?></td>
                        <td class="table__td"><?php echo $trimar->ancho?></td>
                        <td class="table__td"><?php echo $trimar->alto?></td>
                        <td class="table__td"><?php echo $trimar->flauta?></td>
                        <td class="table__td"><?php echo $trimar->created_at?></td>
                        <td class="table__td"><?php echo $trimar->updated_at?></td>
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/produccion/cotizador/trimarp?id=<?php echo $trimar->id; ?>"><i class="fa-solid fa-user-pen"></i>AGREGAR</a>
                        </td>
                    </tr>
                <?php endforeach;?>

            </tbody>

        </table>
   


    <?php else: ?>
        <a class="text-center"> No hay Ponentes Aún</a>
    <?php endif; ?>
</div>

<!-- <?php echo $paginacion; ?> -->