<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">MOVIMIENTOS STOCK  </legend>
 


<!-- crear un select  -->
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
                data-area="<?php echo $producto->id_area ?>"><?php echo $producto->nombre_producto ?></option>
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
    </select>
</div>




<script>
    document.getElementById('id_producto').addEventListener('change', function () {
    const productoId = this.value;
    const areaSelect = document.getElementById('id_area');
    
    // Primero limpiamos las opciones del área
    areaSelect.innerHTML = '<option value="">-- Seleccione --</option>';
    
    // Si se selecciona un producto
    if (productoId) {
        // Encontrar el área relacionada con el producto seleccionado
        const producto = this.querySelector(`option[value="${productoId}"]`);
        const areaId = producto ? producto.dataset.area : null;
        
        // Crear una nueva opción para el área correspondiente
        if (areaId) {
            const option = document.createElement('option');
            option.value = areaId;
            option.textContent = 'Área ' + areaId; // Cambiar el texto según tu lógica
            areaSelect.appendChild(option);
        }
    }
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
            value="<?php echo $movimientos_invetario->stock_actual ?? '' ?>">
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




