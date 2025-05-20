<?php
namespace Classes;

use TCPDF;

class pdfQuejas extends TCPDF 
{
    public function __construct()
    {
        parent::__construct();
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Megastock');
        $this->SetTitle('Reporte de Quejas');
        $this->SetSubject('Reporte generado con TCPDF');
        $this->SetMargins(15, 20, 15);
        $this->SetAutoPageBreak(true, 20);
        $this->SetFont('helvetica', '', 12);
    }

    // Aquí recibes el objeto $quejas directamente
    public function generarPdf($quejas)
    {
        $this->AddPage();

        if ($quejas) {
            $this->SetFont('helvetica', 'B', 14);
            $this->Cell(0, 10, 'Reporte de Queja', 0, 1, 'C');
            $this->Ln(5);

            $this->SetFont('helvetica', '', 12);
            $this->MultiCell(0, 8, "ID: " . ($quejas->id ?? 'N/A'));
            $this->MultiCell(0, 8, "Fecha: " . ($quejas->fecha ?? 'N/A'));
            $this->MultiCell(0, 8, "Responsable: " . ($quejas->responsable_reporte ?? 'N/A'));
            $this->MultiCell(0, 8, "Cliente: " . ($quejas->cliente ?? 'N/A'));
            $this->MultiCell(0, 8, "Motivo Reclamo: " . ($quejas->motivo_reclamo ?? 'N/A'));
            $this->MultiCell(0, 8, "Acción Solicitada: " . ($quejas->accion_solicitada ?? 'N/A'));
            $this->MultiCell(0, 8, "Descripción Producto: " . ($quejas->descripcion_producto ?? 'N/A'));
        } else {
            $this->Cell(0, 10, 'No hay datos para mostrar', 0, 1, 'C');
        }
    }

    public function verPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'I');
    }

    public function guardarPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'F');
    }

    public function enviarPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'E');
    }

    public function imprimirPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'I');
    }
}


