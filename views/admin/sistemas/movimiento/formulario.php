<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Selecciona un producto</label>
        <select name="id_producto" id="id_producto" class="formulario__input">
            <option value="" disabled selected>Selecciona un servicio</option>
            <?php foreach ($productos_inventario as $producto): ?>
                <option value="<?php echo $producto->id_producto; ?>" data-area="<?php echo $producto->id_area; ?>">
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Selecciona un producto</label>
        <select name="id_area" id="id_area" class="formulario__input" disabled >
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
            value="<?php echo $productos_inventario->cantidad ?? '' ?>">
    </div>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const productoSelect = document.getElementById("id_producto");
        const areaSelect = document.getElementById("id_area");

        productoSelect.addEventListener("change", function() {
            // Obtener la opción seleccionada
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];
            const id_area = selectedOption.getAttribute("data-area");

            console.log(" producto:", selectedOption.value);
            console.log("area ID obtenido:", id_area);

            if (id_area) {
                // Buscar y seleccionar el odontólogo correspondiente
                for (let i = 0; i < areaSelect.options.length; i++) {
                    if (areaSelect.options[i].value === id_area) {
                        areaSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });

        // Ejecutar la función al cargar la página para seleccionar automáticamente
        servicioSelect.dispatchEvent(new Event("change"));
    });
</script>


    <!-- tipo de movimiento -->

    <div class="formulario__campo">
        <label class="formulario__campo" for="tipo_movimiento">Tipo de movimiento</label>
        <select
            name="tipo_movimiento"
            id="tipo_movimiento"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <option
                <?php echo $movimientos_invetario->tipo_movimiento === 'Entrada' ? 'selected' : '' ?>
                value="Entrada">Entrada</option>
            <option
                <?php echo $movimientos_invetario->tipo_movimiento === 'Salida' ? 'selected' : '' ?>
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
