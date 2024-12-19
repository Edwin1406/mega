<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda -->
<div style="
    margin-bottom: 15px; 
    padding: 10px; 
    width: 100%; 
    box-sizing: border-box; 
    border-radius: 10px; 
    border: 1px solid #ccc; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    background-color: #f9f9f9; 
    transition: all 0.3s ease-in-out;
">
    <input type="text" placeholder="Filtrar..." 
        style="
            width: 100%; 
            padding: 8px; 
            border: none; 
            outline: none; 
            border-radius: 5px; 
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        "
    >
</div>


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
