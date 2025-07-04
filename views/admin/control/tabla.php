<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>




<form method="GET" style="margin-bottom: 20px;">
  <label>Fecha inicio:
    <input type="date" name="fecha_inicio" value="<?= $_GET['fecha_inicio'] ?? '' ?>">
  </label>

  <label>Fecha fin:
    <input type="date" name="fecha_fin" value="<?= $_GET['fecha_fin'] ?? '' ?>">
  </label>

  <label>Operador:
    <input type="text" name="operador" placeholder="Ej: Carlos Govea" value="<?= $_GET['operador'] ?? '' ?>">
  </label>

  <button type="submit">Filtrar</button>
  <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>"><button type="button">Limpiar</button></a>
</form>


<?php
// Paso 0: Leer filtros del formulario
$fecha_inicio = $_GET['fecha_inicio'] ?? null;
$fecha_fin = $_GET['fecha_fin'] ?? null;
$operador_filtro = $_GET['operador'] ?? null;

// Paso 1: Consumir la API
$apiUrl = "https://megawebsistem.com/admin/api/apicontroldeproduccion";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// Paso 2: Agrupar por operador, aplicando filtros
$resumen = [];

foreach ($data as $registro) {
    $fecha_registro = $registro['fecha'];

    // Filtro por fecha inicio y fin
    if ($fecha_inicio && $fecha_registro < $fecha_inicio) continue;
    if ($fecha_fin && $fecha_registro > $fecha_fin) continue;

    // Filtro por operador
    if ($operador_filtro && stripos($registro['operador'], $operador_filtro) === false) continue;

    $operador = $registro['operador'];

    if (!isset($resumen[$operador])) {
        $resumen[$operador] = [
            'separadores' => 0,
            'golpes' => 0,
            'horas' => 0,
            'cambios' => 0,
            'cajas' => 0,
            'papel' => 0,
            'desperdicio' => 0
        ];
    }

    $resumen[$operador]['separadores'] += (int)$registro['cantidad_separadores'];
    $resumen[$operador]['golpes'] += (int)$registro['golpes_maquina'];
    $resumen[$operador]['horas'] += strtotime($registro['horas_programadas']) - strtotime("00:00:00");
    $resumen[$operador]['cambios'] += (int)$registro['cambios_medida'];
    $resumen[$operador]['cajas'] += (int)$registro['cantidad_cajas'];
    $resumen[$operador]['papel'] += (int)$registro['cantidad_papel'];
    $resumen[$operador]['desperdicio'] += (int)$registro['desperdicio_kg'];
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resumen de Producción</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            text-align: center;
        }

        th {
            background-color: #f0ad4e;
        }
    </style>
</head>

<body>
    <h2>Resumen por Operador</h2>
    <div class="dashboard__contenedor">


        <table>
            <thead>
                <tr>
                    <th>Operador</th>
                    <th>Total Golpes</th>
                    <th>Total Cambios</th>
                    <th>Total Separadores</th>
                    <th>Total Cajas</th>
                    <th>Total Papel</th>
                    <th>Total Desperdicio (kg)</th>
                    <th>Horas Trabajadas</th>
                    <th>Golpes/Hora</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <?php foreach ($resumen as $operador => $valores):
                    $horas = $valores['horas'] / 3600;
                    $golpesHora = $horas > 0 ? round($valores['golpes'] / $horas, 2) : 0;
                ?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?= $operador ?></td>
                        <td class="tables__td"><?= $valores['golpes'] ?></td>
                        <td class="tables__td"><?= $valores['cambios'] ?></td>
                        <td class="tables__td"><?= $valores['separadores'] ?></td>
                        <td class="tables__td"><?= $valores['cajas'] ?></td>
                        <td class="tables__td"><?= $valores['papel'] ?></td>
                        <td class="tables__td"><?= $valores['desperdicio'] ?></td>
                        <td class="tables__td"><?= round($horas, 2) ?></td>
                        <td class="tables__td"><?= $golpesHora ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?php
    // Preparar arrays para Chart.js
    $labels = ['Separadores (UND)', 'Golpes', 'Golpes por Hora'];
    $datasets = [];

    foreach ($resumen as $operador => $valores) {
        $horas = $valores['horas'] / 3600;
        $golpesHora = $horas > 0 ? round($valores['golpes'] / $horas, 2) : 0;

        $datasets[] = [
            'label' => $operador . " / " . $golpesHora . " G/H",
            'data' => [
                $valores['separadores'],
                $valores['golpes'],
                $golpesHora
            ]
        ];
    }
    ?>




    <style>
        .grafico_control_produccion {
            max-width: 600px;
            width: 100%;
            height: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .titulo_grafico {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>




    <h2 class="titulo_grafico">Gráfico: Separadores / Golpes / Golpes por Hora</h2>

    <div class="grafico_control_produccion">

        <canvas id="graficoResumen" width="200px" height="200px"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('graficoResumen').getContext('2d');

        const data = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: <?php echo json_encode($datasets); ?>
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'SEPARADORES / GOLPES / GOLPES HORA'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>