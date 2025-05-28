<?php if (!empty($resultados)) : ?>
    <h3>Resultados para ID ORDEN: <?php echo htmlspecialchars($id_orden); ?></h3>

    <?php foreach ($resultados as $modelo => $registros) : ?>
        <?php if (!empty($registros) && is_array($registros) && isset($registros[0]) && is_array($registros[0])) : ?>
            <h4><?php echo $modelo; ?></h4>
            <table class="tabla">
                <thead>
                    <tr>
                        <?php foreach ($registros[0] as $campo => $valor) : ?>
                            <th><?php echo htmlspecialchars($campo); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $fila) : ?>
                        <tr>
                            <?php foreach ($fila as $valor) : ?>
                                <td><?php echo htmlspecialchars($valor); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay datos disponibles en el módulo <strong><?php echo htmlspecialchars($modelo); ?></strong>.</p>
        <?php endif; ?>
    <?php endforeach; ?>

<?php else : ?>
    <p>No se encontraron resultados para el ID ORDEN: <strong><?php echo htmlspecialchars($id_orden); ?></strong>.</p>
<?php endif; ?>
