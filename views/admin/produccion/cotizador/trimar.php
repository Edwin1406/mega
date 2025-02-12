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
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->nombre_pedido; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->ancho; ?></td>
                </tr>
                <tr class="tables__tr">
                    <td class="tables__td">2</td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->nombre_pedido; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->ancho; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Tarjeta con la información de la bobina -->
        <div class="card">
            <h3>Bobina Seleccionada</h3>
            <p><strong>ID:</strong> <?php echo $mejor_combinacion['bobina']['id']; ?></p>
            <p><strong>Ancho:</strong> <?php echo $mejor_combinacion['bobina']['ancho']; ?></p>
        </div>

    <?php else: ?>
        <a class="text-center"> No hay combinaciones óptimas encontradas</a>
    <?php endif; ?>
</div>
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
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->nombre_pedido; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->ancho; ?></td>
                </tr>
                <tr class="tables__tr">
                    <td class="tables__td">2</td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->nombre_pedido; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->ancho; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Tarjeta con la información de la bobina -->
        <div class="card">
            <h3>Bobina Seleccionada</h3>
            <p><strong>ID:</strong> <?php echo $mejor_combinacion['bobina']['id']; ?></p>
            <p><strong>Ancho:</strong> <?php echo $mejor_combinacion['bobina']['ancho']; ?></p>
        </div>

    <?php else: ?>
        <a class="text-center"> No hay combinaciones óptimas encontradas</a>
    <?php endif; ?>
</div>
