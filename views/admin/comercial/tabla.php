<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/vendedor/cliente/crear">
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
    <?php if (!empty($comercial)): ?>
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
                <?php foreach ($comercial as $comerciales):?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?php echo $comerciales->id?></td>
                        <td class="tables__td"><?php echo $comerciales->import?></td>
                        <td class="tables__td"><?php echo $comerciales->proyecto?></td>
                        <td class="tables__td"><?php echo $comerciales->pedido_interno?></td>
                        <td class="tables__td"><?php echo $comerciales->fecha_solicitud?></td>
                        <td class="tables__td"><?php echo $comerciales->puerto_destino?></td>
                        <td class="tables__td"><?php echo $comerciales->trader?></td>
                        <td class="tables__td"><?php echo $comerciales->marca?></td>
                        <td class="tables__td"><?php echo $comerciales->linea?></td>
                        <td class="tables__td"><?php echo $comerciales->producto?></td>
                        <td class="tables__td"><?php echo $comerciales->gms?></td>
                        <td class="tables__td"><?php echo $comerciales->ancho?></td>
                        <td class="tables__td"><?php echo $comerciales->cantidad?></td>
                        <td class="tables__td"><?php echo $comerciales->precio?></td>
                        <td class="tables__td"><?php echo $comerciales->total_item?></td>
                        <td class="tables__td"><?php echo $comerciales->fecha_produccion?></td>
                        <td class="tables__td"><?php echo $comerciales->arribo_planta?></td>
                        <td class="tables__td"><?php echo $comerciales->transito?></td>
                        <td class="tables__td"><?php echo $comerciales->fecha_en_planta?></td>
                        <td class="tables__td"><?php echo $comerciales->estado?></td>
                        <td  class="tables__td--acciones"><a class="tables__accion tables__accion--editar" href="/admin/comercial/editar?id=<?php echo $comerciales->id; ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>


