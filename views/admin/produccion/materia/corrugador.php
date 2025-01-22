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
        <label for="existencia">Existencia</label>
        <input type="number" name="existencia" id="existencia" placeholder="Ingrese la exixtencia">
    </div>
    
    <div>
        <label for="sustrato">sustrato</label>
        <input type="text" name="sustrato" id="sustrato" placeholder="Ingrese la exixtencia">
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


<!-- Filtro para las etiquetas -->
<label for="filter">Filtrar por rango:</label>
<select id="filter">
    <option value="all">Todos</option>
    <option value="low">Bajo (40-50)</option>
    <option value="medium">Medio (51-70)</option>
    <option value="high">Alto (71+)</option>
</select>

<!-- Canvas para el gráfico -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos originales
    const originalData = {
        labels: ['40', '41', '42', '52', '53', '74', '75', '87', '100'], // Etiquetas dinámicas
        data: [1200, 1300, 1400, 1100, 1000, 800, 700, 600, 500] // Valores dinámicos
    };

    // Configuración inicial del gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: originalData.labels,
            datasets: [{
                label: 'Cantidad',
                data: originalData.data,
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)'
            }]
        }
    });

    // Función para actualizar el gráfico según el filtro
    function updateChart(filter) {
        let filteredLabels = [];
        let filteredData = [];

        // Aplica el filtro
        if (filter === 'low') {
            originalData.labels.forEach((label, index) => {
                if (label >= 40 && label <= 50) {
                    filteredLabels.push(label);
                    filteredData.push(originalData.data[index]);
                }
            });
        } else if (filter === 'medium') {
            originalData.labels.forEach((label, index) => {
                if (label >= 51 && label <= 70) {
                    filteredLabels.push(label);
                    filteredData.push(originalData.data[index]);
                }
            });
        } else if (filter === 'high') {
            originalData.labels.forEach((label, index) => {
                if (label >= 71) {
                    filteredLabels.push(label);
                    filteredData.push(originalData.data[index]);
                }
            });
        } else {
            // "Todos" (sin filtro)
            filteredLabels = originalData.labels;
            filteredData = originalData.data;
        }

        // Actualiza el gráfico
        myChart.data.labels = filteredLabels;
        myChart.data.datasets[0].data = filteredData;
        myChart.update();
    }

    // Evento para el filtro
    document.getElementById('filter').addEventListener('change', function () {
        updateChart(this.value);
    });
</script>

