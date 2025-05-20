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
        $this->SetMargins(15, 20, 15);
        $this->SetAutoPageBreak(true, 20);

        // Fuente base y color negro
        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // --- Encabezado ---
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(50, 15, 'MEGA STOCK', 0, 0, 'L');

        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

        // Checkbox QUEJA y RECLAMO con etiquetas alineadas
        $this->SetFont('helvetica', '', 12);

        $this->SetXY(160, 20);
        $this->Cell(25, 8, 'QUEJA', 0, 0, 'L');
        $this->Rect(190, 20, 7, 7);

        $this->SetXY(160, 30);
        $this->Cell(25, 8, 'RECLAMO', 0, 0, 'L');
        $this->Rect(190, 30, 7, 7);

        // Línea divisoria
        $this->SetLineWidth(0.8);
        $this->Line(15, 40, 195, 40);

        // --- Sección 1: Información del Reclamo ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34); // naranja brillante
        $this->Ln(8);
        $this->Cell(0, 10, '1. INFORMACIÓN DEL RECLAMO', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Fecha y Cliente
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha ?? '_________________________', 'B', 0);
        $this->Cell(30, 8, 'Cliente:', 0, 0);
        $this->Cell(60, 8, $this->queja->cliente ?? '_________________________', 'B', 1);

        // Pedido N°, Referencia, Fecha-Factura
        $this->Cell(30, 8, 'Pedido N°:', 0, 0);
        $this->Cell(50, 8, $this->queja->pedido_numero ?? '__________', 'B', 0);
        $this->Cell(30, 8, 'Referencia:', 0, 0);
        $this->Cell(35, 8, $this->queja->referencia ?? '_________', 'B', 0);
        $this->Cell(35, 8, 'Fecha-Factura:', 0, 0);
        $this->Cell(20, 8, $this->queja->fecha_factura ?? '_________', 'B', 1);

        // Num-Lote y Num-Factura
        $this->Cell(30, 8, 'Num-Lote:', 0, 0);
        $this->Cell(60, 8, $this->queja->num_lote ?? '________________', 'B', 0);
        $this->Cell(30, 8, 'Num-Factura:', 0, 0);
        $this->Cell(55, 8, $this->queja->factura ?? '________________________', 'B', 1);

        // Descripción Producto (MultiCell para texto largo)
        $this->Ln(4);
        $this->Cell(50, 8, 'Descripción de Producto:', 0, 1);
        $this->MultiCell(0, 25, $this->queja->descripcion_producto ?? "_____________________________________________________________", 0, 'L');

        // Motivo del reclamo (MultiCell)
        $this->Ln(2);
        $this->Cell(50, 8, 'Motivo del reclamo:', 0, 1);
        $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? "_____________________________________________________________", 0, 'L');

        // Persona que genera el reclamo
        $this->Ln(2);
        $this->Cell(80, 8, 'Persona que generará el reclamo (Cliente):', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '__________________________', 0, 1);

        // Cargo y teléfono (campos para rellenar)
        $this->Cell(60, 8, 'Cargo o área de la empresa:', 0, 0);
        $this->Cell(80, 8, '____________________________', 'B', 0);
        $this->Cell(30, 8, 'Teléfono:', 0, 0);
        $this->Cell(0, 8, '________________________', 'B', 1);

        // Línea divisoria
        $this->Ln(8);
        $this->SetLineWidth(0.6);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(8);

        // --- Sección 2: Solución Inmediata ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '2. SOLUCIÓN INMEDIATA', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Solución inmediata
        $this->MultiCell(0, 30, "Solución inmediata:\n" . ($this->queja->solucion_inmediata ?? "_____________________________________________________________"), 0, 'L');

        // Checkboxes VENTAS, DESPACHOS, PRODUCCIÓN
        $this->Ln(4);
        $checkboxes = ['VENTAS', 'DESPACHOS', 'PRODUCCIÓN'];
        $startX = 15;
        foreach ($checkboxes as $ch) {
            $this->SetXY($startX, $this->GetY());
            $this->Cell(30, 8, $ch, 0, 0);
            $this->Rect($startX + 28, $this->GetY() + 2, 6, 6);
            $startX += 50;
        }

        // Fecha solución
        $this->SetXY(165, $this->GetY());
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(40, 8, $this->queja->fecha_solucion ?? '_________', 'B', 1);

        // Clasificación / Arreglo SI NO + Buenas
        $this->Cell(45, 8, 'Clasificación / Arreglo:', 0, 0);
        $this->Cell(15, 8, 'SI');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(30, 8, 'Buenas:', 0, 0);
        $this->Cell(40, 8, $this->queja->buenas ?? '_____', 'B', 1);

        // Reposición SI NO + Autorizado por
        $this->Cell(40, 8, 'Reposición:', 0, 0);
        $this->Cell(15, 8, 'SI');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(50, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Genera Nota Crédito SI NO + Autorizado por
        $this->Cell(50, 8, 'Genera Nota Crédito:', 0, 0);
        $this->Cell(15, 8, 'SI');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, 'NO');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(40, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Genera Descuento SI % + Autorizado por
        $this->Cell(45, 8, 'Genera Descuento:', 0, 0);
        $this->Cell(15, 8, 'SI');
        $this->Rect($this->GetX(), $this->GetY() + 2, 6, 6);
        $this->Cell(15, 8, '%', 0, 0);
        $this->Cell(20, 8, $this->queja->descuento ?? '__', 'B', 0);
        $this->Cell(45, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Fecha solución y Responsable
        $this->Cell(50, 8, 'Fecha de la Solución:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_solucion ?? '________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable ?? '________________', 'B', 1);

        // Línea divisoria
        $this->Ln(8);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(8);

        // --- Sección 3: Trazabilidad Control de Calidad ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '3. TRAZABILIDAD CONTROL DE CALIDAD', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Primer par de registros
        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(50, 8, $this->queja->maquina ?? '__________', 'B', 1);

        $this->Cell(40, 8, 'Operario:', 0, 0);
        $this->Cell(50, 8, $this->queja->operario ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod2 ?? '__________', 'B', 1);

        // Segundo par de registros
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(50, 8, $this->queja->maquina2 ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Operario:', 0, 0);
        $this->Cell(50, 8, $this->queja->operario2 ?? '__________', 'B', 1);

        // Datos corrugado e impresión - títulos
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(90, 8, 'Datos Corrugado:', 0, 0);
        $this->Cell(80, 8, 'Datos Impresión:', 0, 1);

        $this->SetFont('helvetica', '', 11);

        // Datos corrugado
        $this->Cell(20, 8, 'Materiales:', 0, 0);
        $this->Cell(25, 8, 'L. EXT', 0, 0);
        $this->Cell(25, 8, $this->queja->l_ext ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'C. MED', 0, 0);
        $this->Cell(25, 8, $this->queja->c_med ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'L. INT', 0, 0);
        $this->Cell(25, 8, $this->queja->l_int ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'ANCHO', 0, 0);
        $this->Cell(25, 8, $this->queja->ancho ?? '', 1, 1, 'C');

        // Datos impresión
        $this->Cell(25, 8, 'Tintas:', 0, 0);
        $this->Cell(25, 8, $this->queja->tinta1 ?? '', 1, 0, 'C');
        $this->Cell(25, 8, $this->queja->tinta2 ?? '', 1, 0, 'C');
        $this->Cell(25, 8, $this->queja->tinta3 ?? '', 1, 0, 'C');
        $this->Cell(30, 8, 'Lote:', 0, 0);
        $this->Cell(30, 8, $this->queja->lote ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'Control:', 0, 0);
        $this->Cell(25, 8, $this->queja->control ?? '', 1, 1, 'C');

        // Línea divisoria
        $this->Ln(8);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(8);

        // --- Sección 4: Acción Correctiva - Persona Responsable ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '4. ACCIÓN CORRECTIVA - PERSONA RESPONSABLE', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Causa del problema
        $this->MultiCell(0, 30, "Causa del problema:\n" . ($this->queja->causa_problema ?? "_____________________________________________________________"), 0, 'L');
        $this->Ln(5);

        // Acción correctiva y/o preventiva
        $this->MultiCell(0, 35, "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "_____________________________________________________________"), 0, 'L');

        // Fecha acción y responsable
        $this->Cell(50, 8, 'Fecha de la Acción:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_accion ?? '_________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_accion ?? '_________________', 'B', 1);

        // --- Pie de página ---
        $this->Ln(12);
        $this->Cell(80, 8, 'Recibe el reclamo:', 0, 0);
        $this->Cell(80, 8, 'Fecha y hora:', 0, 1);
        $this->Cell(80, 8, '______________________________', 0, 0);
        $this->Cell(80, 8, '______________________________', 0, 1);
    }
}
?>
