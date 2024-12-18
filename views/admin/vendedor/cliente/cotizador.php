<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/registro_produccion">
        <i class="fa-solid fa-circle-arrow-left"></i> REGRESAR A INICIO
    </a>
</div>

<!-- Formulario de Búsqueda -->
<form method="GET" action="" class="dashboard__formulario-busqueda">
    <input type="text" name="codigo" placeholder="Buscar por código..." 
           value="<?php echo htmlspecialchars($_GET['codigo'] ?? '') ?>" class="dashboard__input-busqueda">
    <button type="submit" class="dashboard__boton-busqueda">Buscar</button>
</form>

<div class="dashboard__contenedor">
    <?php 
    // Filtrar resultados si se proporciona un código en la búsqueda
    $codigoBuscado = $_GET['codigo'] ?? '';
    $resultadosFiltrados = [];

    if (!empty($codigoBuscado)) {
        foreach ($visor as $maquina) {
            if (stripos($maquina->codigo, $codigoBuscado) !== false) {
                $resultadosFiltrados[] = $maquina;
            }
        }
    } else {
        $resultadosFiltrados = $visor; // Mostrar todos si no hay búsqueda
    }
    ?>

    <?php if (!empty($resultadosFiltrados)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Código</th>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Imagen</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($resultadosFiltrados as $maquina): ?>
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
        <p class="text-center">No se encontraron resultados para "<?php echo htmlspecialchars($codigoBuscado) ?>".</p>
    <?php endif; ?>
</div>
