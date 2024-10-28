<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del cliente</legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre del ponente"
            value="<?php echo $cliente->nombre ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="apellido">Apellido</label>
        <input
            type="text"
            name="apellido"
            id="apellido"
            class="formulario__input"
            placeholder="apellido del ponente"
            value="<?php echo $cliente->apellido ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="ruc">Ruc o cédula</label>
        <input
            type="text"
            name="ruc"
            id="ruc"
            class="formulario__input"
            placeholder="cuchillas de la maquina"
            value="<?php echo $cliente->ruc ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="telefono">Telefono</label>
        <input
            type="text"
            name="telefono"
            id="telefono"
            class="formulario__input"
            placeholder="telefono del cliente"
            value="<?php echo $cliente->telefono ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="email">Email</label>
        <input
            type="text"
            name="email"
            id="email"
            class="formulario__input"
            placeholder="email del cliente"
            value="<?php echo $cliente->email ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="direccion">Direcciòn</label>
        <input
            type="text"
            name="direccion"
            id="direccion"
            class="formulario__input"
            placeholder="Direccion del cliente"
            value="<?php echo $cliente->direccion ?? '' ?>">
    </div>
  
    <div class="formulario__campo">
        <label class="formulario__label" for="pais">Pais</label>
        <input
            type="text"
            name="pais"
            id="pais"
            class="formulario__input"
            placeholder="pais del cliente"
            value="<?php echo $cliente->pais ?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ciudad">Ciudad</label>
        <input
            type="text"
            name="ciudad"
            id="ciudad"
            class="formulario__input"
            placeholder="Ciudad del cliente"
            value="<?php echo $cliente->gramaje_maximo ?? '' ?>">
    </div>
    
    

    
</fieldset>