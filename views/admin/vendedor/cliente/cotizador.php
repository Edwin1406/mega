<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda
<div class="dashboard__contenedor">
    <input 
        type="text" 
        id="filtro" 
        class="dashboard__input" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        style="margin-bottom: 15px; padding: 10px; width: 100%; box-sizing: border-box;">
</div> -->
<form method="GET" action="/admin/vendedor/cliente/cotizador" style="margin-bottom: 15px;">
    <input 
        type="text" 
        name="filtro" 
        id="filtro" 
        class="dashboard__input" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        value="<?php echo htmlspecialchars($filtro); ?>"
        style="padding: 10px; width: calc(100% - 20px); box-sizing: border-box;">
    <input type="hidden" name="page" value="1">
    <button type="submit" style="display: none;"></button>
</form>

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre Cliente</th>
                    <th scope="col" class="table__th">Nombre Prodcuto</th>
                    <th scope="col" class="table__th">Archivo PDF</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($visor as $maquina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $maquina->nombre_cliente?></td>
                        <td class="table__td"><?php echo $maquina->nombre_producto?></td>
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
                                <?php else: ?>
                                    <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>
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


<script>
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

<?php echo $paginacion; ?>
