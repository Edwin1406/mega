
<?php
require_once('tcpdf_include.php'); // Asegúrate de que la ruta sea correcta

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MegaStock');
$pdf->SetTitle('Formato de Quejas y Reclamos');
$pdf->SetSubject('Formulario');

// Configuración de márgenes y fuentes
$pdf->SetMargins(10, 20, 10);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 9);

// Agregar una página
$pdf->AddPage();

// Cabecera
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(180, 20);
$pdf->Cell(20, 6, 'QUEJA', 0);
$pdf->Rect(200, 20, 4, 4);
$pdf->SetXY(180, 26);
$pdf->Cell(20, 6, 'RECLAMO', 0);
$pdf->Rect(200, 26, 4, 4);

// ---------------- SECCIÓN 1 ----------------
$pdf->SetFillColor(255, 153, 0);
$pdf->SetXY(10, 35);
$pdf->Cell(15, 6, '1.', 1, 0, 'C', true);
$pdf->Cell(185, 6, 'INFORMACIÓN DEL RECLAMO', 1, 1, 'L', true);

$pdf->MultiCell(200, 6, "Fecha:                      Cliente:\nPedido N°:                     Referencia:              Fecha-Factura:\nNum-Lote:                     Num-Factura:\nDescripción de Producto:\n\nMotivo del reclamo:\n\n\nPersona que genera el reclamo (Cliente):\nCargo o área de la empresa:                                          Teléfono:", 1, 'L');

// ---------------- SECCIÓN 2 ----------------
$pdf->Ln(2);
$pdf->SetFillColor(255, 153, 0);
$pdf->Cell(15, 6, '2.', 1, 0, 'C', true);
$pdf->Cell(185, 6, 'SOLUCIÓN INMEDIATA', 1, 1, 'L', true);

$pdf->MultiCell(200, 6, "Solución inmediata:\n\n\nVENTAS [ ]    DESPACHOS [ ]    PRODUCCIÓN [ ]    Fecha: ____________\nClasificación / Arreglo: SI [ ]  NO [ ]    Buenas: _______  Malas: _______\nReposición: SI [ ]  NO [ ]             Autorizado por:\nGenera Nota Crédito: SI [ ]  NO [ ]   Autorizado por:\nGenera Descuento: SI [ ]  NO [ ]  ___% Autorizado por:\nFecha de la Solución: ___________________     Responsable: ____________", 1, 'L');

// ---------------- SECCIÓN 3 ----------------
$pdf->Ln(2);
$pdf->SetFillColor(255, 153, 0);
$pdf->Cell(15, 6, '3.', 1, 0, 'C', true);
$pdf->Cell(185, 6, 'TRAZABILIDAD', 1, 1, 'L', true);

$pdf->MultiCell(200, 6, "Fecha-Prod: ___________  Máquina: ___________  Operario: ___________\nFecha-Prod: ___________  Máquina: ___________  Operario: ___________\n\nDatos Corrugado:\nMateriales:        ECT\nL. EXT              FCT\nC. MED             PAT\nL. INT              PAT\nANCHO             PESO\n\nDatos Impresión:\nTintas:       Lote:       Control:\nGCMI        _______     _______\nGCMI        _______     _______\nGCMI        _______     _______", 1, 'L');

// ---------------- SECCIÓN 4 ----------------
$pdf->Ln(2);
$pdf->SetFillColor(255, 153, 0);
$pdf->Cell(15, 6, '4.', 1, 0, 'C', true);
$pdf->Cell(185, 6, 'ACCIÓN CORRECTIVA', 1, 1, 'L', true);

$pdf->MultiCell(200, 6, "Causa del problema:\n\n\nAcción correctiva y/o preventiva:\n\n\nFecha de la Acción: ________________     Responsable: __________________\nRecibe el reclamo: __________________     Fecha y hora: ________________", 1, 'L');

// Salida del PDF
$pdf->Output('formato_quejas_reclamos.pdf', 'I');
?>
