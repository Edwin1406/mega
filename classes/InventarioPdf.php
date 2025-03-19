<?php
namespace Classes;

use TCPDF;
class InventarioPdf extends TCPDF 
{
    
    
    public function generarPdf($datos)
    {
        // Agregar una nueva página
        
        // Agregar una nueva página
        $this->AddPage();
    
        // Centrar el contenedor principal en la página
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
    
        $etiquetaWidth = 100; // Ancho de la etiqueta
        $etiquetaHeight = 120; // Alto de la etiqueta
        $x = ($pageWidth - $etiquetaWidth) / 2;
        $y = ($pageHeight - $etiquetaHeight) / 2;
    
        // Dibujar contenedor principal con bordes redondeados y sombra
        $this->SetDrawColor(220, 220, 220); // Gris claro para el borde
        // fondo blanco
        $this->SetFillColor(255, 255, 255); // Fondo blanco
        $this->RoundedRect($x, $y, $etiquetaWidth, $etiquetaHeight, 5, '1111', 'DF');
    
        // Encabezado con degradado
        $this->SetFillColor(255, 140, 0); // Color degradado inicial
        $this->RoundedRect($x, $y, $etiquetaWidth, 20, 5, '1111', 'F'); // Encabezado
        $this->SetFont('helvetica', 'B', 14);
        $this->SetTextColor(255, 255, 255); // Blanco
        $this->SetXY($x, $y + 5);
        $this->Cell($etiquetaWidth, 10, 'MEGASTOCK', 0, 1, 'C');
    
        // Imagen del logo (centrado)
        $this->Image('src/img/logo2.png', $x + 13, $y + 2, 14, 14); // Tamaño y posición del logo
    
        // Datos principales con diseño moderno
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(50, 50, 50); // Gris o
        // Centrar la tabla
        $totalAnchoTabla = 100 + 40 + 30 + 20 + 30; // Ancho total de la tabla
        $margenIzquierdo = ($this->getPageWidth() - $totalAnchoTabla) / 2; // Calcular el margen izquierdo para centrar
        $this->SetX($margenIzquierdo);
        
        // Encabezados de la tabla
        $this->Cell(100, 10, 'Producto', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Área', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Costo Unitario', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Cantidad', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Total', 1, 1, 'C', true);
    
        // Datos de los productos
        $this->SetFont('helvetica', '', 12);
        $this->SetTextColor(50, 50, 50); 
    
        $total = 0;
    
        foreach ($datos['inventarioProductos'] as $producto) {
            if ($producto->stock_actual > 0) {
                $this->Cell(100, 10, $producto->nombre_producto, 1, 0, 'L');
                $this->Cell(40, 10, 'Producción', 1, 0, 'L');
                $this->Cell(30, 10, '$' . number_format($producto->costo_unitario, 2), 1, 0, 'C');
                $this->Cell(20, 10, number_format($producto->stock_actual, 2), 1, 0, 'C');
                
                $totalProducto = $producto->costo_unitario * $producto->stock_actual;
                $this->Cell(30, 10, '$' . number_format($totalProducto, 2), 1, 1, 'C');
                
                $total += $totalProducto;
            }
        }
        
        // Total final con fondo y bordes más llamativos
        $this->SetFont('helvetica', 'B', 14);
        $this->SetFillColor(255, 140, 0); // Naranja
        $this->SetTextColor(255, 255, 255); 
        $this->Cell(190, 10, 'TOTAL:', 1, 0, 'R', true);
        $this->Cell(30, 10, '$' . number_format($total, 2), 1, 1, 'C', true);
    
        // Nota al pie con espacio extra
        $this->SetFont('helvetica', 'I', 8);
        $this->Ln(10);
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