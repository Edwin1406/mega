<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Selecciona un producto</label>
        <select name="id_producto" id="id_producto" class="formulario__input">
            <option value="" disabled selected>Selecciona un producto</option>
            <?php foreach ($productos_inventario as $producto): ?>
                <option value="<?php echo $producto->id_producto; ?>"
                    data-area="<?php echo $producto->id_area; ?>"
                    data-stock="<?php echo $producto->stock_actual; ?>"> <!-- Aquí pasamos el stock -->
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Area</label>
        <select name="id_area" id="id_area" class="formulario__input" >
            <option value="" disabled selected>Selecciona un odontólogo</option>
            <?php foreach ($area_inventario as $areas): ?>
                <option value="<?php echo $areas->id_area; ?>">
                    <?php echo htmlspecialchars($areas->nombre_area);  ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="stock_actual">Stock</label>
        <input
            type="number"
            name="stock_actual"
            id="stock_actual"
            class="formulario__input"
            placeholder="stock_actual"
            value="" disabled>
    </div>

    <div class="formulario__campo">
    <label class="formulario__campo" for="tipo_movimiento">Tipo de movimiento</label>
    <select
        name="tipo_movimiento"
        id="tipo_movimiento"
        class="formulario__input">
        <option value="">-- Seleccione --</option>
        <option
            <?php echo isset($movimientos_invetario) && $movimientos_invetario->tipo_movimiento === 'Entrada' ? 'selected' : '' ?>
            value="Entrada">Entrada</option>
        <option
            <?php echo isset($movimientos_invetario) && $movimientos_invetario->tipo_movimiento === 'Salida' ? 'selected' : '' ?>
            value="Salida">Salida</option>
    </select>
</div>


    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad">Cantidad</label>
        <input
            type="number"
            name="cantidad"
            id="cantidad"
            class="formulario__input"
            placeholder="Cantidad"
            value="<?php echo $movimientos_invetario->cantidad ?? '' ?>">
    </div>


</fieldset>




<script>
        document.addEventListener("DOMContentLoaded", function() {
            const productoSelect = document.getElementById("id_producto");
            const areaSelect = document.getElementById("id_area");
            const stockInput = document.getElementById("stock_actual");

            productoSelect.addEventListener("change", function() {
                // Obtener la opción seleccionada
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const id_area = selectedOption.getAttribute("data-area");
                const stock = selectedOption.getAttribute("data-stock"); // Obtener el stock

                console.log("Producto:", selectedOption.value);
                console.log("Area ID obtenido:", id_area);
                console.log("Stock obtenido:", stock);

                if (id_area) {
                    // Buscar y seleccionar el área correspondiente
                    for (let i = 0; i < areaSelect.options.length; i++) {
                        if (areaSelect.options[i].value === id_area) {
                            areaSelect.selectedIndex = i;
                            break;
                        }
                    }
                }

                // Asignar el stock al campo correspondiente
                if (stock) {
                    stockInput.value = stock; // Actualizar el campo de stock
                }
            });

            // Ejecutar la función al cargar la página para seleccionar automáticamente el producto y su stock
            productoSelect.dispatchEvent(new Event("change"));
        });
    </script>