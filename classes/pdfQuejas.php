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
        $this->SetMargins(15, 15, 15);
        $this->SetAutoPageBreak(true, 15);

        // Fuentes y colores base
        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // --- Encabezado con logo y título ---
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(45, 20, 'MEGA STOCK', 0, 0, 'L');
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 20, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

        // --- Checkbox QUEJA y RECLAMO ---
        $this->SetFont('helvetica', '', 12);
        $this->SetXY(160, 18);
        $this->Cell(25, 8, 'QUEJA');
        $this->Rect(190, 19, 7, 7);
        $this->SetXY(160, 27);
        $this->Cell(25, 8, 'RECLAMO');
        $this->Rect(190, 28, 7, 7);

        // Línea divisoria después encabezado
        $this->SetLineWidth(0.8);
        $this->Line(15, 35, 195, 35);

        // --- SECCIÓN 1: INFORMACIÓN DEL RECLAMO ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34); // naranja brillante
        $this->Cell(0, 10, '1. INFORMACIÓN DEL RECLAMO', 0, 1);

        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 11);

        // Campos Fecha y Cliente
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha ?? '_________________________', 'B', 0);
        $this->Cell(25, 8, 'Cliente:', 0, 0);
        $this->Cell(70, 8, $this->queja->cliente ?? '_________________________', 'B', 1);

        // Pedido N°, Referencia, Fecha Factura
        $this->Cell(30, 8, 'Pedido N°:', 0, 0);
        $this->Cell(50, 8, $this->queja->pedido_numero ?? '__________', 'B', 0);
        $this->Cell(30, 8, 'Referencia:', 0, 0);
        $this->Cell(35, 8, $this->queja->referencia ?? '_________', 'B', 0);
        $this->Cell(35, 8, 'Fecha-Factura:', 0, 0);
        $this->Cell(20, 8, $this->queja->fecha_factura ?? '_________', 'B', 1);

        // Num Lote y Num Factura
        $this->Cell(30, 8, 'Num-Lote:', 0, 0);
        $this->Cell(60, 8, $this->queja->num_lote ?? '________________', 'B', 0);
        $this->Cell(30, 8, 'Num-Factura:', 0, 0);
        $this->Cell(55, 8, $this->queja->factura ?? '________________________', 'B', 1);

        // Descripción Producto (multilínea)
        $this->Cell(50, 8, 'Descripción de Producto:', 0, 1);
        $this->MultiCell(0, 25, $this->queja->descripcion_producto ?? "_____________________________________________________________", 0, 'L');

        // Motivo Reclamo (multilínea)
        $this->Cell(50, 8, 'Motivo del reclamo:', 0, 1);
        $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? "_____________________________________________________________", 0, 'L');

        // Persona y Cargo / Teléfono
        $this->Cell(80, 8, 'Persona que generará el reclamo (Cliente):', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '__________________________', 0, 1);

        $this->Cell(60, 8, 'Cargo o área de la empresa:', 0, 0);
        $this->Cell(80, 8, '____________________________', 'B', 0);
        $this->Cell(30, 8, 'Teléfono:', 0, 0);
        $this->Cell(0, 8, '________________________', 'B', 1);

        // Línea divisoria para sección 2
        $this->Ln(4);
        $this->SetLineWidth(0.6);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(6);

        // --- SECCIÓN 2: SOLUCIÓN INMEDIATA ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '2. SOLUCIÓN INMEDIATA', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Solución inmediata (multilínea)
        $this->MultiCell(0, 30, "Solución inmediata:\n" . ($this->queja->solucion_inmediata ?? "_________________________________________________________"), 0, 'L');

        // Checkboxes: VENTAS, DESPACHOS, PRODUCCIÓN
        $this->Ln(2);
        $checkboxes = ['VENTAS', 'DESPACHOS', 'PRODUCCIÓN'];
        foreach ($checkboxes as $ch) {
            $this->Cell(30, 8, $ch, 0, 0);
            $x = $this->GetX();
            $y = $this->GetY() + 2;
            $this->Rect($x, $y, 6, 6);
            $this->Cell(10, 8, '', 0, 0);
        }

        // Fecha solución
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

        // Línea divisoria para sección 3
        $this->Ln(6);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(6);

        // --- SECCIÓN 3: TRAZABILIDAD CONTROL DE CALIDAD ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '3. TRAZABILIDAD CONTROL DE CALIDAD', 0, 1);

        $this->SetFont('helvetica', '', 11);
        $this->SetTextColor(0);

        // Primera fila (2 registros)
        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(50, 8, $this->queja->maquina ?? '__________', 'B', 1);

        $this->Cell(40, 8, 'Operario:', 0, 0);
        $this->Cell(50, 8, $this->queja->operario ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_prod2 ?? '__________', 'B', 1);

        // Segunda fila (2 registros)
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

        // Datos corrugado - Materiales y medidas
        $this->Cell(20, 8, 'Materiales:', 0, 0);
        $this->Cell(25, 8, 'L. EXT', 0, 0);
        $this->Cell(25, 8, $this->queja->l_ext ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'C. MED', 0, 0);
        $this->Cell(25, 8, $this->queja->c_med ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'L. INT', 0, 0);
        $this->Cell(25, 8, $this->queja->l_int ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'ANCHO', 0, 0);
        $this->Cell(25, 8, $this->queja->ancho ?? '', 1, 1, 'C');

        // Datos impresión - tintas, lote, control
        $this->Cell(25, 8, 'Tintas:', 0, 0);
        $this->Cell(25, 8, $this->queja->tinta1 ?? '', 1, 0, 'C');
        $this->Cell(25, 8, $this->queja->tinta2 ?? '', 1, 0, 'C');
        $this->Cell(25, 8, $this->queja->tinta3 ?? '', 1, 0, 'C');
        $this->Cell(30, 8, 'Lote:', 0, 0);
        $this->Cell(30, 8, $this->queja->lote ?? '', 1, 0, 'C');
        $this->Cell(25, 8, 'Control:', 0, 0);
        $this->Cell(25, 8, $this->queja->control ?? '', 1, 1, 'C');

        // Línea divisoria para sección 4
        $this->Ln(5);
        $this->Line(15, $this->GetY(), 195, $this->GetY());
        $this->Ln(6);

        // --- SECCIÓN 4: ACCIÓN CORRECTIVA PERSONA RESPONSABLE ---
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(255, 87, 34);
        $this->Cell(0, 10, '4. ACCIÓN CORRECTIVA - PERSONA RESPONSABLE', 0, 1);

        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 11);

        // Causa problema
        $this->MultiCell(0, 25, "Causa del problema:\n" . ($this->queja->causa_problema ?? "__________________________________________________________"), 0, 'L');
        $this->Ln(5);

        // Acción correctiva y/o preventiva
        $this->MultiCell(0, 30, "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "__________________________________________________________"), 0, 'L');

        // Fecha acción y responsable
        $this->Cell(50, 8, 'Fecha de la Acción:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_accion ?? '_________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_accion ?? '_________________', 'B', 1);

        // --- Pie de página con recepción ---
        $this->Ln(10);
        $this->Cell(80, 8, 'Recibe el reclamo:', 0, 0);
        $this->Cell(80, 8, 'Fecha y hora:', 0, 1);
        $this->Cell(80, 8, '______________________________', 0, 0);
        $this->Cell(80, 8, '______________________________', 0, 1);
    }
}
