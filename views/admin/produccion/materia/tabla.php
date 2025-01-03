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

<?php echo $paginacion; ?>




<button id="enable" onclick="askNotificationPermission()">Habilitar notificaciones</button>


<script>
  // Vincula el botón en una variable
  const notificationBtn = document.getElementById("enable");

  // Verifica si el navegador admite promesas en Notification
  function checkNotificationPromise() {
    try {
      return !!Notification.requestPermission().then;
    } catch (e) {
      return false;
    }
  }

  function askNotificationPermission() {
    // Función para pedir permisos
    function handlePermission(permission) {
      if (permission === "granted") {
        // Oculta el botón si se otorgan permisos
        notificationBtn.style.display = "none";
        sendNotification("Título de ejemplo"); // Llama a la notificación de ejemplo
      } else {
        // Muestra el botón si se deniega o está en estado por defecto
        notificationBtn.style.display = "block";
      }
    }

    // Comprueba si el navegador admite notificaciones
    if (!("Notification" in window)) {
      console.log("Este navegador no admite notificaciones.");
    } else {
      if (checkNotificationPromise()) {
        Notification.requestPermission()
          .then((permission) => {
            handlePermission(permission);
          })
          .catch((error) => {
            console.error("Error al solicitar permisos:", error);
          });
      } else {
        Notification.requestPermission(function (permission) {
          handlePermission(permission);
        });
      }
    }
  }

  function sendNotification(title) {
    var img = "/to-do-notifications/img/icon-128.png"; // Ruta del icono
    var text = '¡OYE! Tu tarea "' + title + '" ahora está vencida.';
    var notification = new Notification("Lista de tareas", {
      body: text,
      icon: img,
    });

    // Opcional: agregar eventos al clic en la notificación
    notification.onclick = function () {
      window.open("https://tu-enlace.com"); // Enlace al que se redirige al hacer clic
    };
  }
</script>
