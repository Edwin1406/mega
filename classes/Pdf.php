<?php
namespace Pdf;

use TCPDF;

class Pdf extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Papel', 0, 0, 'C');
        $this->Ln(20);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    public function generarPdf($materias)
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Tipo de Papel', 1, 0, 'C');
        $this->Cell(40, 10, 'Gramaje', 1, 0, 'C');
        $this->Cell(40, 10, 'Ancho', 1, 0, 'C');
        $this->Cell(40, 10, 'Fecha y Hora', 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        foreach ($materias as $materia) {
            $this->Cell(40, 10, $materia->tipo, 1, 0, 'C');
            $this->Cell(40, 10, $materia->gramaje, 1, 0, 'C');
            $this->Cell(40, 10, $materia->ancho, 1, 0, 'C');
            $this->Cell(40, 10, $materia->created_at, 1, 0, 'C');
            $this->Ln();
        }
    }

    public function descargarPdf($materias)
    {
        $this->generarPdf($materias);
        $this->Output('reporte.pdf', 'D');
    }

    public function verPdf($materias)
    {
        $this->generarPdf($materias);
        $this->Output('reporte.pdf', 'I');
    }

    public function guardarPdf($materias)
    {
        $this->generarPdf($materias);
        $this->Output('reporte.pdf', 'F');
    }

    public function enviarPdf($materias)
    {
        $this->generarPdf($materias);
        $this->Output('reporte.pdf', 'E');
    }

    public function imprimirPdf($materias)
    {
        $this->generarPdf($materias);
        $this->Output('reporte.pdf', 'I');
    }

    public function __construct()
    {
        parent::__construct();
    }

    
}