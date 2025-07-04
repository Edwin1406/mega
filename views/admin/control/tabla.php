<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/comercial/crear">
        <i class="fa-solid fa-circle-arrow-left"></i>
        REGRESAR A INICIO
    </a>
</div>

<!-- Campo de búsqueda -->
<div class="dashboard__contenedor" 
    style="
        margin-bottom: 15px; 
        padding: 20px; 
        border-radius: 10px; 
        border: 1px solid #ddd; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
        transition: all 0.3s ease-in-out;
    ">
    <input 
        type="text" 
        id="filtros_ventas" 
        class="dashboard__input" 
        placeholder="Filtrar por nombre cliente o nombre producto"
        style="
            margin-bottom: 0; 
            padding: 12px 15px; 
            width: 100%; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 8px; 
            outline: none; 
            font-size: 16px; 
            background-color: #f9f9f9; 
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1); 
            transition: all 0.2s ease-in-out;
        "
        onfocus="this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.5)'; this.style.borderColor='#007bff';"
        onblur="this.style.boxShadow='inset 0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.borderColor='#ccc';"
    >
</div>
<form method="GET" action="/admin/comercial/tabla">
    <input type="hidden" name="page" value="1">
    <label for="per_page">Registros por página:</label>
    <select name="per_page" id="per_page" onchange="this.form.submit()">
        <option value="10" <?php echo ($_GET['per_page'] ?? '10') == '10' ? 'selected' : ''; ?>>10</option>
        <option value="25" <?php echo ($_GET['per_page'] ?? '') == '25' ? 'selected' : ''; ?>>25</option>
        <option value="50" <?php echo ($_GET['per_page'] ?? '') == '50' ? 'selected' : ''; ?>>50</option>
        <option value="all" <?php echo ($_GET['per_page'] ?? '') == 'all' ? 'selected' : ''; ?>>Todos</option>
    </select>
</form>



<div class="dashboard__contenedor">
    <?php if (!empty($control)): ?>
        <table class="tables" id="tabla">
            <thead class="tables__thead">
                <tr>
                    <th scope="col" class="tables__th">Nro.</th>
                    <th scope="col" class="tables__th">Fecha</th>
                    <th scope="col" class="tables__th">Turno</th>
                    <th scope="col" class="tables__th">Area</th>
                    <th scope="col" class="tables__th">Operador</th>
                    <th scope="col" class="tables__th">Horas programadas</th>
                    <th scope="col" class="tables__th">Golpes maquina</th>
                    <th scope="col" class="tables__th">Golpes maquina hora</th>
                    <th scope="col" class="tables__th">Cambios medida</th>
                    <th scope="col" class="tables__th">Cantidad de separadores</th>
                    <th scope="col" class="tables__th">Cantidad cajas </th>
                    <th scope="col" class="tables__th">Cantidad papel</th>
                    <th scope="col" class="tables__th">Desperdicio kg</th>
                </tr>
            </thead>
            <tbody class="tables__tbody">
                <?php foreach ($control as $controles):?>
                    <tr class="tables__tr">
                        <td class="tables__td"><?php echo $controles->id?></td>
                        <td class="tables__td"><?php echo $controles->fecha?></td>
                        <td class="tables__td"><?php echo $controles->turnos?></td>
                        <td class="tables__td"><?php echo $controles->area?></td>
                        <td class="tables__td"><?php echo $controles->operador?></td>
                        <td class="tables__td"><?php echo $controles->horas_programadas?></td>
                        <td class="tables__td"><?php echo $controles->golpes_maquina?></td>
                        <td class="tables__td"><?php echo $controles->golpes_maquina_hora?></td>
                        <td class="tables__td"><?php echo $controles->cambios_medida?></td>
                        <td class="tables__td"><?php echo $controles->cantidad_separadores?></td>
                        <td class="tables__td"><?php echo $controles->cantidad_cajas?></td>
                        <td class="tables__td"><?php echo $controles->cantidad_papel?></td>
                        <td class="tables__td"><?php echo $controles->desperdicio_kg?></td> 
                        <!-- <td  class="tables__td--acciones"><a class="tables__accion tables__accion--editar" href="/admin/comercial/pdfquejas?id=<?php echo $comerciales->id; ?>"><i class="fa-solid fa-file-pdf"></i>VER</a> -->

                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <a class="text-center"> No hay orden Aún</a>
    <?php endif; ?>
</div>



<?php echo $paginacion; ?>







<?php
// Paso 1: Consumir la API
$apiUrl = "https://megawebsistem.com/admin/api/apicontroldeproduccion";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// Paso 2: Agrupar por operador
$resumen = [];

foreach ($data as $registro) {
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
    $resumen[$operador]['horas'] += strtotime($registro['horas_programadas']) - strtotime("00:00:00"); // en segundos
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
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: center; }
        th { background-color: #f0ad4e; }
    </style>
</head>
<body>
    <h2>Resumen por Operador</h2>
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
        <tbody>
        <?php foreach ($resumen as $operador => $valores): 
            $horas = $valores['horas'] / 3600;
            $golpesHora = $horas > 0 ? round($valores['golpes'] / $horas, 2) : 0;
        ?>
            <tr>
                <td><?= $operador ?></td>
                <td><?= $valores['golpes'] ?></td>
                <td><?= $valores['cambios'] ?></td>
                <td><?= $valores['separadores'] ?></td>
                <td><?= $valores['cajas'] ?></td>
                <td><?= $valores['papel'] ?></td>
                <td><?= $valores['desperdicio'] ?></td>
                <td><?= round($horas, 2) ?></td>
                <td><?= $golpesHora ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>



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

.grafico_control_produccion{
    width: 100%;
    height: 400px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}


</style>




    <h2>Gráfico: Separadores / Golpes / Golpes por Hora</h2>

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
