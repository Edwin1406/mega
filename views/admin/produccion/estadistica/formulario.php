<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingreso de la información para estadistica de las graficas </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="import">Import</label>
        <input
            type="text"
            name="import"
            id="import"
            class="formulario__input"
            placeholder="Número de Import"
            value="<?php echo $pedido->import ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="proyecto">Proyecto</label>
        <input
            type="text"
            name="proyecto"
            id="proyecto"
            class="formulario__input"
            placeholder="Número de Proyecto"
            value="<?php echo $pedido->proyecto ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="pedido_interno">Pedido Interno</label>
        <input
            type="text"
            name="pedido_interno"
            id="pedido_interno"
            class="formulario__input"
            placeholder="Número de Pedido Interno"
            value="<?php echo $pedido->pedido_interno ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_solicitud">Fecha Solicitud</label>
        <input
            type="date"
            name="fecha_solicitud"
            id="fecha_solicitud"
            class="formulario__input"
            value="<?php echo $pedido->fecha_solicitud ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="trader">Trader</label>
        <input
            type="text"
            name="trader"
            id="trader"
            class="formulario__input"
            placeholder="Nombre del Trader"
            value="<?php echo $pedido->trader ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="marca">Marca</label>
        <input
            type="text"
            name="marca"
            id="marca"
            class="formulario__input"
            placeholder="Nombre de la Marca"
            value="<?php echo $pedido->marca ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="producto">Producto</label>
        <input
            type="text"
            name="producto"
            id="producto"
            class="formulario__input"
            placeholder="Tipo de Producto"
            value="<?php echo $pedido->producto ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gms">GMS</label>
        <input
            type="number"
            name="gms"
            id="gms"
            class="formulario__input"
            placeholder="Gramaje (GMS)"
            value="<?php echo $pedido->gms ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="number"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="Ancho del Producto"
            value="<?php echo $pedido->ancho ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad">Cantidad</label>
        <input
            type="number"
            name="cantidad"
            id="cantidad"
            class="formulario__input"
            placeholder="Cantidad del Producto"
            value="<?php echo $pedido->cantidad ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio</label>
        <input
            type="text"
            name="precio"
            id="precio"
            class="formulario__input"
            placeholder="Precio Unitario"
            value="<?php echo $pedido->precio ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="total_item">Total Item</label>
        <input
            type="text"
            name="total_item"
            id="total_item"
            class="formulario__input"
            placeholder="Total del Pedido"
            value="<?php echo $pedido->total_item ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_produccion">Fecha Producción</label>
        <input
            type="date"
            name="fecha_produccion"
            id="fecha_produccion"
            class="formulario__input"
            value="<?php echo $pedido->fecha_produccion ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ets">ETS</label>
        <input
            type="date"
            name="ets"
            id="ets"
            class="formulario__input"
            value="<?php echo $pedido->ets ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="eta">ETA</label>
        <input
            type="date"
            name="eta"
            id="eta"
            class="formulario__input"
            value="<?php echo $pedido->eta ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="arribo_planta">Arribo a Planta</label>
        <input
            type="date"
            name="arribo_planta"
            id="arribo_planta"
            class="formulario__input"
            value="<?php echo $pedido->arribo_planta ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="transito">Tránsito</label>
        <input
            type="number"
            name="transito"
            id="transito"
            class="formulario__input"
            placeholder="Días de Tránsito"
            value="<?php echo $pedido->transito ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_en_planta">Fecha en Planta</label>
        <input
            type="date"
            name="fecha_en_planta"
            id="fecha_en_planta"
            class="formulario__input"
            value="<?php echo $pedido->fecha_en_planta ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="observaciones">Observaciones</label>
        <textarea
            name="observaciones"
            id="observaciones"
            class="formulario__input"
            placeholder="Observaciones"><?php echo $pedido->observaciones ?? '' ?></textarea>
    </div>


</fieldset>