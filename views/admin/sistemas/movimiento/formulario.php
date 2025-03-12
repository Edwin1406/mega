<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Selecciona un producto</label>
        <select name="id_producto" id="id_producto" class="formulario__input">
            <option value="" disabled selected>Selecciona un servicio</option>
            <?php foreach ($productos_inventario as $producto): ?>
                <option value="<?php echo $producto->id_producto; ?>" data-odontologo="<?php echo $producto->id_area; ?>">
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Selecciona un producto</label>
        <select name="id_area" id="id_area" class="formulario__input" >
            <option value="" disabled selected>Selecciona un odontólogo</option>
            <?php foreach ($area_inventario as $areas): ?>
                <option value="<?php echo $areas->id_area; ?>">
                    <?php echo htmlspecialchars($areas->nombre_area); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const servicioSelect = document.getElementById("id_producto");
        const odontologoSelect = document.getElementById("id_area");

        servicioSelect.addEventListener("change", function() {
            // Obtener la opción seleccionada
            const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
            const odontologoId = selectedOption.getAttribute("data-odontologo");

            console.log("Servicio seleccionado:", selectedOption.value);
            console.log("Odontólogo ID obtenido:", odontologoId);

            if (odontologoId) {
                // Buscar y seleccionar el odontólogo correspondiente
                for (let i = 0; i < odontologoSelect.options.length; i++) {
                    if (odontologoSelect.options[i].value === odontologoId) {
                        odontologoSelect.selectedIndex = i;
                        console.log("Odontólogo seleccionado automáticamente.");
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productoSelect = document.getElementById('id_producto');
        const areaSelect = document.getElementById('id_area');
        const stockInput = document.getElementById('stock_actual');

        // Convertir los productos y áreas con stock en un objeto
        const productosConStock = <?php echo json_encode($productos_inventario); ?>;

        function updateAreaSelect() {
            const productoId = productoSelect.value;

            // Limpiar las opciones actuales del área
            areaSelect.innerHTML = '<option value="">-- Seleccione --</option>';

            if (productoId) {
                const producto = productosConStock.find(producto => producto.id_producto == productoId);
                const areaId = producto ? producto.id_area : null;
                const areaName = producto ? producto.nombre_area : null;

                if (areaId && areaName) {
                    // Crear la opción para el área correspondiente usando el nombre del área
                    const option = document.createElement('option');
                    option.value = areaId; // El ID del área
                    option.textContent = areaName; // Nombre del área
                    areaSelect.appendChild(option);
                }
            }
        }

        function updateStockInput() {
            const productoId = productoSelect.value;
            const areaId = areaSelect.value;

            if (productoId && areaId) {
                // Buscar el stock correspondiente a la combinación de producto y área
                const producto = productosConStock.find(producto => producto.id_producto == productoId && producto.id_area == areaId);

                if (producto) {
                    stockInput.value = producto.stock_actual; // Asignar el stock al input
                    stockInput.disabled = false; // Habilitar el campo
                } else {
                    stockInput.value = ''; // Si no hay stock, dejarlo vacío
                    stockInput.disabled = true; // Deshabilitar el campo si no hay stock
                }
            } else {
                stockInput.value = ''; // Limpiar el stock si no se ha seleccionado producto o área
                stockInput.disabled = true; // Deshabilitar el campo
            }
        }

        // Escuchar el cambio de producto y área para actualizar el stock
        productoSelect.addEventListener('change', function() {
            updateAreaSelect();
            updateStockInput(); // Actualizar el stock al cambiar producto
        });

        areaSelect.addEventListener('change', updateStockInput); // Actualizar el stock al cambiar área

        // Inicializar el área y stock si ya hay un producto seleccionado
        updateAreaSelect();
        updateStockInput();
    });
</script>