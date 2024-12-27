<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<!-- CSS de Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B0UglyR+LyTO1wDN3L0bq4Hr60PKlEcFca/J6p3VV9TgtGfSVGAn3UJf6p6N9Tw+" crossorigin="anonymous">

<!-- JavaScript de Bootstrap 5 (con Popper.js incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-64X6poAWajjw+JcQJ0UB+9P1Uu3oNSh4su6MFP9xx4BmN/z6jksEOVgq1ZrYZg+z" crossorigin="anonymous"></script>


<!-- Campo de búsqueda -->
<div class="dashboard__contenedor mb-3 p-3 rounded border shadow-sm bg-white">
    <input 
        type="text" 
        id="filtros_ventas" 
        class="form-control" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        onfocus="this.classList.add('shadow-lg', 'border-primary');"
        onblur="this.classList.remove('shadow-lg', 'border-primary');"
    >
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($visor)): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nombre Cliente</th>
                    <th scope="col">Nombre Producto</th>
                    <th scope="col">Archivo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visor as $maquina): ?>
                    <tr>
                        <td><?php echo $maquina->nombre_cliente; ?></td>
                        <td><?php echo $maquina->nombre_producto; ?></td>
                        <td>
                            <?php 
                            $rutaArchivo = "/src/visor/" . htmlspecialchars($maquina->pdf);
                            $extension = pathinfo($maquina->pdf, PATHINFO_EXTENSION);
                            ?>

                            <?php if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <img 
                                    src="<?php echo $rutaArchivo ?>" 
                                    alt="Imagen" 
                                    class="img-thumbnail" 
                                    style="width: 100px; cursor: pointer;" 
                                    onclick="mostrarImagen(this.src)">
                            <?php elseif (strtolower($extension) === 'pdf'): ?>
                                <a href="<?php echo $rutaArchivo ?>" target="_blank" class="btn btn-sm btn-primary">Ver PDF</a>
                            <?php else: ?>
                                <span class="text-muted">Formato no soportado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav aria-label="Paginación de resultados">
            <ul class="pagination justify-content-center">
                <?php echo $paginacion; ?>
            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-warning text-center">No hay visor aún</div>
    <?php endif; ?>
</div>
