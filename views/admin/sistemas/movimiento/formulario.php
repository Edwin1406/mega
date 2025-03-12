<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK </legend>

    <div class="formulario__campo">
    <label class="formulario__label" for="id_producto">Selecciona un producto</label>
    <select
        name="id_producto"
        id="id_producto"
        class="formulario__input">
        <option value="">-- Seleccione --</option>
        <?php foreach ($productos_inventario as $producto) : ?>
            <option
                value="<?php echo $producto->id_producto ?>"
                data-area-id="<?php echo $producto->id_area ?>">
                <?php echo $producto->nombre_producto ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="id_area">Selecciona el área</label>
    <select
        name="id_area"
        id="id_area"
        class="formulario__input">
        <option value="">-- Seleccione --</option>
        <!-- Aquí se llenarán las áreas dinámicamente -->
    </select>
</div>



    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const productoSelect = document.getElementById('id_producto');
    const areaSelect = document.getElementById('id_area');
    
    // Mapear las áreas para obtener el nombre del área por id_area
    const areas = <?php echo json_encode($area_inventario); ?>;
    
    function updateAreaSelect() {
        const productoId = productoSelect.value;
        
        // Limpiar las opciones actuales del área
        areaSelect.innerHTML = '<option value="">-- Seleccione --</option>';
        
        if (productoId) {
            const producto = productoSelect.querySelector(`option[value="${productoId}"]`);
            const areaId = producto ? producto.dataset.areaId : null;
            
            if (areaId) {
                // Buscar el nombre del área utilizando el id_area
                const area = areas.find(area => area.id_area == areaId);
                if (area) {
                    const option = document.createElement('option');
                    option.value = area.id_area; // ID del área
                    option.textContent = area.nombre_area; // Nombre del área
                    areaSelect.appendChild(option);
                }
            }
        }
    }

    // Escuchar el cambio de producto y actualizar el área
    productoSelect.addEventListener('change', updateAreaSelect);

    // Inicializar el área si ya hay un producto seleccionado
    updateAreaSelect();
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
        <label class="formulario__label" for="stock_actual">Stock</label>
        <input
            type="number"
            name="stock_actual"
            id="stock_actual"
            class="formulario__input"
            placeholder="Stock Actual"
            value="<?php echo $area_inventario->stock_actual ?? '' ?>">
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