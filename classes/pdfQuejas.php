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
        $this->SetFont('helvetica', '', 10);

        // --- Colores y estilos ---
        $orange = [255, 140, 0];
        $lightGrey = [230, 230, 230];
        $black = [0, 0, 0];

        // --- Encabezado ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(40, 25, "MEGA\nSTOCK", 1, 0, 'C', true);

      
        
        $this->SetTextColor(0);
        $this->SetFont('helvetica', 'B', 14);
        $this->SetXY(55, 15);
        $this->Cell(0, 10, 'FORMATO DE QUEJAS Y RECLAMOS', 0, 1, 'C');
        
        // Checkbox QUEJA / RECLAMO
        $this->SetFont('helvetica', '', 10);
        $this->SetXY(160, 10);
        $this->Cell(25, 10, 'QUEJA', 0, 0, 'L');
        $this->Rect(190, 12, 8, 8);
        $this->SetXY(160, 22);
        $this->Cell(30, 10, 'RECLAMO', 0, 0, 'L');
        $this->Rect(190, 24, 8, 8);
        $this->Ln(15);




        // --- Sección 1: INFORMACIÓN DEL RECLAMO ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(0, 10, "1.- INFORMACIÓN DEL RECLAMO", 1, 1, 'L', true);

        $this->SetTextColor(...$black);
        $this->SetFont('helvetica', '', 10);

        // Fecha y Cliente
        $this->Cell(25, 8, "Fecha:", 0, 0);
        $this->Cell(60, 8, $this->queja->fecha ?? "", 'B', 0);
        $this->Cell(30, 8, "Cliente:", 0, 0);
        $this->Cell(0, 8, $this->queja->cliente ?? "", 'B', 1);

        // Pedido N°, Referencia, Fecha Factura
        $this->Cell(30, 8, "Pedido N°:", 0, 0);
        $this->Cell(40, 8, $this->queja->pedido_numero ?? "", 'B', 0);
        $this->Cell(25, 8, "Referencia:", 0, 0);
        $this->Cell(40, 8, $this->queja->referencia ?? "", 'B', 0);
        $this->Cell(30, 8, "Fecha-Factura:", 0, 0);
        $this->Cell(0, 8, $this->queja->fecha_factura ?? "", 'B', 1);

        // Num Lote y Factura
        $this->Cell(30, 8, "Num-Lote:", 0, 0);
        $this->Cell(40, 8, $this->queja->num_lote ?? "", 'B', 0);
        $this->Cell(30, 8, "Num-Factura:", 0, 0);
        $this->Cell(0, 8, $this->queja->factura ?? "", 'B', 1);

        // Descripción Producto
        $this->Ln(3);
        $this->Cell(0, 8, "Descripción de Producto:", 0, 1);
        $this->MultiCell(0, 20, $this->queja->descripcion_producto ?? "", 1, 'L', false, 1);

        // Motivo del reclamo
        $this->Ln(3);
        $this->Cell(0, 8, "Motivo del reclamo:", 0, 1);
        $this->MultiCell(0, 25, $this->queja->motivo_reclamo ?? "_", 1, 'L', false, 1);

        // Persona que genera reclamo, Cargo, Teléfono
        $this->Ln(3);
        $this->Cell(90, 8, "Persona que generará el reclamo (Cliente):", 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? "_", 'B', 1);
        $this->Cell(50, 8, "Cargo o área de la empresa:", 0, 0);
        $this->Cell(80, 8, "", 'B', 0);
        $this->Cell(20, 8, "Teléfono:", 0, 0);
        $this->Cell(0, 8, "", 'B', 1);

        $this->Ln(8);

        // --- Sección 2: SOLUCIÓN INMEDIATA ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(0, 10, "2.- SOLUCIÓN INMEDIATA", 1, 1, 'L', true);

        $this->SetTextColor(...$black);
        $this->SetFont('helvetica', '', 10);

        $solucion = "Solución inmediata:\n" . ($this->queja->solucion_inmediata ?? "_______________");
        $this->MultiCell(0, 35, $solucion, 1, 'L', false, 1);

        $this->Ln(3);

        // Checkboxes alineados
        $checkboxes = ['VENTAS', 'DESPACHOS', 'PRODUCCIÓN'];
        $this->SetFont('helvetica', '', 10);
        $startX = $this->GetX();
        foreach ($checkboxes as $checkbox) {
            $this->Cell(40, 8, $checkbox, 0, 0, 'L');
            $this->Rect($this->GetX() - 12, $this->GetY() + 2, 6, 6);
        }
        $this->Ln(12);

        // Fecha solución
        $this->Cell(30, 8, "Fecha:", 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_solucion ?? "__________", 'B', 1);

        // Clasificación / Arreglo con checkboxes SI/NO + Buenas
        $this->Cell(55, 8, "Clasificación / Arreglo:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(20, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(25, 8, "Buenas:", 0, 0);
        $this->Cell(40, 8, $this->queja->buenas ?? "_______", 'B', 1);

        // Reposición SI/NO + Autorizado por
        $this->Cell(55, 8, "Reposición:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(20, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(50, 8, "Autorizado por:", 0, 0);
        $this->Cell(50, 8, "_________________________", 'B', 1);

        // Genera Nota Crédito SI/NO + Autorizado por
        $this->Cell(55, 8, "Genera Nota Crédito:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(20, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(50, 8, "Autorizado por:", 0, 0);
        $this->Cell(50, 8, "_________________________", 'B', 1);

        // Genera Descuento SI/% + Autorizado por
        $this->Cell(55, 8, "Genera Descuento:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(20, 8, "%", 0, 0);
        $this->Cell(20, 8, $this->queja->descuento ?? "___", 'B', 0);
        $this->Cell(50, 8, "Autorizado por:", 0, 0);
        $this->Cell(50, 8, "_________________________", 'B', 1);

        // Fecha solución y responsable
        $this->Cell(50, 8, "Fecha de la Solución:", 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_solucion ?? "_________________", 'B', 0);
        $this->Cell(40, 8, "Responsable:", 0, 0);
        $this->Cell(0, 8, $this->queja->responsable ?? "_________________", 'B', 1);

        $this->Ln(8);

        // --- Sección 3: TRAZABILIDAD CONTROL DE CALIDAD ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(0, 10, "3.- TRAZABILIDAD CONTROL DE CALIDAD", 1, 1, 'L', true);

        $this->SetTextColor(...$black);
        $this->SetFont('helvetica', '', 10);

        // Primer fila de datos
        $this->Cell(40, 8, "Fecha-Prod:", 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_prod ?? "__________", 'B', 0);
        $this->Cell(40, 8, "Máquina:", 0, 0);
        $this->Cell(40, 8, $this->queja->maquina ?? "__________", 'B', 1);

        // Segunda fila de datos
        $this->Cell(40, 8, "Operario:", 0, 0);
        $this->Cell(60, 8, $this->queja->operario ?? "__________", 'B', 0);
        $this->Cell(40, 8, "Fecha-Prod:", 0, 0);
        $this->Cell(40, 8, $this->queja->fecha_prod2 ?? "__________", 'B', 1);

        // Tercera fila de datos
        $this->Cell(40, 8, "Máquina:", 0, 0);
        $this->Cell(60, 8, $this->queja->maquina2 ?? "__________", 'B', 0);
        $this->Cell(40, 8, "Operario:", 0, 0);
        $this->Cell(40, 8, $this->queja->operario2 ?? "__________", 'B', 1);

        $this->Ln(5);

        // Datos Corrugado y Datos Impresión
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(90, 8, "Datos Corrugado:", 0, 0);
        $this->Cell(0, 8, "Datos Impresión:", 0, 1);

        $this->SetFont('helvetica', '', 10);

        $this->Cell(25, 8, "Materiales:", 0, 0);
        $this->Cell(20, 8, "L. EXT", 0, 0);
        $this->Cell(20, 8, $this->queja->l_ext ?? "", 1, 0, 'C');
        $this->Cell(20, 8, "C. MED", 0, 0);
        $this->Cell(20, 8, $this->queja->c_med ?? "", 1, 0, 'C');
        $this->Cell(20, 8, "L. INT", 0, 0);
        $this->Cell(20, 8, $this->queja->l_int ?? "", 1, 0, 'C');
        $this->Cell(20, 8, "ANCHO", 0, 0);
        $this->Cell(20, 8, $this->queja->ancho ?? "", 1, 0, 'C');

        $this->Cell(15, 8, "Tintas:", 0, 0);
        $this->Cell(20, 8, $this->queja->tinta1 ?? "", 1, 0, 'C');
        $this->Cell(20, 8, $this->queja->tinta2 ?? "", 1, 0, 'C');
        $this->Cell(20, 8, $this->queja->tinta3 ?? "", 1, 0, 'C');
        $this->Cell(15, 8, "Lote:", 0, 0);
        $this->Cell(20, 8, $this->queja->lote ?? "", 1, 0, 'C');
        $this->Cell(15, 8, "Control:", 0, 1);
        $this->Cell(20, 8, $this->queja->control ?? "", 1, 1, 'C');

        $this->Ln(8);

        // --- Sección 4: ACCIÓN CORRECTIVA ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(0, 10, "4.- ACCIÓN CORRECTIVA", 1, 1, 'L', true);

        $this->SetTextColor(...$black);
        $this->SetFont('helvetica', '', 10);

        $causa = "Causa del problema:\n" . ($this->queja->causa_problema ?? "_________________________________");
        $this->MultiCell(0, 25, $causa, 1, 'L', false, 1);

        $this->Ln(3);

        $accion = "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "_________________________________");
        $this->MultiCell(0, 25, $accion, 1, 'L', false, 1);

        $this->Cell(50, 8, "Fecha de la Acción:", 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_accion ?? "_________________", 'B', 0);
        $this->Cell(40, 8, "Responsable:", 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_accion ?? "_________________", 'B', 1);

        $this->Ln(12);

        // --- Pie de página ---
        $this->Cell(80, 8, "Recibe el reclamo:", 0, 0);
        $this->Cell(80, 8, "Fecha y hora:", 0, 1);
        $this->Cell(80, 8, "______________________________", 0, 0);
        $this->Cell(80, 8, "______________________________", 0, 1);
    }
}
