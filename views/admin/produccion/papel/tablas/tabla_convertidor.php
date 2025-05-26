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
                    <th rowspan="2" class="table__th">Tipo de clasificación</th>
                    <th colspan="2" class="table__th" style="background-color: #a564a8; color: white; text-align: center;">CONTROLABLE</th>
                    <th colspan="2" class="table__th" style="background-color: #4a90e2; color: white; text-align: center;">NO CONTROLABLE</th>
                    <th rowspan="2" class="table__th">Consumo</th>
                    <th rowspan="2" class="table__th">Total</th>
                    <th rowspan="2" class="table__th">Porcentaje</th>
                    <th rowspan="2" class="table__th">Fecha</th>
                    <th rowspan="2" class="table__th">Acciones</th>
                </tr>
                <tr>
                    <th class="table__th">Cuadre</th>
                    <th class="table__th">Cambio de medida</th>
                    <th class="table__th">Diferencia de peso</th>
                    <th class="table__th">Filos rotos</th>
                </tr>
            </thead>

            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->tipo_clasificacion ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CUADRE) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CAMBIO_MEDIDA) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->DIFERENCIA_PESO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->FILOS_ROTOS) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->CONSUMO) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->TOTAL) ?></td>
                        <td class="table__td"><?php echo letranegrita($bobina->PORCENTAJE) ?></td>
                        <td class="table__td"><?php echo $bobina->created_at ?></td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar_convertidor?id=<?php echo $bobina->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>Ver
                            </a>
                            <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                                <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

            <tfoot>
                <tr style="background-color:rgb(113, 178, 204); font-weight: bold;">
                    <th>Totales:</th>
                    <?php 
                      $columnas = [
                          'CUADRE', 'CAMBIO_MEDIDA', 'DIFERENCIA_PESO', 'FILOS_ROTOS',
                          'CONSUMO', 'TOTAL', 'PORCENTAJE'
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

