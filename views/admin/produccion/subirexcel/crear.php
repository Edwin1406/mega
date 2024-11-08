<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__formulario">

<form method="POST" action="/admin/produccion/subirexcel/crear"  class="formulario" enctype="multipart/form-data">
    <label for="file">Subir archivo Excel:</label>
    <input type="file" name="file" id="file" accept=".xlsx, .xls">
    <input type="submit" name="submit" value="Subir">
</form>
</div>


<div class="excel" id="productos-lista"></div>

<style>
    .excel {
        margin-top: 20px;
    }

    .excel h2 {
        margin-bottom: 10px;
    }

    .excel p {
        margin: 0;
    }
</style>

<script>
     async function productos() {
            try {
                const url = `${location.origin}/admin/api/productos`;
                const resultado = await fetch(url);
                const apibobinas = await resultado.json();

                // Agrupar los productos por mes y año
                const productosPorMes = apibobinas.reduce((acc, producto) => {
                    const cantidad = parseInt(producto.cantidad, 10);
                    const fecha = new Date(producto.fecha);

                    // Extraer el mes y el año de la fecha
                    const mesAño = `${fecha.getMonth() + 1}-${fecha.getFullYear()}`;

                    // Si el mes no existe en el acumulador, lo agregamos
                    if (!acc[mesAño]) {
                        acc[mesAño] = {};
                    }

                    // Si el producto ya existe en ese mes, sumamos la cantidad
                    if (acc[mesAño][producto.nombre]) {
                        acc[mesAño][producto.nombre] += cantidad;
                    } else {
                        acc[mesAño][producto.nombre] = cantidad;
                    }

                    return acc;
                }, {});

                // Mostrar los productos agrupados por mes
                const listaProductos = document.getElementById('productos-lista');
                listaProductos.innerHTML = ''; // Limpiar el contenido actual

                // Recorrer el objeto agrupado por mes
                for (const mesAño in productosPorMes) {
                    const productosEnMes = productosPorMes[mesAño];
                    
                    // Crear un encabezado para el mes y año
                    const [mes, año] = mesAño.split('-');
                    const nombreMes = new Date(`${año}-${mes}-01`).toLocaleString('es-ES', { month: 'long' });
                    const mesHTML = `<h2>${nombreMes} ${año}</h2>`;
                    listaProductos.innerHTML += mesHTML;

                    // Recorrer los productos y mostrar la cantidad sumada
                    for (const nombre in productosEnMes) {
                        const cantidad = productosEnMes[nombre];
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


</script>