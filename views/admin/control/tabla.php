<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>



<?php
// Paso 1: Consumir la API una vez
$apiUrl = "https://megawebsistem.com/admin/api/apicontroldeproduccion";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* body { font-family: Arial; background: #d5d9dd; padding: 20px; } */
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            margin-top: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 8px 12px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background: #f4a825;
            color: white;
        }

        input,
        button {
            padding: 5px 10px;
            margin-right: 10px;
        }

        .card {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

            margin-bottom: 20px;
        }
        .normal {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

            margin-bottom: 20px;
        }

        .grafico-container {
            margin-top: 20px;
        }

        canvas {
            max-width: 100%;
        }

        .grafico-container canvas {
            width: 100% !important;
            height: auto !important;
        }

        .card h2,
        .card h3 {
            margin-bottom: 15px;
        }

        .card label {
            display: block;
            margin-bottom: 10px;
        }

        .card input[type="date"],
        .card input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
        }

        .card button {
            margin-right: 10px;
        }
    </style>


    <div class="normal">
        <label>Fecha inicio: <input type="date" id="fecha_inicio"></label>
        <label>Fecha fin: <input type="date" id="fecha_fin"></label>
        <label>Operador: <input type="text" id="operador" placeholder="Ej: Carlos"></label>
        <button onclick="filtrar()">Aplicar filtros</button>
        <button onclick="resetear()">Reset</button>
    </div>

    <div class="card">
        <h2>Tabla de Producción</h2>
        <div id="tabla_contenedor"></div>
    </div>



    <div class="card">
        <h2 style="text-align: center;" >Gráfico: Separadores / Golpes / Golpes por Hora</h2>
        <div class="grafico-container">
            <canvas id="graficoResumen" height="300"></canvas>

        </div>
    </div>

    <script>
        const datosOriginales = <?= json_encode($data) ?>;
        let chart;

        function filtrar() {
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;
            const operadorFiltro = document.getElementById('operador').value.toLowerCase();

            const resumen = {};

            datosOriginales.forEach(registro => {
                const fecha = registro.fecha;
                const operador = registro.operador;

                // Filtros
                if (fechaInicio && fecha < fechaInicio) return;
                if (fechaFin && fecha > fechaFin) return;
                if (operadorFiltro && !operador.toLowerCase().includes(operadorFiltro)) return;

                if (!resumen[operador]) {
                    resumen[operador] = {
                        golpes: 0,
                        cambios: 0,
                        separadores: 0,
                        cajas: 0,
                        papel: 0,
                        desperdicio: 0,
                        horas: 0
                    };
                }

                resumen[operador].golpes += +registro.golpes_maquina;
                resumen[operador].cambios += +registro.cambios_medida;
                resumen[operador].separadores += +registro.cantidad_separadores;
                resumen[operador].cajas += +registro.cantidad_cajas;
                resumen[operador].papel += +registro.cantidad_papel;
                resumen[operador].desperdicio += +registro.desperdicio_kg;
                resumen[operador].horas += tiempoAHoras(registro.horas_programadas);
            });

            renderTabla(resumen);
            renderGrafico(resumen);
        }

        function tiempoAHoras(horaStr) {
            const [h, m, s] = horaStr.split(':').map(Number);
            return h + m / 60 + s / 3600;
        }

        function renderTabla(resumen) {
            let html = '<table><thead><tr><th>Operador</th><th>Total Golpes</th><th>Total Cambios</th><th>Total Separadores</th><th>Total Cajas</th><th>Total Papel</th><th>Total Desperdicio (kg)</th><th>Horas Trabajadas</th><th>Golpes/Hora</th></tr></thead><tbody>';
            for (const operador in resumen) {
                const r = resumen[operador];
                const gph = r.horas > 0 ? (r.golpes / r.horas).toFixed(2) : 0;
                html += `<tr>
          <td>${operador}</td>
          <td>${r.golpes}</td>
          <td>${r.cambios}</td>
          <td>${r.separadores}</td>
          <td>${r.cajas}</td>
          <td>${r.papel}</td>
          <td>${r.desperdicio}</td>
          <td>${r.horas.toFixed(2)}</td>
          <td>${gph}</td>
        </tr>`;
            }
            html += '</tbody></table>';
            document.getElementById('tabla_contenedor').innerHTML = html;
        }

        function renderGrafico(resumen) {
            const labels = ["Separadores (UND)", "Golpes", "Golpes por Hora"];
            const datasets = [];

            for (const operador in resumen) {
                const r = resumen[operador];
                const gph = r.horas > 0 ? (r.golpes / r.horas).toFixed(2) : 0;
                datasets.push({
                    label: `${operador} / ${gph} G/H`,
                    data: [r.separadores, r.golpes, parseFloat(gph)],
                    backgroundColor: randomColor()
                });
            }

            if (chart) chart.destroy();

            const ctx = document.getElementById('graficoResumen').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'SEPARADORES / GOLPES / GOLPES POR HORA'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function randomColor() {
                
            const colors = [
            '#f8cfcf', '#ffe5b4', '#fff3b0', '#d4f4dd', '#cce5ff',
            '#f3d1f4', '#e6f7ff', '#fef6e4', '#e0f7fa', '#f9e2e7',
            '#d0ebff', '#fce1e4', '#fdf1f1', '#f4f4d7', '#eaf6f6',
            '#fde2ff', '#fff5e1', '#e1f0d7', '#f5e1ff', '#f0fff0'
            ];

            return colors[Math.floor(Math.random() * colors.length)];

        }

        function resetear() {
            document.getElementById('fecha_inicio').value = '';
            document.getElementById('fecha_fin').value = '';
            document.getElementById('operador').value = '';
            filtrar();
        }

        // Cargar todo por defecto
        window.onload = filtrar;
    </script>
