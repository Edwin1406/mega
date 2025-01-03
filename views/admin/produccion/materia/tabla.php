<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/crear">
        <i class="fa-solid fa-plus"></i>
        NUEVO PAPEL
    </a>
</div>


<div class="dashboard__contenedor">
    <?php if (!empty($materias)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre del Rollo</th>
                    <th scope="col" class="table__th">Tipo</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Peso</th>
                    <th scope="col" class="table__th">Gramaje</th>
                    <th scope="col" class="table__th">CED</th>
                    <th scope="col" class="table__th">Proveedor</th>
                    <th scope="col" class="table__th">Fecha de Ingreso </th>
                    <th scope="col" class="table__th">Fecha de Actualizacion</th>
                    <th scope="col" class="table__th">PDF</th>


                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($materias as $materia): ?>
                    <?php if ($materia->peso != 0): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $materia->nombre_rollo; ?></td>
                        <td class="table__td"><?php echo $materia->tipo; ?></td>
                        <td class="table__td"><?php echo $materia->ancho; ?></td>
                        <td class="table__td"><?php echo $materia->peso; ?></td>
                        <td class="table__td"><?php echo $materia->gramaje; ?></td>
                        <td class="table__td"><?php echo $materia->ced; ?></td>
                        <td class="table__td"><?php echo $materia->proveedor; ?></td>
                        <td class="table__td"><?php echo $materia->created_at; ?></td>
                        <td class="table__td"><?php echo $materia->updated_at; ?></td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/produccion/materia/pdf?id=<?php echo $materia->id; ?>" target="_blank">
                                <i class="fa-solid fa-file-pdf"></i>pdf
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>


        </table>
   


    <?php else: ?>
        <a class="text-center"> No hay Papel Aún</a>
    <?php endif; ?>
</div>
<button id="enable">Habilitar notificaciones</button>


<?php echo $paginacion; ?>

<script>
 function askNotificationPermission() {
  // función para pedir los permisos
  function handlePermission(permission) {
    // configura el botón para que se muestre u oculte, dependiendo de lo que
    // responda el usuario
    if (
      Notification.permission === "denied" ||
      Notification.permission === "default"
    ) {
      notificationBtn.style.display = "block";
    } else {
      notificationBtn.style.display = "none";
    }
  }

  // Comprobemos si el navegador admite notificaciones.
  if (!("Notification" in window)) {
    console.log("Este navegador no admite notificaciones.");
  } else {
    if (checkNotificationPromise()) {
      Notification.requestPermission().then((permission) => {
        handlePermission(permission);
      });
    } else {
      Notification.requestPermission(function (permission) {
        handlePermission(permission);
      });
    }
  }
}

</script>