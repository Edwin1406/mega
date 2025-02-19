<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>





<form method="GET" action="/admin/produccion/materia/corrugador/cartonera/index" id="filtroForm">
    <input type="hidden" name="page" value="1">

    <label for="per_page">Registros por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" <?php echo ($_GET['per_page'] ?? '10') == '10' ? 'selected' : ''; ?>>10</option>
        <option value="25" <?php echo ($_GET['per_page'] ?? '') == '25' ? 'selected' : ''; ?>>25</option>
        <option value="50" <?php echo ($_GET['per_page'] ?? '') == '50' ? 'selected' : ''; ?>>50</option>
        <option value="all" <?php echo ($_GET['per_page'] ?? '') == 'all' ? 'selected' : ''; ?>>Todos</option>
    </select>

    <label for="fecha_entrega">Fecha de Entrega:</label>
    <input type="date" name="fecha_entrega" id="fecha_entrega" value="<?php echo $_GET['fecha_entrega'] ?? ''; ?>">

    <label for="test">Test:</label>
    <input type="text" name="test" id="test" value="<?php echo $_GET['test'] ?? ''; ?>">

    <button type="submit">Filtrar</button>
    <button type="button" onclick="guardarEnLocalStorage()">Guardar en Local Storage</button>
    <button type="button" onclick="limpiarFiltros()">Limpiar Filtros</button>
</form>

<script>
function limpiarFiltros() {
    document.getElementById("fecha_entrega").value = "";
    document.getElementById("test").value = "";
    window.location.href = "/admin/produccion/materia/corrugador/cartonera/index"; // Recarga la página sin parámetros
}

function guardarEnLocalStorage() {
    let pedidos = [];
    let filas = document.querySelectorAll(".table__tbody .table__tr");

    filas.forEach(fila => {
        let pedido = {
            id: fila.children[0].innerText,
            nombre_pedido: fila.children[1].innerText,
            cantidad: fila.children[2].innerText,
            largo: fila.children[3].innerText,
            ancho: fila.children[4].innerText,
            alto: fila.children[5].innerText,
            flauta: fila.children[6].innerText,
            test: fila.children[7].innerText,
            fecha_ingreso: fila.children[8].innerText,
            fecha_entrega: fila.children[9].innerText
        };
        pedidos.push(pedido);
    });

    localStorage.setItem("pedidosFiltrados", JSON.stringify(pedidos));
    alert("Los datos filtrados se han guardado en Local Storage.");
}
</script>


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

<!-- pagina siguiente  -->
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/produccion/materia/corrugador/cartonera/pedidoseleccionados?page=<?php echo $paginacion->pagina_siguiente(); ?>">
        <i class="fa-regular fa-eye"></i>
        SIGUIENTE
    </a>
</div>






<?php echo $paginacion; ?>