<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
    <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>

</div>


<div class="dashboard__contenedor">
    <?php if (!empty($bobinas)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Tipo de maquina</th>
                    <th scope="col" class="table__th">SF</th>
                    <th scope="col" class="table__th">LG</th>
                    <th scope="col" class="table__th">ERRO</th>
                    <th scope="col" class="table__th">HUN</th>
                    <th scope="col" class="table__th">MDO</th>
                    <th scope="col" class="table__th">TOTAL</th>
                    <th scope="col" class="table__th">Fecha Creacion</th>
                    <th scope="col" class="table__th">Fecha Actualizacion</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->tipo_maquina?></td>
                        <td class="table__td"><?php echo $bobina->SF?></td>
                        <td class="table__td"><?php echo $bobina->LG?></td>
                        <td class="table__td"><?php echo $bobina->ERRO?></td>
                        <td class="table__td"><?php echo $bobina->HUN?></td>
                        <td class="table__td"><?php echo $bobina->MDO?></td>
                        <td class="table__td"><?php echo $bobina->TOTAL?></td>
                        <td class="table__td"><?php echo $bobina->created_at?></td>
                        <td class="table__td"><?php echo $bobina->updated_at?></td>
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar?id=<?php echo $bobina->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                        <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $bobina->id; ?>">
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
        <a class="text-center"> No hay Papel Aún</a>
    <?php endif; ?>
</div>


<?php echo $paginacion; ?>

