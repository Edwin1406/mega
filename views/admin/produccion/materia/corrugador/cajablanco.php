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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Gramajes y Anchos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .gramaje-container {
            display: flex;
            gap: 20px;
        }
        .gramaje-box {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            width: 150px;
        }
        .ancho-select {
            margin-top: 10px;
            width: 100%;
            padding: 5px;
        }
        .btn-ver-info {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-ver-info:hover {
            background-color: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .modal-header {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #333;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <h1>Lista de Gramajes</h1>
    <div class="gramaje-container" id="gramajeContainer">
        <!-- Los gramajes se generarán dinámicamente -->
    </div>

    <!-- Modal -->
    <div class="overlay" id="modalOverlay"></div>
    <div class="modal" id="infoModal">
        <span class="modal-close" id="closeModal">&times;</span>
        <div class="modal-header">Información</div>
        <div id="modalContent">
            <!-- Aquí se mostrará la información -->
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";
    const gramajeContainer = document.getElementById('gramajeContainer');
    const infoModal = document.getElementById('infoModal');
    const modalContent = document.getElementById('modalContent');
    const modalOverlay = document.getElementById('modalOverlay');
    const closeModal = document.getElementById('closeModal');

    // Cargar datos desde la API
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Procesar los datos por categoría
            for (const tipo in data) {
                if (data.hasOwnProperty(tipo)) {
                    const { gramajes, anchos, data: existencias } = data[tipo];

                    // Crear una caja para cada gramaje
                    gramajes.forEach((gramaje, index) => {
                        const gramajeBox = document.createElement('div');
                        gramajeBox.classList.add('gramaje-box');

                        gramajeBox.innerHTML = `
                            <h3>Gramaje ${gramaje}</h3>
                            <select class="ancho-select" data-gramaje="${gramaje}">
                                ${anchos
                                    .filter((_, i) => gramajes[i] === gramaje)
                                    .map(ancho => `<option value="${ancho}">${ancho}</option>`)
                                    .join('')}
                            </select>
                            <button class="btn-ver-info" data-gramaje="${gramaje}">Ver Información</button>
                        `;

                        gramajeContainer.appendChild(gramajeBox);
                    });
                }
            }

            // Agregar evento a los botones de información
            document.querySelectorAll('.btn-ver-info').forEach(button => {
                button.addEventListener('click', function () {
                    const gramaje = this.getAttribute('data-gramaje');
                    const anchoSelect = this.previousElementSibling;
                    const anchoSeleccionado = anchoSelect.value;

                    const existencia = data[tipo].data.find((_, i) => {
                        return data[tipo].gramajes[i] == gramaje && data[tipo].anchos[i] == anchoSeleccionado;
                    });

                    // Mostrar información en el modal
                    modalContent.innerHTML = `
                        <p><strong>Gramaje:</strong> ${gramaje}</p>
                        <p><strong>Ancho:</strong> ${anchoSeleccionado}</p>
                        <p><strong>Existencia:</strong> ${existencia}</p>
                    `;
                    infoModal.style.display = 'block';
                    modalOverlay.style.display = 'block';
                });
            });
        })
        .catch(error => console.error('Error al cargar datos:', error));

    // Cerrar el modal
    closeModal.addEventListener('click', function () {
        infoModal.style.display = 'none';
        modalOverlay.style.display = 'none';
    });

    modalOverlay.addEventListener('click', function () {
        infoModal.style.display = 'none';
        modalOverlay.style.display = 'none';
    });
});

</script>