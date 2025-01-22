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







<!-- Filtros para Gramaje y Ancho -->
<label for="gramajeFilter">Filtrar por gramaje:</label>
<select id="gramajeFilter">
    <option value="all">Todos</option>
    <option value="150">150</option>
    <option value="151">151</option>
    <option value="160">160</option>
    <option value="161">161</option>
    <option value="170">170</option>
    <option value="186">186</option>
    <option value="200">200</option>
    <option value="205">205</option>
    <option value="225">225</option>
    <option value="230">230</option>
    <option value="250">250</option>
    <option value="254">254</option>
</select>

<label for="anchoFilter">Filtrar por ancho:</label>
<select id="anchoFilter">
    <option value="all">Todos</option>
    <option value="narrow">Estrecho (0-1000)</option>
    <option value="medium">Medio (1001-2000)</option>
    <option value="wide">Ancho (2001+)</option>
</select>

<!-- Canvas para el gráfico -->
<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos originales limitados a los gramajes válidos
    const originalData = {
        gramajes: ['150', '151', '160', '161', '170', '186', '200', '205', '225', '230', '250', '254'],
        anchos: [800, 1200, 500, 2000, 1800, 3000, 2200, 1500, 1000, 1800, 4000, 2500],
        cantidades: [1200, 1300, 1400, 1100, 1000, 800, 700, 600, 900, 850, 950, 1050]
    };

    // Configuración inicial del gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: originalData.gramajes,
            datasets: [{
                label: 'Cantidad',
                data: originalData.cantidades,
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)'
            }]
        },
        options: {
            responsive: true,
            onClick: (event, elements) => {
                if (elements.length > 0) {
                    // Obtener el índice de la barra clickeada
                    const index = elements[0].index;
                    const gramaje = originalData.gramajes[index];
                    const ancho = originalData.anchos[index];
                    
                    // Redirigir a otra página con detalles
                    const url = `detalles.php?gramaje=${gramaje}&ancho=${ancho}`;
                    window.location.href = url;
                }
            }
        }
    });

    // Función para aplicar filtros
    function updateChart() {
        const gramajeFilter = document.getElementById('gramajeFilter').value;
        const anchoFilter = document.getElementById('anchoFilter').value;

        let filteredLabels = [];
        let filteredData = [];

        originalData.gramajes.forEach((gramaje, index) => {
            const ancho = originalData.anchos[index];
            const cantidad = originalData.cantidades[index];

            // Filtrar por gramaje
            let gramajeMatch = (gramajeFilter === 'all' || gramaje === gramajeFilter);

            // Filtrar por ancho
            let anchoMatch = false;
            if (anchoFilter === 'narrow' && ancho <= 1000) anchoMatch = true;
            if (anchoFilter === 'medium' && ancho > 1000 && ancho <= 2000) anchoMatch = true;
            if (anchoFilter === 'wide' && ancho > 2000) anchoMatch = true;
            if (anchoFilter === 'all') anchoMatch = true;

            // Si cumple ambas condiciones, incluirlo
            if (gramajeMatch && anchoMatch) {
                filteredLabels.push(gramaje);
                filteredData.push(cantidad);
            }
        });

        // Actualizar el gráfico
        myChart.data.labels = filteredLabels;
        myChart.data.datasets[0].data = filteredData;
        myChart.update();
    }

    // Eventos para los filtros
    document.getElementById('gramajeFilter').addEventListener('change', updateChart);
    document.getElementById('anchoFilter').addEventListener('change', updateChart);
</script>
