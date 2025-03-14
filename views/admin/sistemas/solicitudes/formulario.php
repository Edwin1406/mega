<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">INGRESO DE INSUMOS DE SISTEMAS  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Categoria</label>
        <select
            name="id_producto"
            id="id_producto"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($productos_inventario as $producto) : ?>
                <option value="<?php echo $producto->id_producto; ?>"
                    data-area="<?php echo $producto->id_area; ?>"
                    data-categoria = "<?php echo $producto->id_categoria; ?>"> 
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


<!-- crear un select  -->
    <div class="formulario__campo">
        <label class="formulario__label" for="id_categoria">Categoria</label>
        <select
            name="id_categoria"
            id="id_categoria"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($categoria_inventario as $categoria) : ?>
                <option
                    <?php echo $categoria->id_categoria === $categoria->id_categoria ? 'selected' : '' ?>
                    value="<?php echo $categoria->id_categoria ?>"><?php echo $categoria->nombre_categoria ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Area</label>
        <select
            name="id_area"
            id="id_area"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($area_inventario as $area) : ?>
                <option
                    <?php echo $area->id_area === $area->id_area ? 'selected' : '' ?>
                    value="<?php echo $area->id_area ?>"><?php echo $area->nombre_area ?></option>
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
            placeholder="Stock Actual"
            value="<?php echo $comercial->stock_actual ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="costo_unitario">Costo Unitario</label>
        <input
            type="number"
            name="costo_unitario"
            id="costo_unitario"
            class="formulario__input"
            placeholder="Costo Unitario"
            value="<?php echo $comercial->costo_unitario ?? '' ?>">
    </div>

   
 


</fieldset>





<script>
        document.addEventListener("DOMContentLoaded", function() {
            const productoSelect = document.getElementById("id_producto");
            const areaSelect = document.getElementById("id_area");
            const categoriaSelect = document.getElementById("id_categoria");

            productoSelect.addEventListener("change", function() {
                // Obtener la opción seleccionada
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const id_area = selectedOption.getAttribute("data-area");
                const id_categoria = selectedOption.getAttribute("data-categoria");

                console.log("Producto:", selectedOption.value);
                console.log("Area ID obtenido:", id_area);
                console.log("Categoria ID obtenido:", id_categoria);

                if (id_area) {
                    // Buscar y seleccionar el área correspondiente
                    for (let i = 0; i < areaSelect.options.length; i++) {
                        if (areaSelect.options[i].value === id_area) {
                            areaSelect.selectedIndex = i;
                            break;
                        }
                    }
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
            });

            // Ejecutar la función al cargar la página para seleccionar automáticamente el producto y su stock
            productoSelect.dispatchEvent(new Event("change"));
        });
    </script>
