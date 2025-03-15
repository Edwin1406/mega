<?php
namespace Classes;

use TCPDF;
class Pdf2 extends TCPDF 
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 10, 'FACTURA DE COMPRA', 0, 1, 'C');
        $this->Ln(5);
    }
    
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    public function generarPdf($datos)
    {
        // Agregar una nueva página en formato horizontal
        $this->AddPage('L');

        // Logo
        $this->Image('src/img/logo2.png', 15, 10, 30);
        
        // Datos de la empresa
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(50, 10);
        $this->Cell(100, 6, 'MEGASTOCK S.A.', 0, 1, 'L');
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(50, 16);
        $this->Cell(100, 6, 'Direccion: Calle Falsa 123', 0, 1, 'L');
        $this->SetXY(50, 22);
        $this->Cell(100, 6, 'Telefono: +123456789', 0, 1, 'L');
        $this->SetXY(230, 10);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(50, 6, 'Factura No: ' . ($datos['id'] ?? 'No disponible'), 0, 1, 'R');
        $this->Ln(10);

        // Encabezado de la tabla (Ajustado para mayor ancho)
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(100, 8, 'Producto', 1, 0, 'C');
        $this->Cell(70, 8, 'Categoria', 1, 0, 'C');
        $this->Cell(50, 8, 'Precio Unitario', 1, 0, 'C');
        $this->Cell(30, 8, 'Cantidad', 1, 0, 'C');
        $this->Cell(50, 8, 'Subtotal', 1, 1, 'C');
        
        // Datos de la tabla
        $this->SetFont('helvetica', '', 10);
        $totalFactura = 0;

        // Asegurar que `array` siempre es un array válido
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

        // Llenar la tabla con productos
        foreach ($productos as $producto) {
            $descripcion = $producto['producto'] ?? 'N/A';
            $categoria = $producto['categoria'] ?? 'N/A';
            $precio = $producto['precio'] ?? 0;
            $cantidad = $producto['cantidad'] ?? 1;
            $subtotal = $precio * $cantidad;
            $totalFactura += $subtotal;

            $this->Cell(100, 8, $descripcion, 1);
            $this->Cell(70, 8, $categoria, 1);
            $this->Cell(50, 8, '$' . number_format($precio, 2), 1, 0, 'C');
            $this->Cell(30, 8, $cantidad, 1, 0, 'C');
            $this->Cell(50, 8, '$' . number_format($subtotal, 2), 1, 1, 'C');
        }

        // Total de la factura
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(250, 8, 'TOTAL:', 1);
        $this->Cell(50, 8, '$' . number_format($totalFactura, 2), 1, 1, 'C');
        
        $this->Ln(10);

        // Mensaje de agradecimiento
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 6, 'Gracias por su compra.', 0, 1, 'C');
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
