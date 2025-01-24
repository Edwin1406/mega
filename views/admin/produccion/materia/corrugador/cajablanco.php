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
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// URL de la API
$apiUrl = "https://megawebsistem.com/admin/api/apicajablanco";

// Obtener datos de la API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Crear nuevo archivo de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados
$sheet->setCellValue('A1', 'Gramaje');
$sheet->setCellValue('B1', 'Ancho');
$sheet->setCellValue('C1', 'Datos');

// Llenar filas con los datos de la API
$row = 2; // Comenzamos en la fila 2
foreach ($data as $tipoCaja => $info) {
    // Título del tipo de caja
    $sheet->mergeCells("A{$row}:C{$row}");
    $sheet->setCellValue("A{$row}", strtoupper($tipoCaja));
    $row++;

    // Detalles (gramajes, anchos y datos)
    foreach ($info['gramajes'] as $index => $gramaje) {
        $sheet->setCellValue("A{$row}", $gramaje);
        $sheet->setCellValue("B{$row}", $info['anchos'][$index]);
        $sheet->setCellValue("C{$row}", $info['data'][$index]);
        $row++;
    }
}

// Ajustar estilo (opcional)
$sheet->getStyle('A1:C1')->getFont()->setBold(true);
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);

// Descargar el archivo Excel
$writer = new Xlsx($spreadsheet);

// Nombre del archivo
$filename = "datos_cajas_" . date('Y-m-d') . ".xlsx";

// Encabezados HTTP para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"{$filename}\"");
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
