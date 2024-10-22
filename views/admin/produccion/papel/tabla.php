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
                    <th scope="col" class="table__th">Tipo de Papel</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Fecha y Hora </th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">

                <?php foreach ($bobinas as $bobina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $bobina->tipo_papel?></td>
                        <td class="table__td"><?php echo $bobina->gramaje?></td>
                        <td class="table__td"><?php echo $bobina->ancho?></td>
                        <td class="table__td"><?php echo $bobina->created_at?></td>
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




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS con Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<div class="container mt-5">
    <h2 class="text-center mb-4">Cotizador</h2>

    <table id="miTabla" class="table table-striped table-bordered" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Oficina</th>
                <th>Edad</th>
               
            </tr>
        </thead>
        <?php foreach ($bobinas as $bobina):?>
        <tbody>
            <tr>
                <td><?php echo $bobina->tipo_papel?></td>
                <td><?php echo $bobina->gramaje?></td>
                <td><?php echo $bobina->ancho?></td>
                <td><?php echo $bobina->created_at?></td>
             
            </tr>
           
            <!-- Agrega más filas aquí -->
        </tbody>
        <?php endforeach;?>
    </table>
</div>

<?php echo $paginacion; ?>