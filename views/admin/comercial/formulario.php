<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Ingresar la información de la orden de compra  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="import">Import</label>
        <input
            type="text"
            name="import"
            id="import"
            class="formulario__input"
            placeholder="Número de Import"
            value="<?php echo $comercial->import ?? '' ?>">
    </div>

    <!-- <div class="formulario__campo">
        <label class="formulario__label" for="proyecto">Proyecto</label>
        <input
            type="text"
            name="proyecto"
            id="proyecto"
            class="formulario__input"
            placeholder="Número de Proyecto"
            value="<?php echo $comercial->proyecto ?? '' ?>">
    </div> -->

    <div class="formulario__campo">
        <label class="formulario__label" for="pedido_interno">Pedido Interno</label>
        <input
            type="text"
            name="pedido_interno"
            id="pedido_interno"
            class="formulario__input"
            placeholder="Número de Pedido Interno"
            value="<?php echo $comercial->pedido_interno ?? '' ?>">
    </div>

    <!-- <div class="formulario__campo">
        <label class="formulario__label" for="fecha_solicitud">Fecha Solicitud</label>
        <input
            type="date"
            name="fecha_solicitud"
            id="fecha_solicitud"
            class="formulario__input"
            value="<?php echo $comercial->fecha_solicitud ?? '' ?>">
    </div> -->

    <div class="formulario__campo">
        <label class="formulario__label" for="puerto_destino">Puerto Destino</label>
        <input
            type="text"
            name="puerto_destino"
            id="puerto_destino"
            class="formulario__input"
            placeholder="Puerto de Destino"
            value="<?php echo $comercial->puerto_destino ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="trader">Trader</label>
        <input
            type="text"
            name="trader"
            id="trader"
            class="formulario__input"
            placeholder="Nombre del Trader"
            value="<?php echo $comercial->trader ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="marca">Marca</label>
        <input
            type="text"
            name="marca"
            id="marca"
            class="formulario__input"
            placeholder="Nombre de la Marca"
            value="<?php echo $comercial->marca ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="linea">Linea</label>
        <input
            type="text"
            name="linea"
            id="linea"
            class="formulario__input"
            placeholder="Nombre de la Linea"
            value="<?php echo $comercial->linea ?? '' ?>">
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="producto">Producto</label>
        <input
            type="text"
            name="producto"
            id="producto"
            class="formulario__input"
            placeholder="Tipo de Producto"
            value="<?php echo $comercial->producto ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="gms">GMS</label>
        <input
            type="number"
            name="gms"
            id="gms"
            class="formulario__input"
            placeholder="Gramaje (GMS)"
            value="<?php echo $comercial->gms ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Ancho</label>
        <input
            type="number"
            name="ancho"
            id="ancho"
            class="formulario__input"
            placeholder="Ancho del Producto"
            value="<?php echo $comercial->ancho ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="cantidad">Cantidad</label>
        <input
            type="number"
            name="cantidad"
            id="cantidad"
            class="formulario__input"
            placeholder="Cantidad del Producto"
            value="<?php echo $comercial->cantidad ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="precio">Precio</label>
        <input
            type="text"
            name="precio"
            id="precio"
            class="formulario__input"
            placeholder="Precio Unitario"
            value="<?php echo $comercial->precio ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_produccion">Fecha Producción</label>
        <input
            type="date"
            name="fecha_produccion"
            id="fecha_produccion"
            class="formulario__input"
            value="<?php echo $comercial->fecha_produccion ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="arribo_planta">Arribo a Planta</label>
        <input
            type="date"
            name="arribo_planta"
            id="arribo_planta"
            class="formulario__input"
            value="<?php echo $comercial->arribo_planta ?? '' ?>">
    </div>
<!-- 

    <div class="formulario__campo">
        <label class="formulario__label" for="fecha_en_planta">Fecha en Planta</label>
        <input
            type="date"
            name="fecha_en_planta"
            id="fecha_en_planta"
            class="formulario__input"
            value="<?php echo $comercial->fecha_en_planta ?? '' ?>">
    </div> -->

    <div class="formulario__campo">
        <label class="formulario__label" for="observaciones">Observaciones</label>
        <textarea
            name="observaciones"
            id="observaciones"
            class="formulario__input"
            placeholder="Observaciones"><?php echo $comercial->observaciones ?? '' ?></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="estado">Estado</label>
        <select name="estado" id="estado" class="formulario__input">
            <option value="Pendiente" <?php echo $comercial->estado == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
        </select>
    </div>


</fieldset>




