<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Selecciona un producto</label>
        <select name="id_producto" id="id_producto" class="formulario__input">
            <option value="" disabled selected>Selecciona un producto</option>
            <?php foreach ($productos_inventario as $producto): ?>
                <option value="<?php echo $producto->id_producto; ?>"
                    data-area="<?php echo $producto->id_area; ?>"
                    data-categoria = "<?php echo $producto->id_categoria; ?>"
                    data-stock="<?php echo $producto->stock_actual; ?>"
                    data-costo="<?php echo $producto->costo_unitario; ?>">
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Area</label>
        <select name="id_area" id="id_area" class="formulario__input"  >
            <option value="" disabled selected>Selecciona Area</option>
            <?php foreach ($area_inventario as $areas): ?>
                <option value="<?php echo $areas->id_area; ?>">
                    <?php echo htmlspecialchars($areas->nombre_area);  ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_categoria">Categoria</label>
        <select name="id_categoria" id="id_categoria" class="formulario__input"  >
            <option value="" disabled selected>Selecciona Area</option>
            <?php foreach ($categoria_inventario as $categoria): ?>
                <option value="<?php echo $categoria->id_categoria; ?>">
                    <?php echo htmlspecialchars($categoria->nombre_categoria);  ?>
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
    <div class="formulario__campo">
        <label class="formulario__label" for="costo_unitario">costo unitario</label>
        <input
            type="number"
            name="costo_unitario"
            id="costo_unitario"
            class="formulario__input"
            placeholder="costo_unitario"
            value="<?php echo $movimientos_invetario->costo_unitario ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="costo_nuevo">costo</label>
        <input
            type="number"
            name="costo_nuevo"
            id="costo_nuevo"
            class="formulario__input"
            placeholder="costo_nuevo"
            value="<?php echo $movimientos_invetario->costo ?? '' ?>">
    </div>


</fieldset>




<script>
        document.addEventListener("DOMContentLoaded", function() {
            const productoSelect = document.getElementById("id_producto");
            const areaSelect = document.getElementById("id_area");
            const categoriaSelect = document.getElementById("id_categoria");
            const stockInput = document.getElementById("stock_actual");
            const costoInput = document.getElementById("costo_unitario");

            productoSelect.addEventListener("change", function() {
                // Obtener la opción seleccionada
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const id_area = selectedOption.getAttribute("data-area");
                const id_categoria = selectedOption.getAttribute("data-categoria");
                const stock = selectedOption.getAttribute("data-stock"); // Obtener el stock
                const costo = selectedOption.getAttribute("data-costo"); // Obtener el costo

                console.log("Producto:", selectedOption.value);
                console.log("Area ID obtenido:", id_area);
                console.log("Categoria ID obtenido:", id_categoria);
                console.log("Stock obtenido:", stock);
                console.log("Costo obtenido:", costo);

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

                if (id_categoria) {
                    // Buscar y seleccionar la categoría correspondiente
                    for (let i = 0; i < categoriaSelect.options.length; i++) {
                        if (categoriaSelect.options[i].value === id_categoria) {
                            categoriaSelect.selectedIndex = i;
                            break;
                        }
                    }
                }


                if (costo) {
                    costoInput.value = costo; // Actualizar el campo de costo
                }
            });

            // Ejecutar la función al cargar la página para seleccionar automáticamente el producto y su stock
            productoSelect.dispatchEvent(new Event("change"));
        });
    </script>