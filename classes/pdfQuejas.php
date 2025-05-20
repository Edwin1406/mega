<?php
namespace Classes;

use TCPDF;

class pdfQuejas extends TCPDF 
{
    protected $queja;

    public function setQueja($queja)
    {
        $this->queja = $queja;
    }

    public function generarPdf()
    {
        $this->AddPage();

        // Configuraciones generales
        $this->SetMargins(10, 10, 10);
        $this->SetAutoPageBreak(true, 10);
        $this->SetFont('helvetica', '', 10);

        // Encabezado MegaStock con fondo naranja
        $this->SetFillColor(255, 140, 0); // naranja oscuro
        $this->SetTextColor(255, 255, 255); // texto blanco
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(40, 30, 'MEGA STOCK', 0, 0, 'C', true);

        $this->SetXY(55, 15);
        $this->SetTextColor(0);
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 10, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

        // Checkbox QUESA/RECLAMO al lado derecho
        $this->SetXY(160, 10);
        $this->SetFont('helvetica', '', 10);
        $this->Cell(20, 8, 'QUEJA ', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 1, 6, 6);
        $this->Cell(30, 8, 'RECLAMO ', 0, 1);
        $this->Rect($this->GetX() + 10, $this->GetY() - 7, 6, 6);

        // Inicio sección 1 (Información Reclamo)
        $this->SetY(45);
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(20, 120, "1.- INFORMACIÓN DEL RECLAMO.\nCLIENTE / VENTAS / DESPACHOS", 1, 0, 'C', true);

        // Color y fuente para contenido
        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(30, 45);

        // Campos línea 1
        $this->Cell(20, 8, 'Fecha:', 0, 0);
        $this->Cell(70, 8, $this->queja->fecha ?? '____________________', 'B', 0);
        $this->Cell(20, 8, 'Cliente:', 0, 0);
        $this->Cell(50, 8, $this->queja->cliente ?? '_____________________________', 'B', 1);

        // Línea 2
        $this->Cell(30, 8, 'Pedido N°:', 0, 0);
        $this->Cell(40, 8, $this->queja->pedido_numero ?? '__________', 'B', 0);
        $this->Cell(25, 8, 'Referencia:', 0, 0);
        $this->Cell(25, 8, $this->queja->referencia ?? '________', 'B', 0);
        $this->Cell(30, 8, 'Fecha-Factura:', 0, 0);
        $this->Cell(20, 8, $this->queja->fecha_factura ?? '________________', 'B', 1);

        // Línea 3
        $this->Cell(25, 8, 'Num-Lote:', 0, 0);
        $this->Cell(60, 8, $this->queja->num_lote ?? '____________________', 'B', 0);
        $this->Cell(30, 8, 'Num-Factura:', 0, 0);
        $this->Cell(40, 8, $this->queja->factura ?? '_________________________', 'B', 1);

        // Descripción producto
        $this->Cell(40, 8, 'Descripción de Producto:', 0, 1);
        $this->MultiCell(0, 20, $this->queja->descripcion_producto ?? '_____________________________________________________', 0, 'L');

        // Motivo reclamo
        $this->Cell(40, 8, 'Motivo del reclamo:', 0, 1);
        $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? '_____________________________________________________', 0, 'L');

        // Persona que generará reclamo y cargo/telefono
        $this->Cell(70, 8, 'Persona que generará el reclamo (Cliente):', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '_________________________', 0, 1);
        $this->Cell(60, 8, 'Cargo o área de la empresa:', 0, 0);
        $this->Cell(50, 8, '_____________________________', 'B', 0);
        $this->Cell(30, 8, 'Teléfono:', 0, 0);
        $this->Cell(40, 8, '________________________', 'B', 1);

        // Sección 2: Solución inmediata
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(20, 70, "2.- SOLUCIÓN INMEDIATA.\nVENTAS / DESPACHOS / PRODUCCIÓN", 1, 0, 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(30, 160);

        $this->MultiCell(0, 20, "Solución inmediata: \n" . ($this->queja->solucion_inmediata ?? "__________________________________________________"), 0, 'L');

        // Agregar checkboxes simulados y campos abajo
        $this->SetXY(30, 190);
        $checkboxes = ['VENTAS', 'DESPACHOS', 'PRODUCCIÓN'];
        foreach ($checkboxes as $box) {
            $this->Cell(25, 8, $box, 0, 0);
            $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
            $this->Cell(15, 8, '', 0, 0);
        }
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(30, 8, $this->queja->fecha_solucion ?? '_________', 'B', 1);

        // Continuar con checkboxes y autorizaciones como en imagen
        $this->Cell(40, 8, 'Clasificación / Arreglo:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(20, 8, 'Buenas:', 0, 0);
        $this->Cell(30, 8, $this->queja->buenas ?? '_______', 'B', 1);

        $this->Cell(40, 8, 'Reposición:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(30, 8, 'Autorizado por:', 0, 0);
        $this->Cell(60, 8, '_________________________', 'B', 1);

        $this->Cell(40, 8, 'Genera Nota Crédito:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(30, 8, 'Autorizado por:', 0, 0);
        $this->Cell(60, 8, '_________________________', 'B', 1);

        $this->Cell(40, 8, 'Genera Descuento:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(30, 8, '%', 0, 0);
        $this->Cell(20, 8, $this->queja->descuento ?? '___', 'B', 0);
        $this->Cell(15, 8, 'Autorizado por:', 0, 0);
        $this->Cell(60, 8, '_________________________', 'B', 1);

        $this->Cell(50, 8, 'Fecha de la Solución:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_solucion ?? '_________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable ?? '_________________', 'B', 1);

        // Sección 3: Trazabilidad Control Calidad
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(20, 55, "3.- TRAZABILIDAD\nCONTROL DE CALIDAD", 1, 0, 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(30, 270);

        // Campos de trazabilidad: ejemplo sencillo para mostrar estructura (se pueden adaptar)
        $this->Cell(50, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod ?? '___________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(50, 8, $this->queja->maquina ?? '___________', 'B', 1);

        $this->Cell(50, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod2 ?? '___________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(50, 8, $this->queja->maquina2 ?? '___________', 'B', 1);

        // Aquí puedes agregar más tablas similares para materiales, impresión, lotes, etc., según el formulario

        // Sección 4: Acción correctiva
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(20, 50, "4.- ACCIÓN CORRECTIVA\nPERSONA RESPONSABLE", 1, 0, 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(30, 340);

        $this->MultiCell(0, 20, "Causa del problema:\n" . ($this->queja->causa_problema ?? "_______________________________________________________"), 0, 'L');
        $this->Ln(5);
        $this->MultiCell(0, 30, "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "_______________________________________________________"), 0, 'L');

        $this->Cell(50, 8, 'Fecha de la Acción:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_accion ?? '____________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(50, 8, $this->queja->responsable_accion ?? '____________________', 'B', 1);

        // Pie de página: recibe el reclamo, fecha y hora
        $this->Ln(10);
        $this->Cell(80, 8, 'Recibe el reclamo:', 0, 0);
        $this->Cell(80, 8, 'Fecha y hora:', 0, 1);
        $this->Cell(80, 8, '______________________________', 0, 0);
        $this->Cell(80, 8, '______________________________', 0, 1);
    }
}
