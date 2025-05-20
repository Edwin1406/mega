<?php
namespace Classes;

use TCPDF;

class pdfQuejas extends TCPDF 
{
    protected $queja;

    // Recibimos la queja como array o stdClass (objeto)
    public function setQueja($queja)
    {
        $this->queja = $queja;
    }

    // Aquí generamos el PDF con la info
    public function generarPdf()
    {
        $this->AddPage();

        // Título
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 15, 'Reporte de Queja', 0, 1, 'C');

        $this->SetFont('helvetica', '', 12);

        // Fecha
        $this->Cell(50, 8, 'Fecha:', 0, 0);
        $this->Cell(0, 8, $this->queja->fecha ?? '-', 0, 1);

        // Responsable
        $this->Cell(50, 8, 'Responsable Reporte:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_reporte ?? '-', 0, 1);

        // Cliente
        $this->Cell(50, 8, 'Cliente:', 0, 0);
        $this->Cell(0, 8, $this->queja->cliente ?? '-', 0, 1);

        // Persona que reporta
        $this->Cell(50, 8, 'Persona que reporta:', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '-', 0, 1);

        // Factura
        $this->Cell(50, 8, 'Factura:', 0, 0);
        $this->Cell(0, 8, $this->queja->factura ?? '-', 0, 1);

        // Fecha factura
        $this->Cell(50, 8, 'Fecha Factura:', 0, 0);
        $this->Cell(0, 8, $this->queja->fecha_factura ?? '-', 0, 1);

        // Descripción producto
        $this->Cell(50, 8, 'Descripción Producto:', 0, 0);
        $this->MultiCell(0, 8, $this->queja->descripcion_producto ?? '-', 0, 'L');

        // Motivo reclamo
        $this->Cell(50, 8, 'Motivo Reclamo:', 0, 0);
        $this->MultiCell(0, 8, $this->queja->motivo_reclamo ?? '-', 0, 'L');

        // Acción solicitada
        $this->Cell(50, 8, 'Acción Solicitada:', 0, 0);
        $this->MultiCell(0, 8, $this->queja->accion_solicitada ?? '-', 0, 'L');
    }
}
