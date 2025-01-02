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
    
        // Dibujar el contenedor principal de la etiqueta border radios y fondo blanco
        $this->SetLineWidth(0.1); // Grosor de la línea
        $this->SetDrawColor(0, 0, 0); // Color de la línea
        $this->SetTextColor(0, 0, 0); // Color del texto
        $this->SetAutoPageBreak(false); // Evita que se cree una nueva página
        // boder radios
        $this->RoundedRect(10, 10, 90, 120, 2, '1111', 'DF');
        

        $this->SetFillColor(255, 255, 255); // Fondo blanco
        $this->Rect(10, 10, 90, 120, 'DF'); // Contenedor de 90x120 mm
    
        // Encabezado Naranja
        $this->SetFillColor(255, 164, 27); // Color naranja
        $this->Rect(10, 10, 90, 20, 'F'); // Rectángulo para el encabezado
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(10, 12);
        $this->Cell(90, 8, 'MEGASTOCK BOBINA INTERNA', 0, 1, 'C');
    
        // Datos principales
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(0, 0, 0);
    
        // TIPO
        $this->SetXY(12, 35);
        $this->Cell(40, 6, 'TIPO:', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(40, 6, $datos['tipo'], 0, 1, 'L');
    
        // ANCHO
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(12, 45);
        $this->Cell(40, 6, 'ANCHO:', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(40, 6, $datos['ancho'], 0, 1, 'L');
    
        // PESO
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(12, 55);
        $this->Cell(40, 6, 'PESO:', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(40, 6, $datos['peso'], 0, 1, 'L');
    
        // FECHA
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(12, 65);
        $this->Cell(40, 6, 'FECHA:', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(40, 6, $datos['created_at'], 0, 1, 'L');
    
        // Línea divisoria
        $this->Line(10, 85, 100, 85);
    
        // Código de barras
        $this->SetXY(10, 90);
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
            'fontsize' => 8,
            'stretchtext' => 4
        );
        $this->write1DBarcode($datos['barcode'], 'C128', 30, 95, 50, 15, 0.4, $style, 'N');
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