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
    
        // Configuración de fuentes y colores
        $this->SetFont('helvetica', 'B', 14);
        $this->SetTextColor(0, 0, 0); // Negro
    
        // Título de la página
        $this->SetXY(10, 10);
        $this->Cell(190, 10, 'MEGASTOCK S.A.', 0, 1, 'L');
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(190, 10, 'INVENTARIO', 0, 1, 'C');
    
        // Número de factura
        $this->SetFont('helvetica', '', 12);
        $this->Cell(190, 10, 'Factura No: 40', 0, 1, 'R');
        
        // Espaciado
        $this->Ln(10);
    
        // Encabezado de la tabla
        $this->SetFillColor(255, 140, 0); // Naranja
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetFont('helvetica', 'B', 12);
    
        $this->Cell(60, 8, 'Producto', 1, 0, 'C', true);
        $this->Cell(40, 8, 'Área', 1, 0, 'C', true);
        $this->Cell(30, 8, 'Costo Unitario', 1, 0, 'C', true);
        $this->Cell(20, 8, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(30, 8, 'Total', 1, 1, 'C', true);
    
        // Datos de los productos
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(50, 50, 50); // Gris oscuro
    
        $total = 0;
    
        foreach ($datos['inventarioProductos'] as $producto) {
             debuguear($producto);

            $this->Cell(60, 8, $producto->nombre_producto, 1, 0, 'L');
         
            $this->Cell(40, 8, 'Producción', 1, 0, 'L');
            $this->Cell(30, 8, '$' . number_format($producto->costo_unitario, 2), 1, 0, 'C');
            $this->Cell(20, 8, '1', 1, 0, 'C'); // Cantidad = 1 (ajustar si es necesario)
            $totalProducto = $producto->costo_unitario * 1; // Aquí calculamos el total de cada producto
            $this->Cell(30, 8, '$' . number_format($totalProducto, 2), 1, 1, 'C');
            $total += $totalProducto;
        }
    
        // Total final
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(160, 8, 'TOTAL:', 1, 0, 'R');
        $this->Cell(30, 8, '$' . number_format($total, 2), 1, 1, 'C');
    
        // Nota al pie
        $this->SetFont('helvetica', 'I', 8);
        $this->Ln(10);
        $this->MultiCell(190, 5, 'Se requiere su aprobación para proceder con la gestión de la compra. Por favor, responda a este correo.');
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