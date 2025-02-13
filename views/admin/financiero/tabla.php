<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda -->
<div class="dashboard__contenedor" 
    style="
        margin-bottom: 15px; 
        padding: 20px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
        transition: all 0.3s ease-in-out;
    ">
    <input 
        type="text" 
        id="filtros_ventas" 
        class="dashboard__input" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        style="
            margin-bottom: 0; 
            padding: 12px 15px; 
            width: 100%; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            outline: none; 
            font-size: 16px; 
            background-color: #f9f9f9; 
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: all 0.2s ease-in-out;
        "
        onfocus="this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)'; this.style.borderColor='#007bff';"
        onblur="this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.borderColor='#ccc';"
    >
</div>
<form method="GET" action="/admin/comercial/tabla">
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
    <?php if (!empty($financiero)): ?>
        <table class="tables" id="tabla">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">Nro.</th>
                    <th scope="col" class="tables__th">Import</th>
                    <th scope="col" class="tables__th">Proyecto</th>
                    <th scope="col" class="tables__th">Pedido Interno</th>
                    <th scope="col" class="tables__th">Fecha Solicitud</th>
                    <th scope="col" class="tables__th">Puerto Destino</th>
                    <th scope="col" class="tables__th">Trader</th>
                    <th scope="col" class="tables__th">Marca</th>
                    <th scope="col" class="tables__th">Linea</th>
                    <th scope="col" class="tables__th">Producto</th>
                    <th scope="col" class="tables__th">GMS</th>
                    <th scope="col" class="tables__th">Ancho</th>
                    <th scope="col" class="tables__th">Cantidad</th>
                    <th scope="col" class="tables__th">Precio</th>
                    <th scope="col" class="tables__th">Total Item</th>
                    <th scope="col" class="tables__th">Fecha Producción</th>
                    <th scope="col" class="tables__th">Arribo Planta</th>
                    <th scope="col" class="tables__th">Transito</th>
                    <th scope="col" class="tables__th">Fecha en Planta</th>
                    <th scope="col" class="tables__th">Estado</th>
                    <th scope="col" class="tables__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <?php foreach ($financiero as $finanzas):?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?php echo $finanzas->id?></td>
                        <td class="tables__td"><?php echo $finanzas->import?></td>
                        <td class="tables__td"><?php echo $finanzas->proyecto?></td>
                        <td class="tables__td"><?php echo $finanzas->pedido_interno?></td>
                        <td class="tables__td"><?php echo $finanzas->fecha_solicitud?></td>
                        <td class="tables__td"><?php echo $finanzas->puerto_destino?></td>
                        <td class="tables__td"><?php echo $finanzas->trader?></td>
                        <td class="tables__td"><?php echo $finanzas->marca?></td>
                        <td class="tables__td"><?php echo $finanzas->linea?></td>
                        <td class="tables__td"><?php echo $finanzas->producto?></td>
                        <td class="tables__td"><?php echo $finanzas->gms?></td>
                        <td class="tables__td"><?php echo $finanzas->ancho?></td>
                        <td class="tables__td"><?php echo $finanzas->cantidad?></td>
                        <td class="tables__td"><?php echo $finanzas->precio?></td>
                        <td class="tables__td"><?php echo $finanzas->total_item?></td>
                        <td class="tables__td"><?php echo $finanzas->fecha_produccion?></td>
                        <td class="tables__td"><?php echo $finanzas->arribo_planta?></td>
                        <td class="tables__td"><?php echo $finanzas->transito?></td>
                        <td class="tables__td"><?php echo $finanzas->fecha_en_planta?></td>
                        <td class="tables__td"><?php echo $finanzas->estado?></td>
                        <td  class="tables__td--acciones"><a class="tables__accion tables__accion--editar" href="/admin/financiero/editar?id=<?php echo $finanzas->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const filtroVentas = document.querySelector('#filtros_ventas');
    if (filtroVentas) {
        filtroVentas.addEventListener('input', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tabla .tables__tr');

            filas.forEach(fila => {
                const id = fila.cells[0].textContent.toLowerCase();
                const importa = fila.cells[1].textContent.toLowerCase();
                const proyecto = fila.cells[2].textContent.toLowerCase();
                const pedidoInterno = fila.cells[3].textContent.toLowerCase();
                const fechaSolicitud = fila.cells[4].textContent.toLowerCase();
                const puertoDestino = fila.cells[5].textContent.toLowerCase();
                const trader = fila.cells[6].textContent.toLowerCase();
                const marca = fila.cells[7].textContent.toLowerCase();
                const linea = fila.cells[8].textContent.toLowerCase();
                const producto = fila.cells[9].textContent.toLowerCase();
                const gms = fila.cells[10].textContent.toLowerCase();
                const ancho = fila.cells[11].textContent.toLowerCase();
                const cantidad = fila.cells[12].textContent.toLowerCase();
                const precio = fila.cells[13].textContent.toLowerCase();
                const totalItem = fila.cells[14].textContent.toLowerCase();
                const fechaProduccion = fila.cells[15].textContent.toLowerCase();
                const arriboPlanta = fila.cells[16].textContent.toLowerCase();
                const transito = fila.cells[17].textContent.toLowerCase();
                const fechaEnPlanta = fila.cells[18].textContent.toLowerCase();
                const estado = fila.cells[19].textContent.toLowerCase();
            
            

                if (
                    id.includes(filtro) || 
                    importa.includes(filtro) ||
                    proyecto.includes(filtro) ||
                    pedidoInterno.includes(filtro) ||   
                    fechaSolicitud.includes(filtro) ||
                    puertoDestino.includes(filtro) ||
                    trader.includes(filtro) ||
                    marca.includes(filtro) ||
                    linea.includes(filtro) ||
                    producto.includes(filtro) ||
                    gms.includes(filtro) ||
                    ancho.includes(filtro) ||
                    cantidad.includes(filtro) ||
                    precio.includes(filtro) ||
                    totalItem.includes(filtro) ||
                    fechaProduccion.includes(filtro) ||
                    arriboPlanta.includes(filtro) ||
                    transito.includes(filtro) ||
                    fechaEnPlanta.includes(filtro) ||
                    estado.includes(filtro)
                    
                ) {
                    fila.style.display = ''; // Mostrar fila
                } else {
                    fila.style.display = 'none'; // Ocultar fila
                }
            });
        });
    }
});



</script>