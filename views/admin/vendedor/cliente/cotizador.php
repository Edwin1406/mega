<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
        <i class="fa-solid fa-circle-arrow-left"></i> REGRESAR A INICIO
    </a>
</div>

<!-- Campo de Búsqueda -->
<input type="text" id="buscador" placeholder="Buscar por código o nombre..." class="dashboard__input-busqueda">

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table" id="tablaVisor">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Código</th>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Imagen</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($visor as $maquina): ?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo htmlspecialchars($maquina->codigo) ?></td>
                        <td class="table__td"><?php echo htmlspecialchars($maquina->nombre) ?></td>
                        <td class="table__td">
                            <img src="/src/visor/<?php echo htmlspecialchars($maquina->imagen) ?>" 
                                 alt="Imagen" style="width: 100px; height: auto;">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No hay visor aún.</p>
    <?php endif; ?>
</div>
