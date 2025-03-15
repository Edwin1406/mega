<?php
namespace Classes;

use TCPDF;
class Pdf2 extends TCPDF 
{
    public function generarPdf($datos)
    {
        $this->AddPage('L');

        // Asegurar que $datos['array'] sea válido
        $productos = is_array($datos['array']) ? $datos['array'] : json_decode($datos['array'], true);
        if (!is_array($productos)) {
            $productos = [];
        }

        // Logo
        $this->Image('src/img/logo2.png', 15, 20, 35);

        // Encabezado
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(60, 20);
        $this->Cell(100, 6, 'MEGASTOCK S.A.', 0, 1, 'L');
        
        // Número de factura
        $this->SetXY(220, 25);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(50, 6, 'Factura No: ' . ($datos['id'] ?? 'No disponible'), 0, 1, 'R');

        $this->Ln(20);

        // Tabla de productos
        $this->SetFont('helvetica', 'B', 11);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(70, 10, 'Producto', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Categoría', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Área', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Costo Unitario', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Total', 1, 1, 'C', true);

        // Datos de la tabla
        $this->SetFont('helvetica', '', 11);
        $totalFactura = 0;
        foreach ($productos as $producto) {
            $costoUnitario = $producto['costoUnitario'] ?? 0;
            $cantidad = $producto['cantidad'] ?? 1;
            $total = $producto['total'] ?? ($costoUnitario * $cantidad);
            $totalFactura += $total;

            $this->Cell(70, 10, "  " . ($producto['producto'] ?? 'N/A'), 1);
            $this->Cell(50, 10, "  " . ($producto['categoria'] ?? 'N/A'), 1);
            $this->Cell(50, 10, "  " . ($producto['area'] ?? 'N/A'), 1);
            $this->Cell(40, 10, '$' . number_format($costoUnitario, 2), 1, 0, 'C');
            $this->Cell(30, 10, $cantidad, 1, 0, 'C');
            $this->Cell(40, 10, '$' . number_format($total, 2), 1, 1, 'C');
        }

        // Total de la factura
        $this->SetFont('helvetica', 'B', 13);
        $this->SetFillColor(230, 230, 230);
        $this->Cell(240, 12, 'TOTAL:', 1, 0, 'R', true);
        $this->Cell(40, 12, '$' . number_format($totalFactura, 2), 1, 1, 'C', true);

        $this->Ln(15);

        // Mensaje de agradecimiento
        $this->SetFont('helvetica', 'I', 11);
        $this->Cell(0, 10, 'Gracias por su compra.', 0, 1, 'C');
    }

    public function obtenerPdfEnMemoria($datos)
    {
        $this->generarPdf($datos); // Genera el PDF en memoria
        return $this->Output('', 'S'); // Devolver el PDF como string en memoria
    }

    public function visualizarPdf($datos)
    {
        $this->generarPdf($datos); // Generar PDF
        $this->Output('factura.pdf', 'I'); // Mostrar en navegador
    }
}
