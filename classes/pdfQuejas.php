<?php
require_once('path/to/tcpdf.php'); // Ajusta ruta

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Hola mundo - prueba PDF', 0, 1);
$pdf->Output('prueba.pdf', 'I');
exit;
