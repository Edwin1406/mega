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
        $this->AddPage();
        $this->SetMargins(15, 20, 15);
        $this->SetAutoPageBreak(true, 20);

        // Fuente base y color negro
        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // --- Encabezado ---
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(50, 15, 'MEGA STOCK', 0, 0, 'L');

        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

        // Checkbox QUEJA y RECLAMO con etiquetas alineadas
        $this->SetFont('helvetica', '', 12);

        $this->SetXY(160, 20);
        $this->Cell(25, 8, 'QUEJA', 0, 0, 'L');
        $this->Rect(190, 20, 7, 7);

        $this->SetXY(160, 30);
        $this->Cell(25, 8, 'RECLAMO', 0, 0, 'L');
        $this->Rect(190, 30, 7, 7);

        // Línea divisoria
        $this->SetLineWidth(0.8);
        $this->Line(15, 40, 195, 40);

        // --- Sección 1: Información del Reclamo ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34); // naranja brillante
        $this->Ln(8);
        $this->Cell(0, 10, '1. INFORMACIÓN DEL RECLAMO', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Fecha y Cliente
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha ?? '_________________________', 'B', 0);
        $this->Cell(30, 8, 'Cliente:', 0, 0);
        $this->Cell(60, 8, $this->queja->cliente ?? '_________________________', 'B', 1);

        // Pedido N°, Referencia, Fecha-Factura
        $this->Cell(30, 8, 'Pedido N°:', 0, 0);
        $this->Cell(50, 8, $this->queja->pedido_numero ?? '__________', 'B', 0);
        $this->Cell(30, 8, 'Referencia:', 0, 0);
        $this->Cell(35, 8, $this->queja->referencia ?? '_________', 'B', 0);
        $this->Cell(35, 8, 'Fecha-Factura:', 0, 0);
        $this->Cell(20, 8, $this->queja->fecha_factura ?? '_________', 'B', 1);

        // Num-Lote y Num-Factura
        $this->Cell(30, 8, 'Num-Lote:', 0, 0);
        $this->Cell(60, 8, $this->queja->num_lote ?? '________________', 'B', 0);
        $this->Cell(30, 8, 'Num-Factura:', 0, 0);
        $this->Cell(55, 8, $this->queja->factura ?? '________________________', 'B', 1);

        // Descripción Producto (MultiCell para texto largo)
        $this->Ln(4);
        $this->Cell(50, 8, 'Descripción de Producto:', 0, 1);
        $this->MultiCell(0, 25, $this->queja->descripcion_producto ?? "_____________________________________________________________", 0, 'L');

        // Motivo del reclamo (MultiCell)
        $this->Ln(2);
        $this->Cell(50, 8, 'Motivo del reclamo:', 0, 1);
        $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? "_____________________________________________________________", 0, 'L');

        // Persona que genera el reclamo
        $this->Ln(2);
        $this->Cell(80, 8, 'Persona que generará el reclamo (Cliente):', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '__________________________', 0, 1);

        // Cargo y teléfono (campos para rellenar)
        $this->Cell(60, 8, 'Cargo o área de la empresa:', 0, 0);
        $this->Cell(80, 8, '____________________________', 'B', 0);
        $this->Cell(30, 8, 'Teléfono:', 0, 0);
        $this->Cell(0, 8, '________________________', 'B', 1);
    }
}
?>
