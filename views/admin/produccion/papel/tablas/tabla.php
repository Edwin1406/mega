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
        function letranegrita($value)
        {
            return $value > 0 ? '<strong>' . $value . '</strong>' : $value;
        }
        ?>

        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th rowspan="2" class="table__th">Id_orden</th>
                    <th rowspan="3" class="table__th">Tipo de clasificación</th>
                    <th colspan="9" class="table__th" style="background-color: #a564a8; color: white; text-align: center;">CONTROLABLE</th>
                    <th colspan="10" class="table__th" style="background-color: #4a90e2; color: white; text-align: center;">NO CONTROLABLE</th>
                    <th rowspan="2" class="table__th">Consumo</th>
                    <th rowspan="2" class="table__th">Total</th>
                    <th rowspan="2" class="table__th">Porcentaje</th>
                    <th rowspan="2" class="table__th">Fecha</th>
                    <th rowspan="2" class="table__th">Acciones</th>
                </tr>
                <tr>
                    <th class="table__th">Single Face</th>
                    <th class="table__th">Empalme</th>
                    <th class="table__th">Recub</th>
                    <th class="table__th">Gallet</th>
                    <th class="table__th">Húmedo</th>
                    <th class="table__th">Combado</th>
                    <th class="table__th">Despe</th>
                    <th class="table__th">Errom</th>
                    <th class="table__th">Deshoje</th>
                    <th class="table__th">Mecánico</th>
                    <th class="table__th">Cambio de pedido</th>
                    <th class="table__th">Electricoe pedido</th>
                    <th class="table__th">Filos rotos</th>
                    <th class="table__th">Refile pequeño</th>
                    <th class="table__th">Pedidos cortos</th>
                    <th class="table__th">Electrico</th>
                    <th class="table__th">Cambio de gramaje</th>
                    <th class="table__th">Difer ancho</th>
                    <th class="table__th">Extra trim</th>
                </tr>
            </thead>

            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">

                        <td class="table__td"><?php echo $bobina->id_orden ?></td>
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->SINGLEFACE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EMPALME) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->RECUB) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->GALLET) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->HUMEDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->COMBADO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESPE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ERROM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESHOJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MECANICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ELECTRICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FILOS_ROTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->REFILE_PEQUENO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PEDIDOS_CORTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DIFER_ANCHO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->SUSTRATO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_GRAMAJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_PEDIDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EXTRA_TRIM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CONSUMO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TOTAL) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PORCENTAJE) ?></td>
                        <td class="table__td"><?php echo $bobina->created_at ?></td>


                        <td class="table__td--acciones">
                            <select class="opciones table__accion table__accion--editar" onchange="enviarIdOrden(this)"
                                data-id-orden="<?php echo trim($bobina->id_orden); ?>"
                                data-id-bobina="<?php echo $bobina->id; ?>">
                                <option value="">JALAR ID ORDEN</option>
                                <option value="CORRUGADOR">CORRUGADOR</option>
                                <!-- <option value="troquel">Troquel</option> -->
                                <option value="EDITAR">EDITAR</option>
                            </select>

                            <script>
                                function enviarIdOrden(selectElement) {
                                    const opcion = selectElement.value;
                                    const idOrdenRaw  = selectElement.getAttribute('data-id-orden');
                                    const idOrden = idOrdenRaw ? idOrdenRaw.trim() : '';
                                    const idBobina = selectElement.getAttribute('data-id-bobina');

                                    if (opcion === 'CORRUGADOR') {
                                        // window.location.href = `/admin/produccion/papel/crear?id_orden=${idOrden}&id_bobina=${idBobina}`; 
                                        window.location.href = `/admin/produccion/papel/crear?id_orden=${idOrden}&tipo=${opcion}`;

                                    }  else if (opcion === 'EDITAR') {
                                        window.location.href = `/admin/produccion/papel/editar?id=${idBobina}`;
                                    }
                                    
                                }
                            </script>
                        </td>

                        <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

            <tfoot>
                <tr style="background-color:rgb(113, 178, 204); font-weight: bold; padding-left: 20px;">
                    <td></td> 
                    <th>Totales:</th>
                    <?php
                    $columnas = [
                        'SINGLEFACE',
                        'EMPALME',
                        'RECUB',
                        'GALLET',
                        'HUMEDO',
                        'COMBADO',
                        'DESPE',
                        'ERROM',
                        'DESHOJE',
                        'MECANICO',
                        'ELECTRICO',
                        'SUSTRATO',
                        'CAMBIO_PEDIDO',
                        'FILOS_ROTOS',
                        'REFILE_PEQUENO',
                        'PEDIDOS_CORTOS',
                        'DIFER_ANCHO',
                        'CAMBIO_GRAMAJE',
                        'EXTRA_TRIM',
                        'CONSUMO',
                        'TOTAL',
                        'PORCENTAJE'
                    ];

                    foreach ($columnas as $col) {
                        $valor = isset($totales[$col]) && $totales[$col] !== null ? $totales[$col] : 0;
                        echo '<td>' . letranegrita(number_format($valor, 2)) . '</td>';
                    }
                    ?>
                    <td></td> <!-- Acciones -->
                </tr>
            </tfoot>

        </table>

    <?php else: ?>
        <a class="text-center"> No hay Papel Aún</a>
    <?php endif; ?>
</div>

<?php echo $paginacion; ?>