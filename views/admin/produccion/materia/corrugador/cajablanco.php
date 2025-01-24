<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>
<ul class="lista-areas-produccion">
    <li class="areas-produccion-blanco">
        <a href="#">
            <i class="fas fa-shopping-cart"></i> TOTAL COSTO BLANCO :
            <?php if ($totalCostoB > 0) : ?>
                <span class="areas-produccion__numero"> <?php echo $totalCostoB ?> $ </span>
            <?php endif; ?>
        </a>
    </li>


</ul>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API Data</title>
</head>
<body>
  <h1>Inventario</h1>
  <div id="data-container"></div>

  <script>
    // URL de tu API
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

    // Función para consumir y mostrar los datos
    async function fetchApiData() {
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Selecciona el contenedor
        const container = document.getElementById('data-container');

        // Renderiza los datos en el DOM
        data.forEach(item => {
          const itemElement = document.createElement('div');
          itemElement.innerHTML = `
            <h2>${item.descripcion}</h2>
            <p><strong>Código:</strong> ${item.codigo}</p>
            <p><strong>Existencia:</strong> ${item.existencia}</p>
            <p><strong>Costo:</strong> $${item.costo}</p>
            <p><strong>Proveedor:</strong> ${item.proveedor}</p>
            <hr>
          `;
          container.appendChild(itemElement);
        });
      } catch (error) {
        console.error("Error al obtener los datos:", error);
      }
    }

    // Llama a la función al cargar la página
    fetchApiData();
  </script>
</body>
</html>
