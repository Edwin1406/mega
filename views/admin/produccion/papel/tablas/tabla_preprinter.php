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
                    <th colspan="7" class="table__th" style="background-color: #a564a8; color: white; text-align: center;">CONTROLABLE</th>
                    <th colspan="5" class="table__th" style="background-color: #4a90e2; color: white; text-align: center;">NO CONTROLABLE</th>
                    <th rowspan="2" class="table__th">Consumo</th>
                    <th rowspan="2" class="table__th">Total</th>
                    <th rowspan="2" class="table__th">Porcentaje</th>
                    <th rowspan="2" class="table__th">Fecha</th>
                    <th rowspan="2" class="table__th">Acciones</th>
                </tr>
                <tr>
                    <th class="table__th">FALTA_TINTA</th>
                    <th class="table__th">DERRAME_TINTA</th>
                    <th class="table__th">VISCOSIDAD</th>
                    <th class="table__th">PH</th>
                    <th class="table__th">CUADRE</th>
                    <th class="table__th">EMPALME</th>
                    <th class="table__th">APROBACION_COLOR</th>
                    <th class="table__th">FILOS_ROTOS</th>
                    <th class="table__th">CIREL_CORTADO</th>
                    <th class="table__th">ELECTRICO</th>
                    <th class="table__th">MECANICO</th>
                    <th class="table__th">SUSTRATO</th>




                </tr>
            </thead>

            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->id_orden ?></td>
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FALTA_TINTA) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DERRAME_TINTA) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->VISCOSIDAD) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PH) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CUADRE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->EMPALME) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->APROBACION_COLOR) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FILOS_ROTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CIREL_CORTADO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->ELECTRICO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->MECANICO) ?></td>
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
                                <option value="PREPRINTER">PREPRINTER</option>
                                <!-- <option value="troquel">Troquel</option> -->
                                <option value="EDITAR">EDITAR</option>
                            </select>

                            <script>
                                function enviarIdOrden(selectElement) {
                                    const opcion = selectElement.value;
                                    const idOrdenRaw = selectElement.getAttribute('data-id-orden');
                                    const idOrden = idOrdenRaw ? idOrdenRaw.trim() : '';
                                    const idBobina = selectElement.getAttribute('data-id-bobina');

                                    if (opcion === 'PREPRINTER') {
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
                        'FALTA_TINTA',
                        'DERRAME_TINTA',
                        'VISCOSIDAD',
                        'PH',
                        'CUADRE',
                        'EMPALME',
                        'APROBACION_COLOR',
                        'FILOS_ROTOS',
                        'CIREL_CORTADO',
                        'ELECTRICO',
                        'MECANICO',
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