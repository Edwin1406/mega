<script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
  <style>
      h1 {
      color: #007bff;
    }
  
#scanner img, #scanner video {
    width: 100%;
    height: auto;
    margin-top: 10rem;
    border-radius: 1rem;
    
} 
.contenedor {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    #status {
      font-weight: bold;
      margin: 10px 0;
      font-size: 2rem;
    }
    #notificacion {
      position: fixed;
      bottom: -100px; /* Oculta la notificación inicialmente */
      left: 50%;
      transform: translateX(-50%);
      background-color: #007bff;
      color: white;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      font-size: 16px;
      z-index: 1000;
      transition: bottom 0.5s ease-in-out;
    }
    #notificacion.mostrar {
      bottom: 20px; /* Muestra la notificación */
    }
  </style>

<h1 class="dashboard__heading"> <?php echo $titulo ?> </h1>


<div class="contenedor">
    <div id="scanner">
        <p id="status">Escaneando...</p>

    </div>
    <p>Escanea el código de barras de un producto para buscarlo en la base de datos.</p>
    <div id="notificacion"></div>
</div>


  <script>
    const apiUrl = "https://megawebsistem.com/admin/api/ApiMateriaPrima"; // URL de la API
    let ultimaDeteccion = {}; // Almacena la última detección de códigos
    const bloqueoTiempo = 2000; // Tiempo de espera en milisegundos

    // Mostrar notificación en la parte inferior
    function mostrarNotificacion(mensaje) {
        const notificacion = document.getElementById("notificacion");
        notificacion.textContent = mensaje;
        notificacion.classList.add("mostrar");

        // Ocultar la notificación después de 3 segundos
        setTimeout(() => {
            notificacion.classList.remove("mostrar");
        }, 3000);
    }

    // Inicializar el escáner
    function iniciarEscaner() {
        Quagga.init(
            {
                inputStream: {
                    type: "LiveStream",
                    target: document.querySelector("#scanner"),
                    constraints: {
                        facingMode: "environment",
                        width: 400,
                        height: 250,
                    },
                },
                decoder: { readers: ["code_128_reader"] },
            },
            function (err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            }
        );

        Quagga.onDetected((data) => {
            const codigoEscaneado = data.codeResult.code;
            const ahora = new Date().getTime();

            // Verificar si el código fue detectado recientemente
            if (ultimaDeteccion[codigoEscaneado] && ahora - ultimaDeteccion[codigoEscaneado] < bloqueoTiempo) {
                return; // Ignorar detección duplicada
            }

            ultimaDeteccion[codigoEscaneado] = ahora; // Actualizar tiempo de detección
            console.log("Código detectado:", codigoEscaneado);
            buscarProducto(codigoEscaneado);
        });
    }

    // Buscar producto en la API
    async function buscarProducto(codigo) {
        const status = document.getElementById("status");
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) throw new Error("Error al cargar la API");
            const productos = await response.json();

            // Buscar el producto que coincide con el código de barras
            const producto = productos.find((p) => p.barcode === codigo);

            if (producto) {
                status.textContent = `Producto ${codigo} encontrado. Redirigiendo...`;
                status.style.color = "#28a745";

                // Mostrar notificación
                mostrarNotificacion(`Producto encontrado: Redirigiendo al ID ${producto.id}`);

                // Redirigir a la URL con el ID del producto después de 3 segundos
                setTimeout(() => {
                    window.open(`https://megawebsistem.com/admin/produccion/materia/editar?id=${producto.id}`, '_blank');
                }, 3000);

            } else {
                status.textContent = `Código ${codigo} no encontrado en la base de datos.`;
                status.style.color = "#dc3545";

                // Mostrar notificación
                mostrarNotificacion(`Código ${codigo} no encontrado.`);
            }
        } catch (error) {
            console.error("Error al buscar el producto:", error);
            status.textContent = "Error al buscar el producto.";
            status.style.color = "#dc3545";

            // Mostrar notificación
            mostrarNotificacion("Error al buscar el producto.");
        }
    }

    // Iniciar el escáner
    iniciarEscaner();
</script>
