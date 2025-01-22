<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<ul class="lista-areas-produccion">
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-industry">  </i> TOTAL REGISTROS :
            <?php if($totalRegistros > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalRegistros ?> </span>
            <?php endif; ?> 
        </a>
    </li>
    <li class="areas-produccion">
        <a href="#">
            <i class="fas fa-scroll"></i> TOTAL EXISTENCIA :
            <?php if($totalExistencia > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalExistencia ?> KG </span>
            <?php endif; ?> 
        </a>
    </li>
</ul>








<form action="/admin/produccion/materia/corrugador" method="POST">
    <div>
        <label for="gramaje">Gramaje:</label>
        <input type="number" name="gramaje" id="gramaje" placeholder="Ingrese el gramaje">
    </div>
    <div>
        <label for="ancho">Ancho:</label>
        <input type="number" name="ancho" id="ancho" placeholder="Ingrese el ancho">
    </div>
    <div>
        <button type="submit">Filtrar</button>
    </div>
</form>

<?php if (!empty($materias)): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Almacén</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Costo</th>
                <th>Promedio</th>
                <th>Talla</th>
                <th>Línea</th>
                <th>Gramaje</th>
                <th>Proveedor</th>
                <th>Sustrato</th>
                <th>Ancho</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materias as $materia): ?>
                <tr>
                    <td><?php echo htmlspecialchars($materia->id); ?></td>
                    <td><?php echo htmlspecialchars($materia->almacen); ?></td>
                    <td><?php echo htmlspecialchars($materia->codigo); ?></td>
                    <td><?php echo htmlspecialchars($materia->descripcion); ?></td>
                    <td><?php echo htmlspecialchars($materia->existencia); ?></td>
                    <td><?php echo htmlspecialchars($materia->costo); ?></td>
                    <td><?php echo htmlspecialchars($materia->promedio); ?></td>
                    <td><?php echo htmlspecialchars($materia->talla); ?></td>
                    <td><?php echo htmlspecialchars($materia->linea); ?></td>
                    <td><?php echo htmlspecialchars($materia->gramaje); ?></td>
                    <td><?php echo htmlspecialchars($materia->proveedor); ?></td>
                    <td><?php echo htmlspecialchars($materia->sustrato); ?></td>
                    <td><?php echo htmlspecialchars($materia->ancho); ?></td>
                    <td>
                        <a href="/admin/produccion/materia/editar/<?php echo $materia->id; ?>">Editar</a>
                        <a href="/admin/produccion/materia/eliminar/<?php echo $materia->id; ?>" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No se encontraron resultados.</p>
<?php endif; ?>
