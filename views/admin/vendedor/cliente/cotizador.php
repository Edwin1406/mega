<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
    <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>

</div>

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Codigo</th>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Imagen</th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($visor as $maquina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $maquina->codigo?></td>
                        <td class="table__td"><?php echo $maquina->nombre?></td>
                        <img src="/src/visor/<?php echo htmlspecialchars($maquina->imagen) ?>" alt="Imagen del visor" class="table__td">
                        </td>


                    </tr>
                <?php endforeach;?>

            </tbody>

        </table>
   


    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
    <?php endif; ?>
</div>

<?php echo $paginacion; ?>