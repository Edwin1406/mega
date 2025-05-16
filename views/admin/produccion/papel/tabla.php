<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/papel/crear">
    <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>

</div>
<div class="dashboard__contenedor">
    <?php if (!empty($bobinas)): ?>

        <?php 
            function letranegrita($value) {
                return $value > 0 ? '<strong>' . $value . '</strong>' : $value;
            }
        ?>

        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Tipo de clasificacion</th>
                    <th scope="col" class="table__th">Single Face</th>
                    <th scope="col" class="table__th">Empalme</th>
                    <th scope="col" class="table__th">Recub</th>
                    <th scope="col" class="table__th">Mecanico</th>
                    <th scope="col" class="table__th">Gallet</th>
                    <th scope="col" class="table__th">Humedo</th>
                    <th scope="col" class="table__th">Combinado</th>
                    <th scope="col" class="table__th">Despe</th>
                    <th scope="col" class="table__th">Errom</th>
                    <th scope="col" class="table__th">Deshoje</th>
                    <th scope="col" class="table__th">Cambio de pedido</th>
                    <th scope="col" class="table__th">Filos rotos</th>
                    <th scope="col" class="table__th">Otros</th>
                    <th scope="col" class="table__th">Pedidos cortos</th>
                    <th scope="col" class="table__th">Difer ancho</th>
                    <th scope="col" class="table__th">Cambio de gramaje</th>
                    <th scope="col" class="table__th">Extra trim</th>
                    <th scope="col" class="table__th">Consumo</th>
                    <th scope="col" class="table__th">Total</th>
                    <th scope="col" class="table__th">Porcentaje</th>
                    <th scope="col" class="table__th">Fecha</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->SINGLEFACE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EMPALME) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->RECUB) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MECANICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->GALLET) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->HUMEDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->COMBADO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESPE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ERROM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESHOJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_PEDIDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FILOS_ROTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->OTROS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PEDIDOS_CORTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DIFER_ANCHO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_GRAMAJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EXTRA_TRIM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CONSUMO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TOTAL) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PORCENTAJE) ?></td>
                        <td class="table__td"><?php echo $bobina->created_at ?></td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar?id=<?php echo $bobina->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>Ver
                            </a>
                            <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>
        <a class="text-center"> No hay Papel Aún</a>
    <?php endif; ?>
</div>


<?php echo $paginacion; ?>

