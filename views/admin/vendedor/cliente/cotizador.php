<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda -->
<div class="dashboard__contenedor">
    <input 
        type="text" 
        id="filtro" 
        class="dashboard__input" 
        placeholder="Filtrar por Código o Nombre..."
        style="margin-bottom: 15px; padding: 10px; width: 100%; box-sizing: border-box;">
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table" id="tabla">
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
                        <td class="table__td">
    <?php 
    $rutaArchivo = "/src/visor/" . htmlspecialchars($maquina->imagen);
    $extension = pathinfo($maquina->imagen, PATHINFO_EXTENSION);

    if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
        <!-- Mostrar miniatura para imágenes -->
        <img 
            src="<?php echo $rutaArchivo ?>" 
            alt="Imagen" 
            class="imagen-miniatura" 
            style="width: 100px; height: auto; cursor: pointer;" 
            onclick="mostrarImagen(this.src)">
    <?php elseif (strtolower($extension) === 'pdf'): ?>
        <!-- Mostrar enlace para visualizar PDF -->
        <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>
    <?php else: ?>
        <!-- Mostrar enlace para descargar otros archivos -->
        <a href="<?php echo $rutaArchivo ?>" download class="enlace-descarga">Descargar archivo</a>
    <?php endif; ?>
</td>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
    <?php endif; ?>
</div>

<!-- Modal para la imagen a pantalla completa -->
<div id="modalImagen" class="modal" style="display: none;">
    <span class="modal__cerrar" onclick="cerrarModal()">&times;</span>
    <img class="modal__contenido" id="imagenAmpliada" src="" alt="Imagen ampliada">
</div>

<script>
    // Mostrar la imagen en el modal
    function mostrarImagen(src) {
        const modal = document.getElementById('modalImagen');
        const imagenAmpliada = document.getElementById('imagenAmpliada');
        imagenAmpliada.src = src;
        modal.style.display = 'block';
    }

    // Cerrar el modal
    function cerrarModal() {
        const modal = document.getElementById('modalImagen');
        modal.style.display = 'none';
    }

    // Filtro en tiempo real
    document.getElementById('filtro').addEventListener('input', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tabla .table__tr');

        filas.forEach(fila => {
            const codigo = fila.cells[0].textContent.toLowerCase();
            const nombre = fila.cells[1].textContent.toLowerCase();

            if (codigo.includes(filtro) || nombre.includes(filtro)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });
</script>

<!-- Estilos del modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal__contenido {
        display: block;
        margin: auto;
        max-width: 80%;
        max-height: 80%;
    }

    .modal__cerrar {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal__cerrar:hover,
    .modal__cerrar:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<?php echo $paginacion; ?>
