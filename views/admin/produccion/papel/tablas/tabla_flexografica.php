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
                    <th colspan="5" class="table__th" style="background-color: #a564a8; color: white; text-align: center;">CONTROLABLE</th>
                    <th colspan="10" class="table__th" style="background-color: #4a90e2; color: white; text-align: center;">NO CONTROLABLE</th>
                    <th rowspan="2" class="table__th">Consumo</th>
                    <th rowspan="2" class="table__th">Total</th>
                    <th rowspan="2" class="table__th">Porcentaje</th>
                    <th rowspan="2" class="table__th">Fecha</th>
                    <th rowspan="2" class="table__th">Acciones</th>
                </tr>
                <tr>
                    <th class="table__th">CUADRE</th>
                    <th class="table__th">FALTA_TINTA</th>
                    <th class="table__th">MALTRATO_TRASPORT</th>
                    <th class="table__th">MALTRATO_MONTACARGAS</th>
                    <th class="table__th">TONALIDAD_TINTAS</th>
                    <th class="table__th">TROQUEL</th>
                    <th class="table__th">MONTAJE_CLICHE</th>
                    <th class="table__th">MECANICO</th>
                    <th class="table__th">ELECTRICO</th>
                    <th class="table__th">GALLET</th>
                    <th class="table__th">COMBADO</th>
                    <th class="table__th">HUMEDO</th>
                    <th class="table__th">DESPE</th>
                    <th class="table__th">ERROM</th>
                    <th class="table__th">SUSTRATO</th>



                </tr>
            </thead>

            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->id_orden ?></td>
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CUADRE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FALTA_TINTA) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MALTRATO_TRASPORT) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MALTRATO_MONTACARGAS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TONALIDAD_TINTAS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TROQUEL) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MONTAJE_CLICHE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MECANICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ELECTRICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->GALLET) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->COMBADO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->HUMEDO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DESPE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ERROM) ?></td>
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
                                <option value="FLEXOGRAFICA">FLEXOGRAFICA</option>
                                <!-- <option value="troquel">Troquel</option> -->
                                <option value="EDITAR">EDITAR</option>
                            </select>

                            <script>
                                function enviarIdOrden(selectElement) {
                                    const opcion = selectElement.value;
                                    const idOrdenRaw = selectElement.getAttribute('data-id-orden');
                                    const idOrden = idOrdenRaw ? idOrdenRaw.trim() : '';
                                    const idBobina = selectElement.getAttribute('data-id-bobina');

                                    if (opcion === 'FLEXOGRAFICA') {
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
                    <th></th>
                    <th>Totales:</th>
                    <?php
                    $columnas = [
                        'CUADRE',
                        'FALTA_TINTA',
                        'MALTRATO_TRASPORT',
                        'MALTRATO_MONTACARGAS',
                        'TONALIDAD_TINTAS',
                        'TROQUEL',
                        'MONTAJE_CLICHE',
                        'MECANICO',
                        'ELECTRICO',
                        'GALLET',
                        'COMBADO',
                        'HUMEDO',
                        'DESPE',
                        'ERROM',
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