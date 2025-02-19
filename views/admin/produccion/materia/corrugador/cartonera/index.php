<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>



<!-- Filtros -->
<div class="dashboard__contenedor" style="margin-bottom: 15px; padding: 20px; border-radius: 10px; border: 1px solid #ddd; background-color: #fff;">
    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" class="dashboard__input" onchange="filtrarTabla()">
    
    <label for="fecha_fin">Fecha Fin:</label>
    <input type="date" id="fecha_fin" class="dashboard__input" onchange="filtrarTabla()">
    
    <label for="test_filter">Test:</label>
    <input type="text" id="test_filter" class="dashboard__input" placeholder="Test" onchange="filtrarTabla()">
    
    <button onclick="filtrarTabla()">Filtrar</button>
</div>

<!-- Recuperar filtros desde localStorage -->
<script>
window.onload = function () {
    let filtrosGuardados = JSON.parse(localStorage.getItem('filtros_tabla')) || {};
    document.getElementById('fecha_inicio').value = filtrosGuardados.fecha_inicio || '';
    document.getElementById('fecha_fin').value = filtrosGuardados.fecha_fin || '';
    document.getElementById('test_filter').value = filtrosGuardados.test_filter || '';
    filtrarTabla();
};

function guardarFiltros() {
    let filtros = {
        fecha_inicio: document.getElementById('fecha_inicio').value,
        fecha_fin: document.getElementById('fecha_fin').value,
        test_filter: document.getElementById('test_filter').value
    };
    localStorage.setItem('filtros_tabla', JSON.stringify(filtros));
}

function filtrarTabla() {
    let fechaInicio = document.getElementById('fecha_inicio').value;
    let fechaFin = document.getElementById('fecha_fin').value;
    let testFilter = document.getElementById('test_filter').value;
    
    let rows = document.querySelectorAll('#tabla tbody tr');
    rows.forEach(row => {
        let fechaIngreso = row.cells[8].textContent;
        let testValue = row.cells[7].textContent;
        let mostrar = true;

        if (fechaInicio && fechaIngreso < fechaInicio) {
            mostrar = false;
        }
        if (fechaFin && fechaIngreso > fechaFin) {
            mostrar = false;
        }
        if (testFilter && testValue !== testFilter) {
            mostrar = false;
        }

        row.style.display = mostrar ? '' : 'none';
    });
    guardarFiltros();
}
</script>





<form method="GET" action="/admin/produccion/materia/corrugador/cartonera/index">
    <input type="hidden" name="page" value="1">
    <label for="per_page">Registros por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" <?php echo ($_GET['per_page'] ?? '10') == '10' ? 'selected' : ''; ?>>10</option>
        <option value="25" <?php echo ($_GET['per_page'] ?? '') == '25' ? 'selected' : ''; ?>>25</option>
        <option value="50" <?php echo ($_GET['per_page'] ?? '') == '50' ? 'selected' : ''; ?>>50</option>
        <option value="all" <?php echo ($_GET['per_page'] ?? '') == 'all' ? 'selected' : ''; ?>>Todos</option>
     
    </select>
</form>


<div class="dashboard__contenedor">
    <?php if (!empty($pedidosTrimar)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                <th scope="col" class="table__th">ID</th>

                    <th scope="col" class="table__th">Nombre Pedido</th>
                    <th scope="col" class="table__th">Cantidad</th>
                    <th scope="col" class="table__th">Largo</th>
                    <th scope="col" class="table__th">Ancho</th>
                    <th scope="col" class="table__th">Alto</th>
                    <th scope="col" class="table__th">Flauta</th>
                    <th scope="col" class="table__th">Test</th>
                    <th scope="col" class="table__th">Fecha Ingreso</th>
                    <th scope="col" class="table__th">Fecha Entrada</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($pedidosTrimar as $pTrimar):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $pTrimar->id?></td>
                        <td class="table__td"><?php echo $pTrimar->nombre_pedido?></td>
                        <td class="table__td"><?php echo $pTrimar->cantidad?></td>
                        <td class="table__td"><?php echo $pTrimar->largo?></td>
                        <td class="table__td"><?php echo $pTrimar->ancho?></td>
                        <td class="table__td"><?php echo $pTrimar->alto?></td>
                        <td class="table__td"><?php echo $pTrimar->flauta?></td>
                        <td class="table__td"><?php echo $pTrimar->test?></td>
                        <td class="table__td"><?php echo $pTrimar->fecha_ingreso?></td>
                        <td class="table__td"><?php echo $pTrimar->fecha_entrega?></td>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
    <?php endif; ?>
</div>




<?php echo $paginacion; ?>