<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
    <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>

</div>


<div class="dashboard__contenedor">
    <?php if (!empty($materias)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Tipo de Papel</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Fecha y Hora </th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($materias as $materia):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $materia->tipo?></td>
                        <td class="table__td"><?php echo $materia->ancho?></td>
                        <td class="table__td"><?php echo $materia->peso?></td>
                        <td class="table__td"><?php echo $materia->created_at?></td>
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/produccion/papel/editar?id=<?php echo $materia->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                        <!-- pdf -->
                        <a class="table__accion table__accion--pdf" href="/admin/produccion/papel/pdf?id=<?php echo $materia->id; ?>"><i class="fa-solid fa-file-pdf"></i>PDF</a>
                        <form method="POST" action="/admin/produccion/papel/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $materia->id; ?>">
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

