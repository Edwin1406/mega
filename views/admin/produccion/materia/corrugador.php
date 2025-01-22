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
        <!-- un select -->
        <select name="gramaje" id="gramaje">
            <option value="0">Seleccione</option>
            <option value="45">45</option>
            <option value="150">150</option>
            <option value="175">175</option>
            <option value="254">254</option>
    </div>
    <br>

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
                <th>linea</th>
                <th>Existencia</th>
                <th>Costo</th>
                <th>Promedio</th>
                <th>Talla</th>
                <th>Proveedor</th>
                <th>Sustrato</th>
                <th>Gramaje</th>
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
                    <td><?php echo htmlspecialchars($materia->linea); ?></td>
                    <td><?php echo htmlspecialchars($materia->existencia); ?></td>
                    <td><?php echo htmlspecialchars($materia->costo); ?></td>
                    <td><?php echo htmlspecialchars($materia->promedio); ?></td>
                    <td><?php echo htmlspecialchars($materia->talla); ?></td>
                    <td><?php echo htmlspecialchars($materia->proveedor); ?></td>
                    <td><?php echo htmlspecialchars($materia->sustrato); ?></td>
                    <td><?php echo htmlspecialchars($materia->gramaje); ?></td>
                    <td><?php echo htmlspecialchars($materia->ancho); ?></td>
                    <td>
                        <!-- Botones de acción, como Editar o Eliminar -->
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





<!-- Formulario de filtro -->
<form action="/admin/produccion/materia/corrugador" method="POST">
    <div>
        <label for="gramajeMin">Gramaje Mínimo:</label>
        <input type="number" name="gramajeMin" id="gramajeMin" placeholder="Mínimo">
    </div>
    <div>
        <label for="gramajeMax">Gramaje Máximo:</label>
        <input type="number" name="gramajeMax" id="gramajeMax" placeholder="Máximo">
    </div>
    <br>
    <div>
        <label for="ancho">Ancho:</label>
        <input type="number" name="ancho" id="ancho" placeholder="Ingrese el ancho">
    </div>
    <div>
        <button type="submit">Filtrar</button>
    </div>
</form>


<!-- Canvas para el gráfico -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener datos desde PHP
    const materias = <?php echo $jsonMaterias; ?>;

    // Formatear datos para el gráfico
    const labels = materias.map(materia => materia.descripcion);
    const data = materias.map(materia => parseFloat(materia.existencia));

    // Crear el gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // Descripciones de las materias
            datasets: [{
                label: 'Existencia',
                data: data, // Existencia de cada materia
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    // Manejar envío del formulario
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        // Permitir recarga para obtener datos actualizados desde PHP
    });
</script>