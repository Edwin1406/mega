<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

<form method="POST" action="/admin/produccion/subirexcel/crear"  class="formulario" enctype="multipart/form-data">
    <label for="file">Subir archivo Excel:</label>
    <input type="file" name="file" id="file" accept=".xlsx, .xls">
    <input type="submit" name="submit" value="Subir">
</form>
</div>


<div id="productos-lista"></div>



<script>
    async function productos() {
            try {
                const url = `${location.origin}/admin/api/productos`;
                const resultado = await fetch(url);
                const apibobinas = await resultado.json();

                // Agrupar los productos primero por fecha y luego por nombre
                const productosPorFecha = apibobinas.reduce((acc, producto) => {
                    const cantidad = parseInt(producto.cantidad, 10);
                    const fecha = producto.fecha;

                    // Si la fecha no existe en el acumulador, la agregamos
                    if (!acc[fecha]) {
                        acc[fecha] = {};
                    }

                    // Si el producto ya existe en esa fecha, sumamos la cantidad
                    if (acc[fecha][producto.nombre]) {
                        acc[fecha][producto.nombre] += cantidad;
                    } else {
                        acc[fecha][producto.nombre] = cantidad;
                    }

                    return acc;
                }, {});

                // Mostrar los productos agrupados por fecha
                const listaProductos = document.getElementById('productos-lista');
                listaProductos.innerHTML = ''; // Limpiar el contenido actual

                // Recorrer el objeto agrupado por fecha
                for (const fecha in productosPorFecha) {
                    const productosEnFecha = productosPorFecha[fecha];
                    
                    // Crear un encabezado para la fecha
                    const fechaHTML = `<h2>Fecha: ${fecha}</h2>`;
                    listaProductos.innerHTML += fechaHTML;

                    // Recorrer los productos y mostrar la cantidad sumada
                    for (const nombre in productosEnFecha) {
                        const cantidad = productosEnFecha[nombre];
                        const productoHTML = `<p>${nombre}: ${cantidad}</p>`;
                        listaProductos.innerHTML += productoHTML;
                    }
                }
            } catch (e) {
                console.log(e);
            }
        }

        // Llamar a la función para cargar los productos
        productos();

        // Llamar a la función para cargar los productos
        productos();


</script>