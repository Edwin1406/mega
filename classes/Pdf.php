<?php
namespace Classes;

use TCPDF;

class Pdf extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 12); // Cambia Arial por helvetica
        $this->Cell(0, 10, 'Reporte de Papel', 0, 0, 'C');
        $this->Ln(20);
    }
    
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8); // Cambia Arial por helvetica
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    public function generarPdf($datos)
{
    // Agregar una nueva página
    $this->AddPage();

    // Encabezado Naranja
    $this->SetFillColor(255, 165, 0); // Naranja
    $this->SetTextColor(0, 0, 0); // Negro
    $this->SetFont('helvetica', 'B', 14);
    $this->Cell(190, 20, 'MEGASTOCK BOBINA INTERNA', 0, 1, 'C', true);

    // Espacio después del encabezado
    $this->Ln(10);

    // Datos del tipo
    $this->SetFont('helvetica', '', 12);
    $this->Cell(50, 10, 'TIPO:', 0, 0, 'L');
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 10, $datos['tipo'], 0, 1, 'L'); // TIPO

    // Datos del ancho
    $this->SetFont('helvetica', '', 12);
    $this->Cell(50, 10, 'ANCHO:', 0, 0, 'L');
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 10, $datos['ancho'], 0, 1, 'L'); // ANCHO

    // Datos del peso
    $this->SetFont('helvetica', '', 12);
    $this->Cell(50, 10, 'PESO:', 0, 0, 'L');
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 10, $datos['peso'], 0, 1, 'L'); // PESO

    // Datos de la fecha de creación
    $this->SetFont('helvetica', '', 12);
    $this->Cell(50, 10, 'FECHA:', 0, 0, 'L');
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 10, $datos['created_at'], 0, 1, 'L'); // CREATED_AT

    // Código de Barras
    $this->Ln(10); // Espacio antes del código de barras
    $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0), // Negro
        'bgcolor' => false, // Sin fondo
        'text' => true, // Mostrar texto del código de barras
        'font' => 'helvetica',
        'fontsize' => 10,
        'stretchtext' => 4
    );

    // Generar código de barras
    $this->write1DBarcode($datos['barcode'], 'C128', '', '', '', 18, 0.4, $style, 'N');
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