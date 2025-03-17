<?php
namespace Classes;

use TCPDF;

class InventarioPdf extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 12); // Cambia Arial por helvetica
        $this->Cell(0, 10, 'Inventario', 0, 0, 'C');
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

    // Centrar la tabla en la página
    $pageWidth = $this->GetPageWidth();
    $x = 10;
    $y = 30;
    $width = $pageWidth - 20; // Ancho de la tabla (menos márgenes)

    // Encabezado de la tabla
    $this->SetFillColor(255, 140, 0); // Color de fondo del encabezado
    $this->SetTextColor(255, 255, 255); // Color del texto en blanco
    $this->SetFont('helvetica', 'B', 12);

    $this->SetXY($x, $y);
    $this->Cell(60, 8, 'Producto', 1, 0, 'C', true);
    $this->Cell(50, 8, 'Stock Actual', 1, 0, 'C', true);
    $this->Cell(50, 8, 'Costo Unitario', 1, 1, 'C', true);

    // Relleno de datos de la tabla
    $this->SetFont('helvetica', '', 10);
    $this->SetTextColor(50, 50, 50); // Color gris oscuro para los datos

    foreach ($datos['inventarioProductos'] as $producto) {
        $this->SetXY($x, $y += 8); // Cambiar la posición para cada fila
        $this->Cell(60, 8, $producto->nombre_producto, 1, 0, 'L');
        $this->Cell(50, 8, $producto->stock_actual, 1, 0, 'C');
        $this->Cell(50, 8, '$' . $producto->costo_unitario, 1, 1, 'C');
    }

    // Agregar un borde general a la tabla
    // $this->SetDrawColor(200, 200, 200); // Gris claro para el borde
    $this->Rect($x - 1, $y - 8, $width + 2, ($y + (count($datos['inventarioProductos']) * 8)) - 8);
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