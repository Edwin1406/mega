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
        $this->SetMargins(10, 10, 10);
        $this->SetAutoPageBreak(true, 10);
        $this->SetFont('helvetica', '', 10);

        // --- Encabezado y logo ---
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 16);
        $this->Rect(10, 10, 40, 30, 'F'); // barra naranja logo
        $this->SetXY(10, 15);
        $this->Cell(40, 20, "MEGA\nSTOCK", 0, 0, 'C');

        $this->SetTextColor(0);
        $this->SetFont('helvetica', 'B', 14);
        $this->SetXY(55, 15);
        $this->Cell(0, 10, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');

        // Checkbox QUEJA / RECLAMO
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(160, 10);
        $this->Cell(25, 10, 'QUEJA');
        $this->Rect(190, 12, 8, 8);
        $this->Ln(12);
        $this->SetX(160);
        $this->Cell(30, 10, 'RECLAMO');
        $this->Rect(190, 24, 8, 8);

        // ----------------------------
        // 1. INFORMACIÓN DEL RECLAMO - barra lateral vertical naranja
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Rect(10, 45, 20, 115, 'F');
        $this->SetXY(10, 45);
        $this->MultiCell(20, 6, "1.- INFORMACIÓN\nDEL RECLAMO.\nCLIENTE / VENTAS / DESPACHOS", 0, 'C');

        // Sección 1 contenido
        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(35, 45);

        // Primera fila: Fecha - Cliente
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(65, 8, $this->queja->fecha ?? '____________________', 'B', 0);
        $this->Cell(20, 8, 'Cliente:', 0, 0);
        $this->Cell(55, 8, $this->queja->cliente ?? '_____________________________', 'B', 1);

        // Segunda fila: Pedido N° - Referencia - Fecha-Factura
        $this->Cell(30, 8, 'Pedido N°:', 0, 0);
        $this->Cell(50, 8, $this->queja->pedido_numero ?? '__________', 'B', 0);
        $this->Cell(25, 8, 'Referencia:', 0, 0);
        $this->Cell(25, 8, $this->queja->referencia ?? '________', 'B', 0);
        $this->Cell(30, 8, 'Fecha-Factura:', 0, 0);
        $this->Cell(25, 8, $this->queja->fecha_factura ?? '__________', 'B', 1);

        // Tercera fila: Num-Lote - Num-Factura
        $this->Cell(30, 8, 'Num-Lote:', 0, 0);
        $this->Cell(50, 8, $this->queja->num_lote ?? '____________________', 'B', 0);
        $this->Cell(30, 8, 'Num-Factura:', 0, 0);
        $this->Cell(55, 8, $this->queja->factura ?? '_________________________', 'B', 1);

        // Descripción de Producto
        $this->Cell(50, 8, 'Descripción de Producto:', 0, 1);
        $this->MultiCell(0, 25, $this->queja->descripcion_producto ?? "__________________________________________________________", 0, 'L');

        // Motivo del reclamo
        $this->Cell(50, 8, 'Motivo del reclamo:', 0, 1);
        $this->MultiCell(0, 30, $this->queja->motivo_reclamo ?? "__________________________________________________________", 0, 'L');

        // Persona que generará el reclamo (Cliente)
        $this->Cell(90, 8, 'Persona que generará el reclamo (Cliente):', 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? '_____________________________', 0, 1);

        // Cargo o área y teléfono
        $this->Cell(50, 8, 'Cargo o área de la empresa:', 0, 0);
        $this->Cell(80, 8, '_____________________________', 'B', 0);
        $this->Cell(20, 8, 'Teléfono:', 0, 0);
        $this->Cell(0, 8, '________________________', 'B', 1);

        // ----------------------------
        // 2. SOLUCIÓN INMEDIATA - barra lateral naranja
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Rect(10, 160, 20, 85, 'F');
        $this->SetXY(10, 160);
        $this->MultiCell(20, 6, "2.- SOLUCIÓN\nINMEDIATA\nVENTAS / DESPACHOS / PRODUCCIÓN", 0, 'C');

        // Contenido sección 2
        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(35, 160);

        // Solución inmediata texto largo
        $this->MultiCell(0, 30, "Solución inmediata:\n" . ($this->queja->solucion_inmediata ?? "__________________________________________________________"), 0, 'L');

        // Checkboxes: VENTAS, DESPACHOS, PRODUCCIÓN
        $this->SetXY(35, 195);
        $checkboxes = ['VENTAS', 'DESPACHOS', 'PRODUCCIÓN'];
        foreach ($checkboxes as $ch) {
            $this->Cell(30, 8, $ch, 0, 0);
            $x = $this->GetX();
            $y = $this->GetY() + 2;
            $this->Rect($x, $y, 6, 6);
            $this->Cell(10, 8, '', 0, 0);
        }

        // Fecha
        $this->Cell(25, 8, 'Fecha:', 0, 0);
        $this->Cell(40, 8, $this->queja->fecha_solucion ?? '__________', 'B', 1);

        // Clasificación / Arreglo - SI NO + Buenas
        $this->Cell(40, 8, 'Clasificación / Arreglo:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $x = $this->GetX(); $y = $this->GetY() + 2;
        $this->Rect($x, $y, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(30, 8, 'Buenas:', 0, 0);
        $this->Cell(40, 8, $this->queja->buenas ?? '_______', 'B', 1);

        // Reposición - SI NO + Autorizado por
        $this->Cell(40, 8, 'Reposición:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(50, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Genera Nota Crédito - SI NO + Autorizado por
        $this->Cell(40, 8, 'Genera Nota Crédito:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(15, 8, 'NO', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(50, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Genera Descuento - SI % + Autorizado por
        $this->Cell(40, 8, 'Genera Descuento:', 0, 0);
        $this->Cell(15, 8, 'SI', 0, 0);
        $x = $this->GetX();
        $this->Rect($x, $y, 6, 6);
        $this->Cell(15, 8, '%', 0, 0);
        $this->Cell(20, 8, $this->queja->descuento ?? '___', 'B', 0);
        $this->Cell(50, 8, 'Autorizado por:', 0, 0);
        $this->Cell(50, 8, '_________________________', 'B', 1);

        // Fecha solución y responsable
        $this->Cell(50, 8, 'Fecha de la Solución:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_solucion ?? '_________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable ?? '_________________', 'B', 1);

        // ----------------------------
        // 3. TRAZABILIDAD CONTROL DE CALIDAD - barra lateral naranja
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Rect(10, 250, 20, 80, 'F');
        $this->SetXY(10, 250);
        $this->MultiCell(20, 6, "3.- TRAZABILIDAD\nCONTROL DE CALIDAD", 0, 'C');

        // Sección 3 contenido
        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(35, 250);

        // Filas Fecha-Prod - Máquina - Operario (2 filas)
        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_prod ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(40, 8, $this->queja->maquina ?? '__________', 'B', 1);
        $this->Cell(40, 8, 'Operario:', 0, 0);
        $this->Cell(60, 8, $this->queja->operario ?? '__________', 'B', 1);

        $this->Cell(40, 8, 'Fecha-Prod:', 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_prod2 ?? '__________', 'B', 0);
        $this->Cell(40, 8, 'Máquina:', 0, 0);
        $this->Cell(40, 8, $this->queja->maquina2 ?? '__________', 'B', 1);
        $this->Cell(40, 8, 'Operario:', 0, 0);
        $this->Cell(60, 8, $this->queja->operario2 ?? '__________', 'B', 1);

        // Datos Corrugado y Datos impresión tablas resumidas
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(90, 8, 'Datos Corrugado:', 0, 0, 'L');
        $this->Cell(70, 8, 'Datos Impresión:', 0, 1, 'L');

        $this->SetFont('helvetica', '', 10);

        // Primera fila materiales y tintas
        $this->Cell(25, 8, 'Materiales:', 0, 0);
        $this->Cell(20, 8, 'L. EXT', 0, 0);
        $this->Cell(20, 8, $this->queja->l_ext ?? '', 1, 0, 'C');
        $this->Cell(20, 8, 'C. MED', 0, 0);
        $this->Cell(20, 8, $this->queja->c_med ?? '', 1, 0, 'C');
        $this->Cell(20, 8, 'L. INT', 0, 0);
        $this->Cell(20, 8, $this->queja->l_int ?? '', 1, 0, 'C');
        $this->Cell(20, 8, 'ANCHO', 0, 0);
        $this->Cell(20, 8, $this->queja->ancho ?? '', 1, 0, 'C');

        $this->Cell(15, 8, 'Tintas:', 0, 0);
        $this->Cell(20, 8, $this->queja->tinta1 ?? '', 1, 0, 'C');
        $this->Cell(20, 8, $this->queja->tinta2 ?? '', 1, 0, 'C');
        $this->Cell(20, 8, $this->queja->tinta3 ?? '', 1, 0, 'C');
        $this->Cell(15, 8, 'Lote:', 0, 0);
        $this->Cell(20, 8, $this->queja->lote ?? '', 1, 0, 'C');
        $this->Cell(15, 8, 'Control:', 0, 1);
        $this->Cell(20, 8, $this->queja->control ?? '', 1, 1, 'C');

        // ----------------------------
        // 4. ACCIÓN CORRECTIVA - barra lateral naranja
        $this->SetFillColor(255, 140, 0);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 9);
        $this->Rect(10, 335, 20, 60, 'F');
        $this->SetXY(10, 335);
        $this->MultiCell(20, 6, "4.- ACCIÓN\nCORRECTIVA\nPERSONA RESPONSABLE", 0, 'C');

        // Contenido sección 4
        $this->SetTextColor(0);
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(35, 335);

        $this->MultiCell(0, 20, "Causa del problema:\n" . ($this->queja->causa_problema ?? "__________________________________________________"), 0, 'L');
        $this->Ln(5);
        $this->MultiCell(0, 25, "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "__________________________________________________"), 0, 'L');

        $this->Cell(50, 8, 'Fecha de la Acción:', 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_accion ?? '_________________', 'B', 0);
        $this->Cell(40, 8, 'Responsable:', 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_accion ?? '_________________', 'B', 1);

        // ----------------------------
        // Pie de página - recibe el reclamo y fecha/hora
        $this->Ln(8);
        $this->Cell(80, 8, 'Recibe el reclamo:', 0, 0);
        $this->Cell(80, 8, 'Fecha y hora:', 0, 1);
        $this->Cell(80, 8, '______________________________', 0, 0);
        $this->Cell(80, 8, '______________________________', 0, 1);
    }
}
