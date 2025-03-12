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


    <div class="formulario__campo">
        <label class="formulario__label" for="pedido_interno">Categoria</label>
        <input
            type="text"
            name="pedido_interno"
            id="pedido_interno"
            class="formulario__input"
            placeholder="Número de Pedido Interno"
            value="<?php echo $comercial->pedido_interno ?? '' ?>">
    </div>

 

    <div class="formulario__campo">
        <label class="formulario__label" for="puerto_destino">Stock</label>
        <input
            type="text"
            name="puerto_destino"
            id="puerto_destino"
            class="formulario__input"
            placeholder="Puerto de Destino"
            value="<?php echo $comercial->puerto_destino ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="costo_unitario">Costo Unitario</label>
        <input
            type="text"
            name="costo_unitario"
            id="costo_unitario"
            class="formulario__input"
            placeholder="Costo Unitario"
            value="<?php echo $comercial->costo_unitario ?? '' ?>">
    </div>

   
 


</fieldset>




