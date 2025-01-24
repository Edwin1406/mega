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






<?php
// URL de la API
$apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

// Obtener datos de la API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Interactiva</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Tabla Interactiva de Anchos y Gramajes</h1>
    <table id="tablaDatos">
        <thead>
            <tr>
                <th>Gramajes</th>
                <th>Anchos</th>
                <th>Datos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $tipoCaja => $info): ?>
                <tr>
                    <td colspan="3" style="background-color: #ddd; font-weight: bold;"><?php echo $tipoCaja; ?></td>
                </tr>
                <?php foreach ($info['gramajes'] as $index => $gramaje): ?>
                    <tr class="parent-row" data-gramaje="<?php echo $gramaje; ?>">
                        <td><?php echo $gramaje; ?></td>
                        <td><?php echo $info['anchos'][$index]; ?></td>
                        <td><?php echo $info['data'][$index]; ?></td>
                    </tr>
                    <!-- Fila oculta -->
                    <tr class="child-row hidden" data-parent="<?php echo $gramaje; ?>">
                        <td colspan="3">Detalles adicionales para el gramaje <?php echo $gramaje; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $(".parent-row").on("click", function () {
                const gramaje = $(this).data("gramaje");
                $(`.child-row[data-parent="${gramaje}"]`).toggleClass("hidden");
            });
        });
    </script>
</body>
</html>
