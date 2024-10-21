<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/sitioweb/admin/ponentes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        REGRESAR A INICIO
    </a>

</div>

<div class="dashboard__contenedor">
    <?php if (!empty($maquinas)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Maquina</th>
                    <th scope="col" class="table__th">Num. Cuchillas</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">Fecha y Hora</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($maquinas as $maquina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $maquina->nombre?></td>
                        <td class="table__td"><?php echo $maquina->num_cuchillas?></td>
                        <td class="table__td"><?php echo $maquina->ancho_maximo?></td>
                        <td class="table__td"><?php echo $maquina->gramaje_maximo?></td>
                        <td class="table__td"><?php echo $maquina->created_at?></td>
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/sitioweb/admin/ponentes/editar?id=<?php echo $maquina->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                        <form method="POST" action="/sitioweb/admin/ponentes/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $maquina->id; ?>">
                            <button class="table__accion table__accion--eliminar" type="submit">
                                <i class="fa-solid fa-user-slash"></i>
                                    Eliminar
                            </button>
                        </form>
                        </td>


                    </tr>
                <?php endforeach;?>

            </tbody>

        </table>
   


    <?php else: ?>
        <a class="text-center"> No hay Ponentes Aún</a>
    <?php endif; ?>
</div>

<?php echo $paginacion; ?>