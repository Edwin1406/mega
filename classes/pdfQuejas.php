<?php
namespace Classes;
use TCPDF;
class pdfQuejas extends TCPDF 
{
   

    
    public function generarPdf($materias)
    {
       
    
        
    }

    


    

    public function verPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'I');
    }

    public function guardarPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'F');
    }

    public function enviarPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'E');
    }

    public function imprimirPdf($quejas)
    {
        $this->generarPdf($quejas);
        $this->Output('reporte.pdf', 'I');
    }

    public function __construct()
    {
        parent::__construct();
    }


}

