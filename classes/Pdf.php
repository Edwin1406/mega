<?php
namespace Classes;

use TCPDF;

class Pdf extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 12); // Cambia Arial por helvetica
        $this->Cell(0, 10, 'Etiqueta', 0, 0, 'C');
        $this->Ln(20);
    }
    
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8); // Cambia Arial por helvetica
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    // public function generarPdf($datos)
    // {
    //     // Agregar una nueva página
    //     $this->AddPage();
    
    //     // Centrar el contenedor principal en la página
    //     $pageWidth = $this->GetPageWidth();
    //     $pageHeight = $this->GetPageHeight();
    
    //     $etiquetaWidth = 120; // Ancho de la etiqueta
    //     $etiquetaHeight = 120; // Alto de la etiqueta
    //     $x = ($pageWidth - $etiquetaWidth) / 2;
    //     $y = ($pageHeight - $etiquetaHeight) / 2;
    
    //     // Dibujar contenedor con bordes redondeados
    //     $this->SetDrawColor(0, 0, 0); // Color del borde
    //     $this->SetFillColor(255, 255, 255); // Fondo blanco
    //     $this->RoundedRect($x, $y, $etiquetaWidth, $etiquetaHeight, 5, '1111', 'DF'); // Bordes redondeados para todo el contenedor
    
    //     // Encabezado Naranja
    //     $this->SetFillColor(255, 164, 27); // Color naranja
    //     $this->RoundedRect($x, $y, $etiquetaWidth, 20, 5, '1111', 'F'); // Encabezado con esquinas superiores redondeadas
    //     $this->SetFont('helvetica', 'B', 12);
    //     $this->SetTextColor(0, 0, 0);
    //     $this->SetXY($x, $y + 5);
    //     $this->Cell($etiquetaWidth, 10, 'MEGASTOCK BOBINA INTERNA', 0, 1, 'C');
    
    //     // Imagen del logo
    //     $this->Image('src/img/logo2.png', $x + 5, $y + 3, 14, 14); // Ajusta la ruta y tamaño del logo
    
    //     // Datos principales
    //     $this->SetFont('helvetica', '', 10);
    //     $this->SetTextColor(0, 0, 0);
    
    //     // TIPO
    //     $this->SetXY($x + 10, $y + 25);
    //     $this->Cell(40, 6, 'TIPO:', 0, 0, 'L');
    //     $this->SetFont('helvetica', 'B', 10);
    //     $this->Cell(40, 6, $datos['tipo'], 0, 1, 'L');
    
    //     // ANCHO
    //     $this->SetFont('helvetica', '', 10);
    //     $this->SetXY($x + 10, $y + 35);
    //     $this->Cell(40, 6, 'ANCHO:', 0, 0, 'L');
    //     $this->SetFont('helvetica', 'B', 10);
    //     $this->Cell(40, 6, $datos['ancho'], 0, 1, 'L');
    
    //     // PESO
    //     $this->SetFont('helvetica', '', 10);
    //     $this->SetXY($x + 10, $y + 45);
    //     $this->Cell(40, 6, 'PESO:', 0, 0, 'L');
    //     $this->SetFont('helvetica', 'B', 10);
    //     $this->Cell(40, 6, $datos['peso'], 0, 1, 'L');
    
    //     // FECHA
    //     $this->SetFont('helvetica', '', 10);
    //     $this->SetXY($x + 10, $y + 55);
    //     $this->Cell(40, 6, 'FECHA:', 0, 0, 'L');
    //     $this->SetFont('helvetica', 'B', 10);
    //     $this->Cell(40, 6, $datos['created_at'], 0, 1, 'L');
    
    //     // Línea divisoria
    //     $this->Line($x + 5, $y + 80, $x + $etiquetaWidth - 5, $y + 80);
    
    //     // Código de barras
    //     $this->SetXY($x + 10, $y + 85);
    //     $style = array(
    //         'position' => '',
    //         'align' => 'C',
    //         'stretch' => false,
    //         'fitwidth' => true,
    //         'cellfitalign' => '',
    //         'border' => false,
    //         'hpadding' => 'auto',
    //         'vpadding' => 'auto',
    //         'fgcolor' => array(0, 0, 0), // Negro
    //         'bgcolor' => false, // Sin fondo
    //         'text' => true, // Mostrar texto del código de barras
    //         'font' => 'helvetica',
    //         'fontsize' => 8,
    //         'stretchtext' => 4
    //     );
    //     $this->write1DBarcode($datos['barcode'], 'C128', $x + 25, $y + 90, 50, 15, 0.4, $style, 'N');
    // }
    public function generarPdf($datos)
    {
        // Agregar una nueva página
        $this->AddPage();
    
        // Dimensiones de la página
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
    
        // Tamaño de la etiqueta (ocupando casi toda la hoja)
        $etiquetaWidth = $pageWidth - 20;
        $etiquetaHeight = $pageHeight - 20;
        $x = 10;
        $y = 10;
    
        // Dibujar el contenedor principal
        $this->SetDrawColor(220, 220, 220);
        $this->SetFillColor(255, 255, 255);
        $this->RoundedRect($x, $y, $etiquetaWidth, $etiquetaHeight, 5, '1111', 'DF');
    
        // Encabezado
        $this->SetFillColor(255, 140, 0);
        $this->RoundedRect($x, $y, $etiquetaWidth, 25, 5, '1111', 'F');
        $this->SetFont('helvetica', 'B', 28);
        $this->SetTextColor(255, 255, 255);
        $this->SetXY($x, $y + 5);
        $this->Cell($etiquetaWidth, 10, 'MEGASTOCK', 0, 1, 'C');
    
        // Logo
        $this->Image('src/img/logo2.png', $x + 15, $y + 5, 15, 15);
    
        // Datos principales en dos columnas
        $col1X = $x + 20; // Posición de la primera columna
        $col2X = $x + ($etiquetaWidth / 2); // Posición de la segunda columna
        $lineHeight = 12; // Espaciado entre líneas
        $dataStartY = $y + 40;
    
        // Configuración de texto
        $this->SetFont('helvetica', '', 20);
        $this->SetTextColor(50, 50, 50);
    
        // Columna 1: Etiquetas
        $this->SetXY($col1X, $dataStartY);
        $this->Cell(40, 10, 'TIPO:', 0, 1, 'L');
        $this->SetXY($col1X, $dataStartY + $lineHeight);
        $this->Cell(40, 10, 'ANCHO:', 0, 1, 'L');
        $this->SetXY($col1X, $dataStartY + 2 * $lineHeight);
        $this->Cell(40, 10, 'PESO:', 0, 1, 'L');
        $this->SetXY($col1X, $dataStartY + 3 * $lineHeight);
        $this->Cell(40, 10, 'GRAMAJE:', 0, 1, 'L');
        $this->SetXY($col1X, $dataStartY + 4 * $lineHeight);
        $this->Cell(40, 10, 'FECHA:', 0, 1, 'L');
    
        // Columna 2: Valores
        $this->SetFont('helvetica', 'B', 22);
        $this->SetXY($col2X, $dataStartY);
        $this->Cell(40, 10, $datos['tipo'], 0, 1, 'L');
        $this->SetXY($col2X, $dataStartY + $lineHeight);
        $this->Cell(40, 10, $datos['ancho'], 0, 1, 'L');
        $this->SetXY($col2X, $dataStartY + 2 * $lineHeight);
        $this->Cell(40, 10, $datos['peso'], 0, 1, 'L');
        $this->SetXY($col2X, $dataStartY + 3 * $lineHeight);
        $this->Cell(40, 10, $datos['gramaje'], 0, 1, 'L');
        $this->SetXY($col2X, $dataStartY + 4 * $lineHeight);
        $this->Cell(40, 10, $datos['created_at'], 0, 1, 'L');
    
        // Línea divisoria
        $this->SetDrawColor(200, 200, 200);
        $this->Line($x + 20, $dataStartY + 5 * $lineHeight + 5, $x + $etiquetaWidth - 20, $dataStartY + 5 * $lineHeight + 5);
    
        // Código de barras grande
        $barcodeWidth = 220; // Ancho del código de barras
        $barcodeHeight = 30; // Alto del código de barras
        $barcodeX = $x + ($etiquetaWidth / 2) - ($barcodeWidth / 2);
        $barcodeY = $dataStartY + 6 * $lineHeight + 10;
        $this->SetXY($barcodeX, $barcodeY);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 14,
            'stretchtext' => 4
        );
        $this->write1DBarcode($datos['barcode'], 'C128', $barcodeX, $barcodeY, $barcodeWidth, $barcodeHeight, 0.4, $style, 'N');
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