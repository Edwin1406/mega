<?php
namespace Classes;

use TCPDF;
class Pdf2 extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Etiqueta', 0, 0, 'C');
        $this->Ln(20);
    }
    
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    public function generarPdf($datos)
    {
        // Agregar una nueva página
        $this->AddPage();
    
        // Centrar el contenedor principal en la página
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
    
        $etiquetaWidth = 100;
        $etiquetaHeight = 140; // Se ajusta altura para la tabla
        $x = ($pageWidth - $etiquetaWidth) / 2;
        $y = ($pageHeight - $etiquetaHeight) / 2;
    
        // Dibujar contenedor principal
        $this->SetDrawColor(220, 220, 220);
        $this->SetFillColor(255, 255, 255);
        $this->RoundedRect($x, $y, $etiquetaWidth, $etiquetaHeight, 5, '1111', 'DF');
    
        // Encabezado
        $this->SetFillColor(255, 140, 0);
        $this->RoundedRect($x, $y, $etiquetaWidth, 20, 5, '1111', 'F');
        $this->SetFont('helvetica', 'B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->SetXY($x, $y + 5);
        $this->Cell($etiquetaWidth, 10, 'MEGASTOCK', 0, 1, 'C');
    
        // Logo
        $this->Image('src/img/logo2.png', $x + 13, $y + 2, 14, 14);
    
        // Datos principales
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(50, 50, 50);
    
        // TIPO
        $this->SetXY($x + 10, $y + 25);
        $this->Cell(40, 6, 'TIPO:', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(40, 6, $datos['id'], 0, 1, 'L');
    
        // ANCHO - Etiqueta de sección
        $this->SetFont('helvetica', '', 10);
        $this->SetXY($x + 10, $y + 35);
        $this->Cell(40, 6, 'PRODUCTOS:', 0, 1, 'L');
        
        // Decodificar JSON si es un string
        if (is_string($datos['array'])) {
            $productos = json_decode($datos['array'], true);
        } else {
            $productos = $datos['array'];
        }

        // Verificar que se decodificó correctamente
        if (is_array($productos)) {
            $this->SetFont('helvetica', 'B', 9);
            $this->SetX($x + 10);
            $this->Cell(60, 6, 'Producto', 1, 0, 'C');
            $this->Cell(30, 6, 'Categoría', 1, 1, 'C');
            
            $this->SetFont('helvetica', '', 9);
            foreach ($productos as $producto) {
                if (isset($producto['producto']) && isset($producto['categoria'])) {
                    $this->SetX($x + 10);
                    $this->Cell(60, 6, $producto['producto'], 1, 0, 'L');
                    $this->Cell(30, 6, $producto['categoria'], 1, 1, 'L');
                }
            }
        } else {
            $this->SetX($x + 10);
            $this->Cell(90, 6, 'Datos no válidos', 1, 1, 'C');
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

// Datos de prueba
$datosEjemplo = [
    'id' => '37',
    'array' => '[{"producto":"LEXMARK 56F4X00 MX522","categoria":"Toner"},{"producto":"HP 17A CF217A","categoria":"Toner"}]'
];

// Generar PDF
$pdf = new Pdf2();
$pdf->verPdf($datosEjemplo);
