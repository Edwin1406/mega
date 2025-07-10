<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>



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
<form method="GET" action="/admin/vendedor/cliente/cotizador">
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
    <?php if (!empty($visor)): ?>
        <table class="table" id="tabla">
            <thead class="table__thead">
                <tr>
                <th scope="col" class="table__th">Nombre Cliente</th>
                    <th scope="col" class="table__th">Proveedor</th>
                    <th scope="col" class="table__th">Nombre Producto</th>
                    <th scope="col" class="table__th">Codigo producto</th>
                    <th scope="col" class="table__th">Estado</th>
                    <th scope="col" class="table__th">Archivo PDF</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($visor as $maquina):?>
                    <tr class="table__tr">
                        <td class="table__td"><?php echo $maquina->nombre_cliente?></td>
                        <td class="table__td"><?php echo $visores->proveedor?></td>
                        <td class="table__td"><?php echo $maquina->nombre_producto?></td>
                        <td class="table__td"><?php echo $maquina->codigo_producto?></td>
                        <td data-id="<?php echo $maquina->id; ?>" class="table__td" style="color: 
                            <?php 
                                echo ($maquina->estado == 'ENVIADO') ? 'green' : 
                                    (($maquina->estado == 'PAUSADO') ? 'red' : 
                                    (($maquina->estado == 'TERMINADO') ? 'orange' :''));
                                    ?>;">
                                <?php echo $maquina->estado; ?>
                        </td>
                        <td class="table__td">
                            <?php 
                            $rutaArchivo = "/src/visor/" . htmlspecialchars($maquina->pdf);
                            $extension = pathinfo($maquina->pdf, PATHINFO_EXTENSION);

                            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <!-- Mostrar miniatura para imágenes -->
                                <img 
                                    src="<?php echo $rutaArchivo ?>" 
                                    alt="pdf" 
                                    class="imagen-miniatura" 
                                    style="width: 100px; height: auto; cursor: pointer;" 
                                    onclick="mostrarImagen(this.src)">
                            <?php elseif (strtolower($extension) === 'pdf'): ?>
                                <!-- Mostrar enlace para visualizar PDF -->
                                <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>
                                <?php else: ?>
                                    <a href="<?php echo $rutaArchivo ?>" target="_blank" class="enlace-pdf">Ver PDF</a>

                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay visor Aún</a>
    <?php endif; ?>
</div>




<?php echo $paginacion; ?>
