<?php
namespace Classes;

use TCPDF;

class InventarioPdf extends TCPDF 
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
    
    public function generarPdf($datos)
    {
        // Agregar una nueva página
        $this->AddPage();
    
        // Centrar el contenedor principal en la página
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
    
        $etiquetaWidth = 180; // Ancho de la tabla
        $x = 10; // Posición X para la tabla
        $y = 30; // Posición Y para la tabla
    
        // Dibujar contenedor principal con bordes redondeados y sombra
        $this->SetDrawColor(220, 220, 220); // Gris claro para el borde
        $this->SetFillColor(255, 255, 255); // Fondo blanco
        $this->RoundedRect($x, $y, $etiquetaWidth, 150, 5, '1111', 'DF');
    
        // Encabezado de la tabla
        $this->SetFillColor(255, 140, 0); // Color del encabezado
        $this->SetFont('helvetica', 'B', 10);
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetXY($x, $y);
        $this->Cell(60, 6, 'Producto', 1, 0, 'C', 1);
        $this->Cell(40, 6, 'Stock Actual', 1, 0, 'C', 1);
        $this->Cell(40, 6, 'Costo Unitario', 1, 1, 'C', 1);
    
        // Rellenar la tabla con los datos
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(50, 50, 50); // Gris oscuro para el texto
    
        // Recorrer los productos y llenar las filas de la tabla
        foreach ($datos['inventarioProductos'] as $producto) {
            $this->Cell(60, 6, $producto->nombre_producto, 1, 0, 'C');
            $this->Cell(40, 6, $producto->stock_actual, 1, 0, 'C');
            $this->Cell(40, 6, '$' . $producto->costo_unitario, 1, 1, 'C');
        }
    
        // Agregar un borde a la tabla
        $this->SetDrawColor(0, 0, 0); // Borde negro
        $this->Rect($x, $y, $etiquetaWidth, 150); // Borde alrededor de la tabla
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