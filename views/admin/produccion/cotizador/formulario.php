


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">En desarrollo</legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="pedido">Pedido 1</label>
        <select
            class="formulario__select"
            id="pedido"
            name="pedido_id"
            >
            <option value="" disabled selected>-- Seleccione --</option>
            <?php foreach($pedidos as $pedido): ?>
                <?php if ($pedido->estado === 'PENDIENTE'): // Mostrar solo pendientes ?>
                <option <?php echo s($pedido===$pedido->id)? 'selected':'' ?> value="<?php echo s($pedido->id); ?>"><?php echo s($pedido->cliente),' Largo : ', s($pedido->largo) ,' X',' Ancho : ', s($pedido->ancho) ,' ', s($pedido->estado); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
        </select>
    </div>


  





    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_interna_id">Bobina interna</label>
        <input
            type="text"
            name="bobina_interna_id"
            id="bobina_interna_id"
            class="formulario__input"
            placeholder="Escoja el tipo de papel interno"
            value="<?php echo $cotizacion->bobina_interna_id ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_media_id">Bobina media </label>
        <input
            type="text"
            name="bobina_media_id"
            id="bobina_media_id"
            class="formulario__input"
            placeholder="Escoja el tipo de papel medio"
            value="<?php echo $cotizacion->bobina_media_id ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="bobina_externa_id">Bobina externa</label>
        <input
            type="text"
            name="bobina_externa_id"
            id="bobina_externa_id"
            class="formulario__input"
            placeholder="Escoja el tipo de papel externo"
            value="<?php echo $papel->bobina_externa_id ?? '' ?>">
    </div>


    

    <div class="formulario__campo">
        <label class="formulario__label" for="maquina_id">Escoja la maquina </label>
        <input
            type="text"
            name="maquina_id"
            id="maquina_id"
            class="formulario__input"
            placeholder="maquina_id del papel"
            value="<?php echo $papel->maquina_id ?? '' ?>">
            <ul id="listado-maquinas" class="listado-maquinas"></ul>
    </div>

    
    <div class="formulario__campo">
        <label class="formulario__label" for="num_piezas">Numero de piezas</label>
        <input
            type="text"
            name="num_piezas"
            id="num_piezas"
            class="formulario__input"
            placeholder="num_piezas "
            value="<?php echo $papel->num_piezas ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="posicion_cuchilla">Posicion de cuchillas</label>
        <input
            type="text"
            name="posicion_cuchilla"
            id="posicion_cuchilla"
            class="formulario__input"
            placeholder="posicion_cuchilla del papel"
            value="<?php echo $papel->posicion_cuchilla ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ancho">Desperdicio</label>
        <input
            type="text"
            name="desperdicio"
            id="desperdicio"
            class="formulario__input"
            placeholder="desperdicio del papel"
            value="<?php echo $papel->desperdicio ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="gramaje_total">Gramaje total</label>
        <input
            type="text"
            name="gramaje_total"
            id="gramaje_total"
            class="formulario__input"
            placeholder="gramaje_total del papel"
            value="<?php echo $papel->gramaje_total ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="estado_combinacion">Estado de combinacion</label>
        <input
            type="text"
            name="estado_combinacion"
            id="estado_combinacion"
            class="formulario__input"
            placeholder="estado_combinacion del papel"
            value="<?php echo $papel->estado_combinacion ?? '' ?>">
    </div>
</fieldset>

