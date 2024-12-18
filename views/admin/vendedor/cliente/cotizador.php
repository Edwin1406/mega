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
                            <img src="/src/visor/<?php echo htmlspecialchars($maquina->imagen) ?>" 
                                 alt="Imagen" style="width: 100px; height: auto;">
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
