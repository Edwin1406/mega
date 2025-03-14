<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">INGRESO DE INSUMOS DE SISTEMAS  </legend>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_producto">Producto</label>
        <select
            name="id_producto"
            id="id_producto"
            class="formulario__input">
            <option value="">-- Seleccione --</option>
            <?php foreach ($productos_inventario as $producto) : ?>
                <option value="<?php echo $producto->id_producto; ?>"
                    data-area="<?php echo $producto->id_area; ?>"
                    data-categoria="<?php echo $producto->id_categoria; ?>"
                    data-costounitario="<?php echo $producto->costo_unitario; ?>">
                    <?php echo htmlspecialchars($producto->nombre_producto); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Selección de categoría y área, y mostrar el costo unitario -->
    <div class="formulario__campo">
        <label class="formulario__label" for="id_categoria">Categoria</label>
        <select
            name="id_categoria"
            id="id_categoria"
            class="formulario__input" disabled>
            <option value="">-- Seleccione --</option>
            <?php foreach ($categoria_inventario as $categoria) : ?>
                <option value="<?php echo $categoria->id_categoria ?>"><?php echo $categoria->nombre_categoria ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="id_area">Area</label>
        <select
            name="id_area"
            id="id_area"
            class="formulario__input" disabled>
            <option value="">-- Seleccione --</option>
            <?php foreach ($area_inventario as $area) : ?>
                <option value="<?php echo $area->id_area ?>"><?php echo $area->nombre_area ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="formulario__campo" >
        <label class="formulario__label" for="costo_unitario">Costo Unitario</label>
        <input
            type="number"
            name="costo_unitario"
            id="costo_unitario"
            class="formulario__input"
            placeholder="Costo Unitario"
            value=""disabled>
    </div>


    <style>

    .formulario__tabla {
        width: 100%;
        border-collapse: collapse;
    }

    .formulario__tabla th,
    .formulario__tabla td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        width: 100px;
    
    }


    button, input, optgroup, select, textarea {
    font-family: inherit;
    font-size: 100%;
    line-height: 1.15;
    margin: 0;
    width: 100%;
}

    </style>

    <!-- Tabla para mostrar productos seleccionados -->
    <table id="productos_agregados" class="formulario__tabla">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Area</th>
                <th>Costo Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas se agregarán dinámicamente aquí -->
        </tbody>
    </table>
</fieldset>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productoSelect = document.getElementById("id_producto");
    const areaSelect = document.getElementById("id_area");
    const categoriaSelect = document.getElementById("id_categoria");
    const stockInput = document.getElementById("costo_unitario");
    const tablaProductos = document.getElementById("productos_agregados").getElementsByTagName("tbody")[0];
   

    // Cargar productos desde el localStorage al cargar la página
    cargarProductosDesdeLocalStorage();

    productoSelect.addEventListener("change", function() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const id_area = selectedOption.getAttribute("data-area");
        const id_categoria = selectedOption.getAttribute("data-categoria");
        const stock = selectedOption.getAttribute("data-costounitario");
        const producto = selectedOption.textContent;

        if (!producto || !id_area || !id_categoria || !stock) {
            return; // Si no hay datos válidos, no agregamos la fila
        }

        // Asignar los valores al formulario
        if (id_area) {
            for (let i = 0; i < areaSelect.options.length; i++) {
                if (areaSelect.options[i].value === id_area) {
                    areaSelect.selectedIndex = i;
                    break;
                }
            }
        }

        if (id_categoria) {
            for (let i = 0; i < categoriaSelect.options.length; i++) {
                if (categoriaSelect.options[i].value === id_categoria) {
                    categoriaSelect.selectedIndex = i;
                    break;
                }
            }
        }

        if (stock) {
            stockInput.value = stock; // Actualizar el costo unitario
        }

        // Verificar si el producto ya existe en la tabla
        const filas = tablaProductos.getElementsByTagName("tr");
        let productoExistente = null;
        for (let i = 0; i < filas.length; i++) {
            const celdas = filas[i].getElementsByTagName("td");
            if (celdas[0].textContent.trim() === producto) {
                productoExistente = filas[i]; // Si encontramos el producto, lo guardamos
                break;
            }
        }

        if (productoExistente) {
            // Si el producto ya existe, solo actualizamos la cantidad y el total
            const cantidadInput = productoExistente.querySelector('.cantidad');
            const totalCell = productoExistente.querySelector('.total');
            let cantidad = parseInt(cantidadInput.value, 10);
            cantidad++;
            cantidadInput.value = cantidad; // Actualizar cantidad
            const total = cantidad * parseFloat(stock);
            totalCell.textContent = total.toFixed(2); // Actualizar total
            actualizarProductosEnLocalStorage(); // Actualiza en localStorage
        } else {
            // Si el producto no existe, agregamos una nueva fila
            const nuevaFila = tablaProductos.insertRow();
            nuevaFila.innerHTML = `
                <td>${producto}</td>
                <td>${categoriaSelect.options[categoriaSelect.selectedIndex].text}</td>
                <td>${areaSelect.options[areaSelect.selectedIndex].text}</td>
                <td>${stock}</td>
                <td><input type="number" class="cantidad" value="1" min="1" /></td>
                <td class="total">${stock}</td>
                <td><button class="eliminar">Eliminar</button></td>
            `;

            // Función para actualizar el total
            const cantidadInput = nuevaFila.querySelector('.cantidad');
            const totalCell = nuevaFila.querySelector('.total');
            cantidadInput.addEventListener('input', function() {
                const cantidad = parseInt(cantidadInput.value, 10);
                if (!isNaN(cantidad)) {
                    const total = cantidad * parseFloat(stock);
                    totalCell.textContent = total.toFixed(2);
                    actualizarTotalGeneral(); // Actualiza el total general
                    actualizarProductosEnLocalStorage(); // Actualiza en localStorage
                }
            });

            // Función para eliminar la fila
            const eliminarBtn = nuevaFila.querySelector('.eliminar');
            eliminarBtn.addEventListener('click', function() {
                // Eliminar solo la fila actual
                nuevaFila.remove();
                actualizarTotalGeneral(); // Actualiza el total general después de eliminar
                actualizarProductosEnLocalStorage(); // Actualiza en localStorage
            });

            // Actualiza los productos en localStorage
            actualizarProductosEnLocalStorage();
        }

        // Actualiza el total general
        actualizarTotalGeneral();
    });

    // Función para actualizar el total general
    function actualizarTotalGeneral() {
        let totalGeneral = 0;
        const filas = tablaProductos.getElementsByTagName("tr");
        for (let i = 0; i < filas.length; i++) {
            const totalCell = filas[i].cells[5]; // Columna de total
            if (totalCell) {
                totalGeneral += parseFloat(totalCell.textContent) || 0;
            }
        }
        document.getElementById("total_general").textContent = `Total: $${totalGeneral.toFixed(2)}`;
    }

    // Función para guardar los productos en localStorage
    function actualizarProductosEnLocalStorage() {
        const productos = [];
        const filas = tablaProductos.getElementsByTagName("tr");
        for (let i = 0; i < filas.length; i++) {
            const celdas = filas[i].getElementsByTagName("td");
            const producto = celdas[0].textContent.trim();
            const categoria = celdas[1].textContent.trim();
            const area = celdas[2].textContent.trim();
            const costoUnitario = parseFloat(celdas[3].textContent.trim());
            const cantidad = parseInt(celdas[4].querySelector('.cantidad').value, 10);
            const total = parseFloat(celdas[5].textContent.trim());
            productos.push({ producto, categoria, area, costoUnitario, cantidad, total });
        }
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    // Función para cargar los productos desde localStorage
    function cargarProductosDesdeLocalStorage() {
        const productosGuardados = JSON.parse(localStorage.getItem('productos'));
        if (productosGuardados) {
            productosGuardados.forEach(producto => {
                const nuevaFila = tablaProductos.insertRow();
                nuevaFila.innerHTML = `
                    <td>${producto.producto}</td>
                    <td>${producto.categoria}</td>
                    <td>${producto.area}</td>
                    <td>${producto.costoUnitario}</td>
                    <td><input type="number" class="cantidad" value="${producto.cantidad}" min="1" /></td>
                    <td class="total">${producto.total}</td>
                    <td><button class="eliminar">Eliminar</button></td>
                `;
                // Actualizamos el total y cantidad en cada fila
                const cantidadInput = nuevaFila.querySelector('.cantidad');
                const totalCell = nuevaFila.querySelector('.total');
                cantidadInput.addEventListener('input', function() {
                    const cantidad = parseInt(cantidadInput.value, 10);
                    if (!isNaN(cantidad)) {
                        const total = cantidad * producto.costoUnitario;
                        totalCell.textContent = total.toFixed(2);
                        actualizarTotalGeneral(); // Actualiza el total general
                        actualizarProductosEnLocalStorage(); // Actualiza en localStorage
                    }
                });

                // Función para eliminar la fila
                const eliminarBtn = nuevaFila.querySelector('.eliminar');
                eliminarBtn.addEventListener('click', function() {
                    nuevaFila.remove();
                    actualizarTotalGeneral(); // Actualiza el total general después de eliminar
                    actualizarProductosEnLocalStorage(); // Actualiza en localStorage
                });
            });
            // Actualizamos el total general
            actualizarTotalGeneral();
        }
    }

    // Ejecutar la función al cargar la página para seleccionar automáticamente el producto y su stock
    productoSelect.dispatchEvent(new Event("change"));







});


crearSolicitud();
async function crearSolicitud() {
    // tarer lso datos de localStorage y poder mandar en formdata
    const productos = JSON.parse(localStorage.getItem('productos'));
    console.log(productos);

    const datos = new FormData();
    datos.append('productos', JSON.stringify(productos));

    try {
        const url = 'https://megawebsistem.com/admin/sistemas/solicitudes/solicitud';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();
        console.log(respuesta);

        
    } catch (error) {
        console.log(error);
    }

}


</script>
<p id="total_general">Total: $0.00</p>
