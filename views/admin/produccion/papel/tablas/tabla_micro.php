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
                    <th rowspan="2" class="table__th">Tipo de clasificación</th>
                    <th colspan="12" class="table__th" style="background-color: #a564a8; color: white; text-align: center;">CONTROLABLE</th>
                    <th colspan="10" class="table__th" style="background-color: #4a90e2; color: white; text-align: center;">NO CONTROLABLE</th>
                    <th rowspan="2" class="table__th">Consumo</th>
                    <th rowspan="2" class="table__th">Total</th>
                    <th rowspan="2" class="table__th">Porcentaje</th>
                    <th rowspan="2" class="table__th">Fecha</th>
                    <th rowspan="2" class="table__th">Acciones</th>
                </tr>
                <tr>
                    <th class="table__th">GALLET</th>
                    <th class="table__th">COMBADO</th>
                    <th class="table__th">HUMEDO</th>
                    <th class="table__th">FRENO</th>
                    <th class="table__th">DESPE</th>
                    <th class="table__th">PRESION</th>
                    <th class="table__th">ERROM</th>
                    <th class="table__th">SINGLEFACE</th>
                    <th class="table__th">CUADRE</th>
                    <th class="table__th">EMPALME</th>
                    <th class="table__th">RECUB</th>
                    <th class="table__th">PREPRINTER</th>


                    <th class="table__th">DESHOJE</th>
                    <th class="table__th">FILOS ROTOS</th>
                    <th class="table__th">ELECTRICO</th>
                    <th class="table__th">MECANICO</th>
                    <th class="table__th">PEDIDOS CORTOS</th>
                    <th class="table__th">DIFER ANCHO</th>
                    <th class="table__th">REFILE PEQUEÑO</th>
                    <th class="table__th">CAMBIO GRAMAJE</th>
                    <th class="table__th">EXTRA TRIM</th>
                    <th class="table__th">SUSTRATO</th>

                </tr>
            </thead>

            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->id_orden ?></td>
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->GALLET) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->COMBADO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->HUMEDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FRENO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESPE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PRESION) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ERROM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->SINGLEFACE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CUADRE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EMPALME) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->RECUB) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PREPRINTER) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESHOJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FILOS_ROTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ELECTRICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MECANICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PEDIDOS_CORTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DIFER_ANCHO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->REFILE_PEQUENO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_GRAMAJE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EXTRA_TRIM) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->SUSTRATO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CONSUMO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TOTAL) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PORCENTAJE) ?></td>
                        <td class="table__td"><?php echo $bobina->created_at ?></td>
                        <!-- <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar?id=<?php echo $bobina->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>Ver
                            </a>
                            <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
                            </form>
                        </td> -->
                        <td class="table__td--acciones">
                            <select class="opciones table__accion table__accion--editar" onchange="enviarIdOrden(this)"
                                data-id-orden="<?php echo trim($bobina->id_orden); ?>"
                                data-id-bobina="<?php echo $bobina->id; ?>">
                                <option value="">JALAR ID ORDEN</option>
                                <option value="MICRO">MICRO</option>
                                <!-- <option value="troquel">Troquel</option> -->
                                <option value="EDITAR">EDITAR</option>
                            </select>

                            <script>
                                function enviarIdOrden(selectElement) {
                                    const opcion = selectElement.value;
                                    const idOrdenRaw = selectElement.getAttribute('data-id-orden');
                                    const idOrden = idOrdenRaw ? idOrdenRaw.trim() : '';
                                    const idBobina = selectElement.getAttribute('data-id-bobina');

                                    if (opcion === 'MICRO') {
                                        // window.location.href = `/admin/produccion/papel/crear?id_orden=${idOrden}&id_bobina=${idBobina}`; 
                                        window.location.href = `/admin/produccion/papel/crear?id_orden=${idOrden}&tipo=${opcion}`;

                                    } else if (opcion === 'EDITAR') {
                                        // window.location.href = `/admin/produccion/papel/editar?id=${idBobina}`;
                                    }

                                }
                            </script>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

            <tfoot>
                <tr style="background-color:rgb(113, 178, 204); font-weight: bold;">
                    <td></td> <!-- Tipo de clasificación -->
                    <th>Totales:</th>
                    <?php
                    $columnas = [
                        'GALLET',
                        'COMBADO',
                        'HUMEDO',
                        'FRENO',
                        'DESPE',
                        'PRESION',
                        'ERROM',
                        'SINGLEFACE',
                        'CUADRE',
                        'EMPALME',
                        'RECUB',
                        'PREPRINTER',
                        'DESHOJE',
                        'FILOS_ROTOS',
                        'ELECTRICO',
                        'MECANICO',
                        'PEDIDOS_CORTOS',
                        'DIFER_ANCHO',
                        'REFILE_PEQUENO',
                        'CAMBIO_GRAMAJE',
                        'EXTRA_TRIM',
                        'SUSTRATO',
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