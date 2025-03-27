<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">INGRESO DE INSUMOS DE SISTEMAS  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre_producto">Nombre Producto</label>
        <input
            type="text"
            name="nombre_producto"
            id="nombre_producto"
            class="formulario__input"
            placeholder="Nombre del Producto"
            value="<?php echo $comercial->nombre_producto ?? '' ?>">
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
        value="<?php echo $comercial->costo_unitario ?? '' ?>"
        step="any"
        min="0">   
</div>


   
 


</fieldset>




