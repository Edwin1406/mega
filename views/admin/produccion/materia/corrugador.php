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
            <option value="90">90</option>
            <option value="100">100</option>
            <option value="110">110</option>
            <option value="120">120</option>
            <option value="130">130</option>
            <option value="140">140</option>
            <option value="150">150</option>
            <option value="160">160</option>
            <option value="170">170</option>
            <option value="180">180</option>
            <option value="190">190</option>
            <option value="200">200</option>
            <option value="210">210</option>
            <option value="220">220</option>
            <option value="230">230</option>
            <option value="240">240</option>
            <option value="250">250</option>
            <option value="260">260</option>
            <option value="270">270</option>
            <option value="280">280</option>
            <option value="290">290</option>
            <option value="300">300</option>
            <option value="310">310</option>
            <option value="320">320</option>
            <option value="330">330</option>
            <option value="340">340</option>
            <option value="350">350</option>
            <option value="360">360</option>
            <option value="370">370</option>
            <option value="45">45</option>
            <option value="390">390</option>
            <option value="400">400</option>
            <option value="410">410</option>
            <option value="420">420</option>
            <option value="430">430</option>
            <option value="440">440</option>
            <option value="450">450</option>
            <option value="460">460</option>
            <option value="470">470</option>
            <option value="480">480</option>
            <option value="490">490</option>
            <option value="500">500</option>
            <option value="510">510</option>
            <option value="520">520</option>
        
    </div>

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
