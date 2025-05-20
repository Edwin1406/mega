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
        $this->SetXY(20, 15);
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
        $this->Cell(15, 8, "Cliente:", 0, 0);
        $this->Cell(0, 8, $this->queja->cliente ?? "", 'B', 1);

        // Pedido N°, Referencia, Fecha Factura
        $this->Cell(20, 8, "Pedido N°:", 0, 0);
        $this->Cell(40, 8, $this->queja->pedido_numero ?? "", 'B', 0);
        $this->Cell(25, 8, "Referencia:", 0, 0);
        $this->Cell(40, 8, $this->queja->referencia ?? "", 'B', 0);
        $this->Cell(30, 8, "Fecha-Factura:", 0, 0);
        $this->Cell(0, 8, $this->queja->fecha_factura ?? "", 'B', 1);

        // Num Lote y Factura
        $this->Cell(20, 8, "Num-Lote:", 0, 0);
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
        $this->Cell(70, 8, "Persona que generará el reclamo (Cliente):", 0, 0);
        $this->Cell(0, 8, $this->queja->per_reporta_reclamo ?? "_", 'B', 1);
        $this->Cell(50, 8, "Cargo o área de la empresa:", 0, 0);
        $this->Cell(50, 8, "", 'B', 0);
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

        $solucion = "Solución inmediata:\n" . ($this->queja->solucion_inmediata ?? "");
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
         $this->Cell(20, 10, "Fecha:", 0, 0);
        $this->Cell(40, 8, $this->queja->fecha_solucion ?? "", 'B', 1);
        $this->Ln(10);

        // Fecha solución
       

        // Clasificación / Arreglo con checkboxes SI/NO + Buenas
        $this->Cell(55, 8, "Clasificación / Arreglo:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(22, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(25, 8, "Buenas:", 0, 0);
        $this->Cell(40, 8, $this->queja->buenas ?? "", 'B', 1);

        // Reposición SI/NO + Autorizado por
        $this->Cell(55, 8, "Reposición:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(22, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(25, 8, "Autorizado por:", 0, 0);
        $this->Cell(40, 8, "", 'B', 1);

        // Genera Nota Crédito SI/NO + Autorizado por
        $this->Cell(55, 8, "Genera Nota Crédito:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(22, 8, "NO", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(25, 8, "Autorizado por:", 0, 0);
        $this->Cell(40, 8, "", 'B', 1);

        // Genera Descuento SI/% + Autorizado por
        $this->Cell(55, 8, "Genera Descuento:", 0, 0);
        $this->Cell(20, 8, "SI", 0, 0);
        $this->Rect($this->GetX() - 14, $this->GetY() + 2, 6, 6);
        $this->Cell(1, 8, "%", 0, 0);
        $this->Cell(20, 8, $this->queja->descuento ?? "", 'B', 0);
        $this->Cell(25, 8, "Autorizado por:", 0, 0);
        $this->Cell(40, 8, "", 'B', 1);

        // Fecha solución y responsable
        $this->Cell(40, 8, "Fecha de la Solución:", 0, 0);
        $this->Cell(60, 8, $this->queja->fecha_solucion ?? "", 'B', 0);
        $this->Cell(20, 8, "Responsable:", 0, 0);
        $this->Cell(40, 8, $this->queja->responsable ?? "", 'B', 1);

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
        $this->Cell(60, 8, $this->queja->fecha_prod ?? "", 'B', 0);
        $this->Cell(40, 8, "Máquina:", 0, 0);
        $this->Cell(40, 8, $this->queja->maquina ?? "", 'B', 1);

        // Segunda fila de datos
        $this->Cell(40, 8, "Operario:", 0, 0);
        $this->Cell(60, 8, $this->queja->operario ?? "", 'B', 0);
        $this->Cell(40, 8, "Fecha-Prod:", 0, 0);
        $this->Cell(40, 8, $this->queja->fecha_prod2 ?? "", 'B', 1);

        // Tercera fila de datos
        $this->Cell(40, 8, "Máquina:", 0, 0);
        $this->Cell(60, 8, $this->queja->maquina2 ?? "", 'B', 0);
        $this->Cell(40, 8, "Operario:", 0, 0);
        $this->Cell(40, 8, $this->queja->operario2 ?? "", 'B', 1);

        $this->Ln(5);

        // Datos Corrugado y Datos Impresión
// Títulos
$this->SetFont('helvetica', 'B', 10);
$this->Cell(60, 6, "Datos Corrugado:", 0, 0);
$this->Cell(60, 6, "", 0, 0);
$this->Cell(60, 6, "Datos Impresión:", 0, 1);

$this->Ln(2);

// ---------------------- BLOQUE 1: Corrugado - Materiales ----------------------
$this->SetFont('helvetica', '', 9);
$startY = $this->GetY();
$startX = $this->GetX();

$this->SetXY($startX, $startY);
$this->Cell(25, 5, "Materiales:", 0, 1);
$labels = ["L. EXT", "C. MED", "L. INT", "ANCHO"];
foreach ($labels as $i => $label) {
    $value = $this->queja->{strtolower(str_replace('.', '', str_replace(' ', '_', $label)))} ?? "";
    $this->Cell(20, 5, $label, 0, 0);
    $this->Cell(25, 5, $value, 1, 1, 'C');
}

// ---------------------- BLOQUE 2: Corrugado - ECT, FCT, PAT ----------------------
$this->SetXY($startX + 50, $startY + 5);
$etiquetas2 = ["ECT", "FCT", "PAT", "PAT", "PESO"];
$valores2 = [
    $this->queja->ect ?? "",
    $this->queja->fct ?? "",
    $this->queja->pat1 ?? "",
    $this->queja->pat2 ?? "",
    $this->queja->peso ?? ""
];
foreach ($etiquetas2 as $i => $etiqueta) {
    $this->Cell(20, 5, $etiqueta, 0, 0);
    $this->Cell(25, 5, $valores2[$i], 1, 1, 'C');
}

// ---------------------- BLOQUE 3: Impresión - Tintas ----------------------
$this->SetXY($startX + 100, $startY + 5);
for ($i = 1; $i <= 4; $i++) {
    $this->Cell(20, 5, "GCMI", 0, 0);
    $tinta = 'tinta' . $i;
    $this->Cell(25, 5, $this->queja->$tinta ?? "", 1, 1, 'C');
}

// ---------------------- BLOQUE 4: Lote ----------------------
$this->SetXY($startX + 150, $startY + 5);
$this->Cell(20, 5, "", 0, 1); // espacio visual
$this->Cell(25, 5, "", 1, 1); // espacio 1
$this->Cell(25, 5, "", 1, 1); // espacio 2
$this->Cell(25, 5, "", 1, 1); // espacio 3
$this->Cell(25, 5, "", 1, 1); // espacio 4
$this->Cell(25, 5, $this->queja->lote ?? "", 1, 1, 'C');

// ---------------------- BLOQUE 5: Control ----------------------
$this->SetXY($startX + 180, $startY + 5);
$this->Cell(20, 5, "", 0, 1); // espacio visual
$this->Cell(25, 5, "", 1, 1); // espacio 1
$this->Cell(25, 5, "", 1, 1); // espacio 2
$this->Cell(25, 5, "", 1, 1); // espacio 3
$this->Cell(25, 5, "", 1, 1); // espacio 4
$this->Cell(25, 5, $this->queja->control ?? "", 1, 1, 'C');


        $this->Ln(8);

        // --- Sección 4: ACCIÓN CORRECTIVA ---
        $this->SetFillColor(...$orange);
        $this->SetTextColor(255);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(0, 10, "4.- ACCIÓN CORRECTIVA", 1, 1, 'L', true);

        $this->SetTextColor(...$black);
        $this->SetFont('helvetica', '', 10);

        $causa = "Causa del problema:\n" . ($this->queja->causa_problema ?? "");
        $this->MultiCell(0, 25, $causa, 1, 'L', false, 1);

        $this->Ln(3);

        $accion = "Acción correctiva y/o preventiva:\n" . ($this->queja->accion_correctiva ?? "");
        $this->MultiCell(0, 25, $accion, 1, 'L', false, 1);

        $this->Cell(50, 8, "Fecha de la Acción:", 0, 0);
        $this->Cell(50, 8, $this->queja->fecha_accion ?? "", 'B', 0);
        $this->Cell(40, 8, "Responsable:", 0, 0);
        $this->Cell(0, 8, $this->queja->responsable_accion ?? "", 'B', 1);

        $this->Ln(12);

        // --- Pie de página ---
        $this->Cell(80, 8, "Recibe el reclamo:", 0, 0);
        $this->Cell(80, 8, "Fecha y hora:", 0, 1);
        $this->Cell(80, 8, "", 0, 0);
        $this->Cell(80, 8, "", 0, 1);
    }
}
