<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>




<style>
    .contenedor {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* dos columnas */
        gap: 2rem;
        margin: 2rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: 1rem;
        max-width: 90%;
        /* más ancho */
        box-shadow: 0 2px 5px rgba(135, 164, 165, 0.2);
    }

    .caracteristicas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        /* margin: 2rem auto; */
    }

    .caracteristicas__item {
        background: radial-gradient(circle, rgb(196, 166, 138) 0%, rgb(218, 158, 109) 100%);
        color: rgb(2, 2, 2);
        padding: 1.5rem;
        border-radius: 1rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 5px rgba(135, 164, 165, 0.2);
    }

    .caracteristicas__item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(114, 156, 149, 0.3);
    }

    .caracteristicas__item p:first-child {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .caracteristicas__item p:last-child {
        font-size: 1.2rem;
        margin: 0;
        color: black;
    }

    .contenido {
        display: flex;
        justify-content: space-between;
        max-width: 90%;
        margin: auto;
        margin-top: 2rem;
    }

    .designar {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

<!-- nombre del usuario -->


<div class="contenido">
    <p class="designar"><b>Usuario Asignado: </b><?php echo $computadora->usuario_asignado ?></p>
    <p class="designar"><b>Area:</b> <?php echo $computadora->area ?></p>
</div>

<div class="contenedor">
    <div class="caracteristicas">
        <div class="caracteristicas__item">
            <p> ID DEL EQUIPO: </p>
            <p> <?php echo $computadora->numero_interno ?> </p>

        </div>
        <div class="caracteristicas__item">
            <p> AREA: </p>
            <p> <?php echo $computadora->area ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> USUARIO ASIGNADO: </p>
            <p> <?php echo $computadora->usuario_asignado ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> FECHA COMPRA: </p>
            <p> <?php echo $computadora->fecha_compra ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> MARCA O MODELO: </p>
            <p> <?php echo $computadora->marca_modelo ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> PROCESADOR: </p>
            <p> <?php echo $computadora->procesador ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> RAM: </p>
            <p> <?php echo $computadora->ram ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> DISCO DURO: </p>
            <p> <?php echo $computadora->disco_duro ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> SISTEMA OPERATIVO: </p>
            <p> <?php echo $computadora->sistema_operativo ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> ESTADO ACTUAL: </p>
            <p> <?php echo $computadora->estado_actual ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> DIRECCION IP: </p>
            <p> <?php echo $computadora->direccion_ip ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> CONTRASEÑA: </p>
            <p> <?php echo $computadora->contrasena ?> </p>
        </div>

        <div class="caracteristicas__item">
            <p> FECHA DE REGISTRO: </p>
            <p> <?php echo $computadora->created_at ?> </p>
        </div>
    </div>

    <div class="caracteristicas">



        <div class="dashboard__formulario">


            <?php include_once __DIR__ . '/../../../templates/alertas.php'  ?>

            <form method="POST" action="/admin/sistemas/registropc/version" class="formulario" enctype="multipart/form-data">
                <fieldset class="formulario__fieldset">
                    <legend class="formulario__legend">Información de Registro de computadora</legend>
                    <div class="formulario__campo">
                        <label class="formulario__label" for="numero_interno">ID DEL EQUIPO</label>
                        <input
                            type="text"
                            name="numero_interno"
                            id="numero_interno"
                            class="formulario__input"
                            placeholder="numero interno"
                            value="<?php echo $maquina->numero_interno ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="area">AREA</label>
                        <input
                            type="text"
                            name="area"
                            id="area"
                            class="formulario__input"
                            placeholder="area"
                            value="<?php echo $maquina->area ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="usuario_asignado">USUARIO ASIGNADO</label>
                        <input
                            type="text"
                            name="usuario_asignado"
                            id="usuario_asignado"
                            class="formulario__input"
                            placeholder="usuario_asignado"
                            value="<?php echo $maquina->usuario_asignado ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="fecha_compra">FECHA COMPRA </label>
                        <input
                            type="date"
                            name="fecha_compra"
                            id="fecha_compra"
                            class="formulario__input"
                            placeholder="fecha_compra"
                            value="<?php echo $maquina->fecha_compra ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="marca_modelo">MARCA O MODELO </label>
                        <input
                            type="text"
                            name="marca_modelo"
                            id="marca_modelo"
                            class="formulario__input"
                            placeholder="marca_modelo"
                            value="<?php echo $maquina->marca_modelo ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="procesador">PROCESADOR </label>
                        <input
                            type="text"
                            name="procesador"
                            id="procesador"
                            class="formulario__input"
                            placeholder="procesador"
                            value="<?php echo $maquina->procesador ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="ram">RAM </label>
                        <input
                            type="text"
                            name="ram"
                            id="ram"
                            class="formulario__input"
                            placeholder="ram"
                            value="<?php echo $maquina->ram ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="disco">DISCO </label>
                        <input
                            type="text"
                            name="disco"
                            id="disco"
                            class="formulario__input"
                            placeholder="disco"
                            value="<?php echo $maquina->disco ?? '' ?>">
                    </div>
                    <div class="formulario__campo">
                        <label class="formulario__label" for="sistema_operativo">SISTEMA OPERATIVO </label>
                        <input
                            type="text"
                            name="sistema_operativo"
                            id="sistema_operativo"
                            class="formulario__input"
                            placeholder="sistema_operativo"
                            value="<?php echo $maquina->sistema_operativo ?? '' ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="estado_actual">ESTADO ACTUAL </label>
                        <select name="estado_actual" id="estado_actual" class="formulario__input">
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Mal estado">Mal Estado</option>
                        </select>
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="direccion_ip">DIRECCION IP </label>
                        <input
                            type="text"
                            name="direccion_ip"
                            id="direccion_ip"
                            class="formulario__input"
                            placeholder="direccion ip"
                            value="">
                    </div>



                    <div class="formulario__campo">
                        <label class="formulario__label" for="contrasena">contraseña</label>
                        <input
                            type="text"
                            name="contrasena"
                            id="contrasena"
                            class="formulario__input"
                            placeholder="contrasena"
                            value="">
                    </div>
                </fieldset>
                <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar computadora">
            </form>

        </div>



    </div>




</div>