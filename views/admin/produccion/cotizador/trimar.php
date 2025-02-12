<div class="dashboard__contenedor">
    <?php if (!empty($mejor_combinacion)): ?>
        <table class="tables" id="tabla_mejor_combinacion">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">ID</th>
                    <th scope="col" class="tables__th">Pedidos</th>
                    <th scope="col" class="tables__th">Ancho</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <tr class="tables__tr">
                    <td class="tables__td">1</td>
                    <td class="tables__td"><?php echo htmlspecialchars($mejor_combinacion['pedido_1']->nombre_pedido); ?></td>
                    <td class="tables__td"><?php echo htmlspecialchars($mejor_combinacion['pedido_1']->ancho); ?></td>
                </tr>

                <?php if (!empty($mejor_combinacion['pedido_2'])): ?>
                    <tr class="tables__tr">
                        <td class="tables__td">2</td>
                        <td class="tables__td"><?php echo htmlspecialchars($mejor_combinacion['pedido_2']->nombre_pedido); ?></td>
                        <td class="tables__td"><?php echo htmlspecialchars($mejor_combinacion['pedido_2']->ancho); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tarjeta con la información de la bobina -->
        <!-- Tarjeta con la información de la bobina -->
<div class="card">
    <h3>Bobina Seleccionada</h3>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($mejor_combinacion['bobina']['id']); ?></p>
    <p><strong>Ancho:</strong> <?php echo htmlspecialchars($mejor_combinacion['bobina']['ancho']); ?></p>

    <?php if ($mejor_combinacion['bobina']['id'] == 'N/A'): ?>
        <p style="color: red;"><strong>No hay bobina disponible con ancho suficiente para este pedido.</strong></p>
    <?php endif; ?>
</div>


    <?php else: ?>
        <a class="text-center"> No hay combinaciones óptimas encontradas</a>
    <?php endif; ?>
</div>
