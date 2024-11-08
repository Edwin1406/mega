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

                // Agrupar y sumar cantidades de productos repetidos
                const productosSumados = apibobinas.reduce((acc, producto) => {
                    const cantidad = parseInt(producto.cantidad, 10);

                    if (acc[producto.nombre]) {
                        acc[producto.nombre] += cantidad;
                    } else {
                        acc[producto.nombre] = cantidad;
                    }
                    return acc;
                }, {});

                // Mostrar los productos sumados en el HTML
                const listaProductos = document.getElementById('productos-lista');
                listaProductos.innerHTML = ''; // Limpiar el contenido actual

                // Recorrer el objeto y agregarlo al HTML
                for (const nombre in productosSumados) {
                    const cantidad = productosSumados[nombre];
                    const productoHTML = `<p>${nombre}: ${cantidad}</p>`;
                    listaProductos.innerHTML += productoHTML;
                }
            } catch (e) {
                console.log(e);
            }
        }

        // Llamar a la función para cargar los productos
        productos();


</script>