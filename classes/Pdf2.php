<?php
namespace Classes;

use TCPDF;




class Pdf2 extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 10, 'FACTURA DE COMPRA', 0, 1, 'C');
        $this->Ln(5);
    }
    
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    public function generarPdf($datos)
    {
        // Agregar una nueva página en formato horizontal
        $this->AddPage('L');

        // Asegurar que los datos estén bien estructurados
        $productos = [];
        if (!empty($datos['array'])) {
            if (is_string($datos['array'])) {
                $productos = json_decode($datos['array'], true);
            } else {
                $productos = $datos['array'];
            }
        }

        if (!is_array($productos)) {
            $productos = [];
        }

        // ** Diseño optimizado **
        // Logo alineado correctamente
        $this->Image('src/img/logo2.png', 15, 20, 35);
        
        // Datos de la empresa con más espacio
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(60, 20);
        $this->Cell(100, 6, 'MEGASTOCK S.A.', 0, 1, 'L');
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(60, 28);
        $this->Cell(100, 6, 'Dirección: Calle Falsa 123', 0, 1, 'L');
        $this->SetXY(60, 36);
        $this->Cell(100, 6, 'Teléfono: +123456789', 0, 1, 'L');

        // Número de factura correctamente alineado
        $this->SetXY(220, 25);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(50, 6, 'Factura No: ' . ($datos['id'] ?? 'No disponible'), 0, 1, 'R');

        $this->Ln(20); // Espaciado extra antes de la tabla

        // ** Diseño de la tabla mejorado **
        $this->SetFont('helvetica', 'B', 11);
        $this->SetFillColor(240, 240, 240); // Color gris claro para el encabezado
        $this->Cell(70, 10, 'Producto', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Categoría', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Área', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Costo Unitario', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Total', 1, 1, 'C', true);
        
        // Datos de la tabla con más espacio y margen
        $this->SetFont('helvetica', '', 11);
        $totalFactura = 0;

        foreach ($productos as $producto) {
            $descripcion = $producto['producto'] ?? 'N/A';
            $categoria = $producto['categoria'] ?? 'N/A';
            $area = $producto['area'] ?? 'N/A';
            $costoUnitario = $producto['costoUnitario'] ?? 0;
            $cantidad = $producto['cantidad'] ?? 1;
            $total = $producto['total'] ?? ($costoUnitario * $cantidad);
            $totalFactura += $total;

            $this->Cell(70, 10, "  " . $descripcion, 1);
            $this->Cell(50, 10, "  " . $categoria, 1);
            $this->Cell(50, 10, "  " . $area, 1);
            $this->Cell(40, 10, '$' . number_format($costoUnitario, 2), 1, 0, 'C');
            $this->Cell(30, 10, $cantidad, 1, 0, 'C');
            $this->Cell(40, 10, '$' . number_format($total, 2), 1, 1, 'C');
        }

        // Total de la factura más visible
        $this->SetFont('helvetica', 'B', 13);
        $this->SetFillColor(230, 230, 230); // Color gris claro
        $this->Cell(240, 12, 'TOTAL:', 1, 0, 'R', true);
        $this->Cell(40, 12, '$' . number_format($totalFactura, 2), 1, 1, 'C', true);
        
        $this->Ln(15); // Más espacio antes del mensaje final

        // Mensaje de agradecimiento más centrado y elegante
        $this->SetFont('helvetica', 'I', 11);
        $this->Cell(0, 10, 'Gracias por su compra.', 0, 1, 'C');
    }

    public function descargarPdf($datos)
    {
        $this->generarPdf($datos);
        $this->Output('factura.pdf', 'D');
    }

    public function verPdf($datos)
    {
        $this->generarPdf($datos);
        $this->Output('factura.pdf', 'I');
    }

    public function guardarPdf($datos)
    {
        $this->generarPdf($datos);
        $this->Output('factura.pdf', 'F');
    }

    public function enviarPdf($datos)
    {
        $this->generarPdf($datos);
        $this->Output('factura.pdf', 'E');
    }

    public function imprimirPdf($datos)
    {
        $this->generarPdf($datos);
        $this->Output('factura.pdf', 'I');
    }

    public function __construct()
    {
        parent::__construct();
    }
}
