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
    
    public function generarEtiqueta($datos)
    {
        // Agregar una nueva página
        $this->AddPage();
    
        // Establecer colores
        $this->SetFillColor(255, 165, 0); // Naranja para el encabezado
        $this->SetTextColor(0, 0, 0); // Negro para el texto
    
        // Agregar logo (opcional)
        $this->Image('ruta_al_logo.png', 10, 10, 20, 20); // Ajusta la posición y tamaño del logo
    
        // Encabezado naranja
        $this->SetFont('helvetica', 'B', 14);
        $this->SetXY(10, 10); // Posición del encabezado
        $this->Cell(190, 15, 'MEGASTOCK BOBINA INTERNA', 0, 1, 'C', true);
    
        // Texto principal
        $this->SetFont('helvetica', '', 12);
        $this->SetXY(10, 30);
        $this->Cell(95, 10, 'TIPO: ' . $datos['tipo'], 0, 0, 'L');
        $this->Cell(95, 10, 'CANTIDAD: ' . $datos['cantidad'], 0, 1, 'L');
    
        $this->Cell(95, 10, 'GRAMAJE: ' . $datos['gramaje'], 0, 0, 'L');
        $this->Cell(95, 10, 'LINER: ' . $datos['liner'], 0, 1, 'L');
    
        $this->Cell(95, 10, 'ANCHO: ' . $datos['ancho'], 0, 0, 'L');
        $this->Cell(95, 10, 'LARGO: ' . $datos['largo'], 0, 1, 'L');
    
        $this->Cell(95, 10, 'PESO: ' . $datos['peso'], 0, 1, 'L');
    
        // Código de barras (si es necesario)
        $this->SetXY(10, 80);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, // Ningún fondo
            'text' => false, // No mostrar texto
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        $this->write1DBarcode('123456789012', 'C128', '', '', '', 18, 0.4, $style, 'N');
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