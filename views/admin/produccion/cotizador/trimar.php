<div class="dashboard__contenedor">
    <?php if (!empty($mejor_combinacion)): ?>
        <table class="tables" id="tabla_mejor_combinacion">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">ID Pedido 1</th>
                    <th scope="col" class="tables__th">Ancho Pedido 1</th>
                    <th scope="col" class="tables__th">ID Pedido 2</th>
                    <th scope="col" class="tables__th">Ancho Pedido 2</th>
                    <th scope="col" class="tables__th">ID Bobina</th>
                    <th scope="col" class="tables__th">Ancho Bobina</th>
                    <th scope="col" class="tables__th">Espacio Sobrante</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <tr class="tables__tr">
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->id; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_1']->ancho; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->id; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['pedido_2']->ancho; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['bobina']['id']; ?></td>
                    <td class="tables__td"><?php echo $mejor_combinacion['bobina']['ancho']; ?></td>
                    <td class="tables__td"><?php echo $mejor_suma; ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay combinaciones óptimas encontradas</a>
    <?php endif; ?>
</div>
