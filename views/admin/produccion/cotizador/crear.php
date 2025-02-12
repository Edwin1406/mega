<!-- <h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/cotizador/tabla">
    <i class="fa-regular fa-eye"></i>
        VER TABLA DE COTIZADOR
    </a>

</div>

<div class="dashboard__formulario">

<?php include_once __DIR__.'/../../../templates/alertas.php'  ?>

    <form method="POST" action="/admin/produccion/cotizador/crear"  class="formulario" enctype="multipart/form-data">

     
    <?php include_once __DIR__.'/formulario.php'  ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Cotizacion">

        
    </form>

</div>

 -->


 <h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
    <i class="fa-solid fa-circle-arrow-left"></i>
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
                    <th scope="col" class="table__th">Ancho Maximo</th>
                    <th scope="col" class="table__th">Gramaje Maximo</th>
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
                        <td class="table__td--acciones"><a class="table__accion table__accion--editar" href="/admin/produccion/maquinas/editar?id=<?php echo $maquina->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                        <form method="POST" action="/admin/produccion/maquinas/eliminar" class="table__formulario">
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