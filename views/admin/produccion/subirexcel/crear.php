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
    productos();
async function productos() {
    try {
        const url = `${location.origin}/admin/api/productos`;
        const resultado = await fetch(url);
        const apibobinas = await resultado.json();

        // Agrupar y sumar cantidades de productos repetidos
        const productosSumados = apibobinas.reduce((acc, producto) => {
            // Convertimos la cantidad a número para poder sumarlo
            const cantidad = parseInt(producto.cantidad, 10);

            // Si ya existe el producto en el acumulador, sumamos la cantidad
            if (acc[producto.nombre]) {
                acc[producto.nombre] += cantidad;
            } else {
                // Si no existe, lo agregamos con la cantidad
                acc[producto.nombre] = cantidad;
            }
            return acc;
        }, {});

        console.log(productosSumados);
    } catch (e) {
        console.log(e);
    }
}


</script>