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
        font-size: 1.6rem;
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .caracteristicas__item p:last-child {
        font-size: 2.2rem;
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
        font-size: 2rem;
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

            <form method="POST" action="/admin/sistemas/registropc/ver?id=<?php echo $computadora->id; ?>" class="formulario">
                <fieldset class="formulario__fieldset">
                    <legend class="formulario__legend">Agregar Mantenimiento o Reparación</legend>

                    <input type="hidden" name="computadora_id" value="<?php echo $computadora->id; ?>">

                    <div class="formulario__campo">
                        <label class="formulario__label" for="fecha_mantenimiento">Fecha del mantenimiento</label>
                        <input
                            type="date"
                            name="fecha_mantenimiento"
                            id="fecha_mantenimiento"
                            class="formulario__input"
                            value="<?php echo $mantenimiento->fecha_mantenimiento; ?>"
                            required>
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="tipo">Tipo de trabajo</label>
                        <select name="tipo" id="tipo" class="formulario__input" required>
                            <option value="">-- Seleccionar --</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="Reparación">Reparación</option>
                            <option value="Instalación">Instalación</option>
                            <option value="Actualización">Actualización</option>
                            <option value="Respaldos">Respaldos</option>

                        </select>
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="descripcion">Descripción</label>
                        <textarea
                            name="descripcion"
                            id="descripcion"
                            class="formulario__input"
                            placeholder="Detalles del trabajo realizado"
                            value="<?php echo $mantenimiento->descripcion; ?>"></textarea>
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="repuesto_usado">Repuesto utilizado (opcional)</label>
                        <input
                            type="text"
                            name="repuesto_usado"
                            id="repuesto_usado"
                            class="formulario__input"
                            placeholder="Ej: SSD 512GB"
                            value="<?php echo $mantenimiento->repuesto_usado; ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="fecha_cambio_repuesto">Fecha de cambio de repuesto (si aplica)</label>
                        <input
                            type="date"
                            name="fecha_cambio_repuesto"
                            id="fecha_cambio_repuesto"
                            class="formulario__input"
                            value="<?php echo $mantenimiento->fecha_cambio_repuesto; ?>">
                    </div>

                    <div class="formulario__campo">
                        <label class="formulario__label" for="costo">Costo (opcional)</label>
                        <input
                            type="number"
                            step="0.01"
                            name="costo"
                            id="costo"
                            class="formulario__input"
                            placeholder="Ej: 45.00"
                            value="<?php echo $mantenimiento->costo; ?>">
                    </div>

                    <input class="formulario__submit" type="submit" value="Registrar mantenimiento">
                </fieldset>
            </form>

        </div>



    </div>




</div>


<h2 class="dashboard__heading">Historial de Mantenimiento</h2>

<div class="dashboard__contenedor">
<?php if (!empty($mante) && is_array($mante)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Fecha mantenimiento</th>
                    <th scope="col" class="table__th">Tipo</th>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th">Repuesto usado</th>
                    <th scope="col" class="table__th">Fecha cambio</th>
                    <th scope="col" class="table__th">Costo</th>
                </tr>
            </thead>
            <tbody class="table__tbody">

               
          
    <?php foreach ($mante as $mantepc): ?>
        <tr class="table__tr">
            <td class="table__td"><?php echo $mantepc->fecha_mantenimiento; ?></td>
            <td class="table__td"><?php echo $mantepc->tipo; ?></td>
            <td class="table__td"><?php echo $mantepc->descripcion; ?></td>
            <td class="table__td"><?php echo $mantepc->repuesto_usado ?: '—'; ?></td>
            <td class="table__td"><?php echo $mantepc->fecha_cambio_repuesto ?: '—'; ?></td>
            <td class="table__td"><?php echo $mantepc->costo ? '$' . number_format($mantepc->costo, 2) : '—'; ?></td>
        </tr>
    <?php endforeach; ?>



            </tbody>
        </table>
        <?php else: ?>
    <tr><td colspan="6">No hay mantenimientos registrados.</td></tr>
<?php endif; ?>
</div>


<h2 class="dashboard__heading">Historial de Tickets</h2>

<div class="dashboard__contenedor">
<?php if (!empty($ticket) && is_array($ticket)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Id</th>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th">Fecha de creacion</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Prioridad</th>
                    <th scope="col" class="table__th">Categoria</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
          
    <?php foreach ($ticket as $tickets): ?>
        <tr class="table__tr">
            <td class="table__td"><?php echo $tickets->id; ?></td>
            <td class="table__td"><?php echo $tickets->descripcion; ?></td>
            <td class="table__td"><?php echo $tickets->fecha_creacion; ?></td>
            <td class="table__td"><?php echo $tickets->estado;?></td>
            <td class="table__td"><?php echo $tickets->prioridad;?></td>
            <td class="table__td"><?php echo $tickets->categoria; ?></td>
        </tr>
    <?php endforeach; ?>



            </tbody>
        </table>
        <?php else: ?>
    <tr><td colspan="6">No hay mantenimientos registrados.</td></tr>
<?php endif; ?>
</div>
