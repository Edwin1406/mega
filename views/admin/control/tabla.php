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
    <?php if (!empty($control)): ?>
        <table class="tables" id="tabla">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">Nro.</th>
                    <th scope="col" class="tables__th">Fecha</th>
                    <th scope="col" class="tables__th">Cliente</th>
                    <th scope="col" class="tables__th">Responsable</th>
                    <th scope="col" class="tables__th">Persona Reporta Reclamo</th>
                    <th scope="col" class="tables__th">N. Factura</th>
                    <th scope="col" class="tables__th">Fecha. Factura</th>
                    <th scope="col" class="tables__th">Descripcion</th>
                    <th scope="col" class="tables__th">Motivo reclamo</th>
                    <th scope="col" class="tables__th">Accion Solicitada</th>
                    <th scope="col" class="tables__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <?php foreach ($control as $controles):?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?php echo $controles->id?></td>
                        <td class="tables__td"><?php echo $controles->fecha?></td>
                        <td class="tables__td"><?php echo $controles->cliente?></td>
                        <td class="tables__td"><?php echo $controles->responsable_reporte?></td>
                        <td class="tables__td"><?php echo $controles->per_reporta_reclamo?></td>
                        <td class="tables__td"><?php echo $comerciales->factura?></td>
                        <td class="tables__td"><?php echo $comerciales->fecha_factura?></td>
                        <td class="tables__td"><?php echo $comerciales->descripcion_producto?></td>
                        <td class="tables__td"><?php echo $comerciales->motivo_reclamo?></td>
                        <td class="tables__td"><?php echo $comerciales->accion_solicitada?></td>
                        <td  class="tables__td--acciones"><a class="tables__accion tables__accion--editar" href="/admin/comercial/pdfquejas?id=<?php echo $comerciales->id; ?>"><i class="fa-solid fa-file-pdf"></i>VER</a>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>