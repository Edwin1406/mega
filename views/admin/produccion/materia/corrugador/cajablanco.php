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
















<div id="contenedorTarjetas">
    <!-- Las tarjetas se generan dinámicamente -->
</div>

<script>
    function generarTarjetas(datos) {
        const contenedor = document.getElementById('contenedorTarjetas');
        contenedor.innerHTML = ''; // Limpia las tarjetas previas
        datos.forEach(dato => {
            const tarjeta = `
                <div class="tarjeta">
                    <h3>${dato.gramaje} gm</h3>
                    <p>Ancho: ${dato.ancho}</p>
                    <p>Existencia: ${dato.existencia}</p>
                </div>
            `;
            contenedor.innerHTML += tarjeta;
        });
    }

    // Simula datos cargados desde una API
    const datos = [
        { gramaje: 45, ancho: 58, existencia: 200 },
        { gramaje: 150, ancho: 107, existencia: 100 },
        { gramaje: 175, ancho: 110, existencia: 1184 }
    ];
    generarTarjetas(datos);
</script>

<style>
    .tarjeta {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
</style>
