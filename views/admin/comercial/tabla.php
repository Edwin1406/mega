<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>



<div class="dashboard__contenedor">
    <?php if (!empty($comercial)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nro.</th>
                    <th scope="col" class="table__th">Import</th>
                    <th scope="col" class="table__th">Proyecto</th>
                    <th scope="col" class="table__th">Pedido Interno</th>
                    <th scope="col" class="table__th">Fecha Solicitud</th>
                    <th scope="col" class="table__th">Puerto Destino</th>
                    <th scope="col" class="table__th">Trader</th>
                    <th scope="col" class="table__th">Marca</th>
                    <th scope="col" class="table__th">Linea</th>
                    <th scope="col" class="table__th">Producto</th>
                    <th scope="col" class="table__th">GMS</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Cantidad</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Total Item</th>
                    <th scope="col" class="table__th">Fecha Producción</th>
                    <th scope="col" class="table__th">Arribo Planta</th>
                    <th scope="col" class="table__th">Transito</th>
                    <th scope="col" class="table__th">Fecha en Planta</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($comercial as $comerciales):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $comerciales->id?></td>
                        <td class="table__td"><?php echo $comerciales->import?></td>
                        <td class="table__td"><?php echo $comerciales->proyecto?></td>
                        <td class="table__td"><?php echo $comerciales->pedido_interno?></td>
                        <td class="table__td"><?php echo $comerciales->fecha_solicitud?></td>
                        <td class="table__td"><?php echo $comerciales->puerto_destino?></td>
                        <td class="table__td"><?php echo $comerciales->trader?></td>
                        <td class="table__td"><?php echo $comerciales->marca?></td>
                        <td class="table__td"><?php echo $comerciales->linea?></td>
                        <td class="table__td"><?php echo $comerciales->producto?></td>
                        <td class="table__td"><?php echo $comerciales->gms?></td>
                        <td class="table__td"><?php echo $comerciales->ancho?></td>
                        <td class="table__td"><?php echo $comerciales->cantidad?></td>
                        <td class="table__td"><?php echo $comerciales->precio?></td>
                        <td class="table__td"><?php echo $comerciales->total_item?></td>
                        <td class="table__td"><?php echo $comerciales->fecha_produccion?></td>
                        <td class="table__td"><?php echo $comerciales->arribo_planta?></td>
                        <td class="table__td"><?php echo $comerciales->transito?></td>
                        <td class="table__td"><?php echo $comerciales->fecha_en_planta?></td>
                        <td class="table__td"><?php echo $comerciales->estado?></td>
                        <td  class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/comercial/editar?id=<?php echo $comerciales->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>


