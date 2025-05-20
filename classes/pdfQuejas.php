<?php
namespace Classes;

use TCPDF;

class pdfQuejas extends TCPDF
{
    protected $queja;

    public function setQueja($queja)
    {
        $this->queja = $queja;
    }
public function generarPdf()
{
    $this->SetMargins(15, 20, 15);
    $this->AddPage();
    $this->SetAutoPageBreak(true, 20);

    $this->SetFont('helvetica', '', 11);
    $this->SetTextColor(0);

    // Encabezado
    $this->SetFont('helvetica', 'B', 18);
    $this->Cell(50, 15, 'MEGA STOCK', 0, 0, 'L');

    $this->SetFont('helvetica', 'B', 14);
    $this->Cell(0, 15, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

    // Checkbox con mejor alineación
    $this->SetFont('helvetica', '', 12);
    $this->SetXY(160, 18);
    $this->Cell(25, 10, 'QUEJA', 0, 0, 'L');
    $this->Rect(190, 18, 7, 7);

    $this->SetXY(160, 30);
    $this->Cell(25, 10, 'RECLAMO', 0, 0, 'L');
    $this->Rect(190, 30, 7, 7);

    // Línea divisoria fina
    $this->SetLineWidth(0.5);
    $this->Line(15, 42, 195, 42);

    // Sección 1
    $this->SetFont('helvetica', 'B', 12);
    $this->SetTextColor(255, 87, 34);
    $this->Ln(10);
    $this->Cell(0, 10, '1. INFORMACIÓN DEL RECLAMO', 0, 1);

    $this->SetFont('helvetica', '', 11);
    $this->SetTextColor(0);

    // Aquí mejor dividir en celdas con ancho fijo para alinear con bordes abajo más parejos
    $this->Cell(25, 8, 'Fecha:', 0, 0);
    $this->Cell(60, 8, $this->queja->fecha ?? '_________________________', 'B', 0);
    $this->Cell(30, 8, 'Cliente:', 0, 0);
    $this->Cell(60, 8, $this->queja->cliente ?? '_________________________', 'B', 1);

    // Y así sucesivamente para los demás campos...

    // MultiCell para descripción
    $this->Ln(6);
    $this->Cell(50, 8, 'Descripción de Producto:', 0, 1);
    $this->MultiCell(0, 25, $this->queja->descripcion_producto ?? "_____________________________________________________________", 0, 'L');

    // MultiCell para motivo
    $this->Ln(4);
    $this->Cell(50, 8, 'Motivo del reclamo:', 0, 1);
    $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? "_____________________________________________________________", 0, 'L');

    // Resto igual con ajustes en márgenes y saltos de línea...

    }
}
?>
