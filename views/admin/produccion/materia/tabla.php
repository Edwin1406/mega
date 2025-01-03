<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/crear">
        <i class="fa-solid fa-plus"></i>
        NUEVO PAPEL
    </a>
</div>

<!-- lector -->

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/lector">
        <i class="fa-solid fa-barcode"></i>
        LECTOR
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

<!-- 
<button id="notificar">Activar notificaciones</button>
<button id="enviarnotificacion">Enviar notificación</button>

<script>
    const notificar = document.querySelector('#notificar');
    notificar.addEventListener('click', () => {
        Notification.requestPermission().then(result => {
            console.log(`Permiso de notificación: ${result}`);
            if (result === 'granted') {
                alert('Permiso concedido. Puedes enviar notificaciones ahora.');
            } else {
                alert('Permiso denegado. No podrás recibir notificaciones.');
            }
        }).catch(error => console.error('Error al solicitar permisos:', error));
    });

    const enviarnotificacion = document.querySelector('#enviarnotificacion');
    enviarnotificacion.addEventListener('click', () => {
        if (Notification.permission === 'granted') {
            const notificacion = new Notification('Esta es una notificación', {
                icon: 'img/ccj.png',
                body: 'Este es el cuerpo de la notificación'
            });

            // Redirigir al usuario al hacer clic en la notificación
            notificacion.onclick = () => {
                window.open('https://megawebsistem.com/admin/produccion/materia/editar?id=13', '_blank');
            };

            // Opcional: manejar cierre de la notificación
            notificacion.onclose = () => {
                console.log('Notificación cerrada');
            };
        } else {
            alert('Primero necesitas activar las notificaciones.');
        }
    });
</script> -->
