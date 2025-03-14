<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">INGRESO DE INSUMOS DE SISTEMAS  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Producto</label>
        <select
            name="id_producto"
            id="id_producto"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($productos_inventario as $producto) : ?>
                <option value="<?php echo $producto->id_producto; ?>"
                    data-area="<?php echo $producto->id_area; ?>"
                    data-categoria="<?php echo $producto->id_categoria; ?>"
                    data-costounitario="<?php echo $producto->costo_unitario; ?>">
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Selección de categoría y área, y mostrar el costo unitario -->
    <div class="formulario__campo">
        <label class="formulario__label" for="id_categoria">Categoria</label>
        <select
            name="id_categoria"
            id="id_categoria"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($categoria_inventario as $categoria) : ?>
                <option value="<?php echo $categoria->id_categoria ?>"><?php echo $categoria->nombre_categoria ?></option>
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
                <option value="<?php echo $area->id_area ?>"><?php echo $area->nombre_area ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="formulario__campo">
        <label class="formulario__label" for="costo_unitario">Costo Unitario</label>
        <input
            type="number"
            name="costo_unitario"
            id="costo_unitario"
            class="formulario__input"
            placeholder="Costo Unitario"
            value="">
    </div>


    <style>

    .formulario__tabla {
        width: 100%;
        border-collapse: collapse;
    }

    .formulario__tabla th,
    .formulario__tabla td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        width: 100px;
        background-color: #ac5353;
    }

    </style>

    <!-- Tabla para mostrar productos seleccionados -->
    <table id="productos_agregados" class="formulario__tabla">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Area</th>
                <th>Costo Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas se agregarán dinámicamente aquí -->
        </tbody>
    </table>
</fieldset>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productoSelect = document.getElementById("id_producto");
    const areaSelect = document.getElementById("id_area");
    const categoriaSelect = document.getElementById("id_categoria");
    const stockInput = document.getElementById("costo_unitario");
    const tablaProductos = document.getElementById("productos_agregados").getElementsByTagName("tbody")[0];

    productoSelect.addEventListener("change", function() {
        // Obtener la opción seleccionada
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const id_area = selectedOption.getAttribute("data-area");
        const id_categoria = selectedOption.getAttribute("data-categoria");
        const stock = selectedOption.getAttribute("data-costounitario");
        const producto = selectedOption.textContent;

        if (!producto || !id_area || !id_categoria || !stock) {
            return; // Si no hay datos válidos, no agregamos la fila
        }

        // Asignar los valores al formulario
        if (id_area) {
            for (let i = 0; i < areaSelect.options.length; i++) {
                if (areaSelect.options[i].value === id_area) {
                    areaSelect.selectedIndex = i;
                    break;
                }
            }
        }

        if (id_categoria) {
            for (let i = 0; i < categoriaSelect.options.length; i++) {
                if (categoriaSelect.options[i].value === id_categoria) {
                    categoriaSelect.selectedIndex = i;
                    break;
                }
            }
        }

        if (stock) {
            stockInput.value = stock; // Actualizar el costo unitario
        }

        // Crear una nueva fila en la tabla
        const nuevaFila = tablaProductos.insertRow();
        nuevaFila.innerHTML = `
            <td>${producto}</td>
            <td>${categoriaSelect.options[categoriaSelect.selectedIndex].text}</td>
            <td>${areaSelect.options[areaSelect.selectedIndex].text}</td>
            <td>${stock}</td>
            <td><input type="number" class="cantidad" value="1" min="1" /></td>
            <td class="total">${stock}</td>
            <td><button class="eliminar">Eliminar</button></td>
        `;

        // Función para actualizar el total
        const cantidadInput = nuevaFila.querySelector('.cantidad');
        const totalCell = nuevaFila.querySelector('.total');
        cantidadInput.addEventListener('input', function() {
            const cantidad = parseInt(cantidadInput.value, 10);
            if (!isNaN(cantidad)) {
                const total = cantidad * parseFloat(stock);
                totalCell.textContent = total.toFixed(2);
                actualizarTotalGeneral(); // Actualiza el total general
            }
        });

        // Función para eliminar la fila
        const eliminarBtn = nuevaFila.querySelector('.eliminar');
        eliminarBtn.addEventListener('click', function() {
            tablaProductos.deleteRow(nuevaFila.rowIndex);
            actualizarTotalGeneral(); // Actualiza el total general después de eliminar
        });

        // Actualiza el total general
        actualizarTotalGeneral();
    });

    // Función para actualizar el total general
    function actualizarTotalGeneral() {
        let totalGeneral = 0;
        const filas = tablaProductos.getElementsByTagName("tr");
        for (let i = 0; i < filas.length; i++) {
            const totalCell = filas[i].cells[5]; // Columna de total
            if (totalCell) {
                totalGeneral += parseFloat(totalCell.textContent) || 0;
            }
        }
        document.getElementById("total_general").textContent = `Total: $${totalGeneral.toFixed(2)}`;
    }

    // Ejecutar la función al cargar la página para seleccionar automáticamente el producto y su stock
    productoSelect.dispatchEvent(new Event("change"));
});


</script>
<p id="total_general">Total: $0.00</p>
