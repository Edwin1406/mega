<?php

namespace Model;

class Preprinter extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_preprinter';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'FALTA_TINTA',
    'DERRAME_TINTA',
    'VISCOSIDAD',
    'PH',
    'CUADRE',
    'EMPALME',
    'APROBACION_COLOR',
    'FILOS_ROTOS',
    'CIREL_CORTADO',
    'ELECTRICO',
    'MECANICO',
    'SUSTRATO',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $FALTA_TINTA;
    public $DERRAME_TINTA;
    public $VISCOSIDAD;
    public $PH;
    public $CUADRE;
    public $EMPALME;
    public $APROBACION_COLOR;
    public $FILOS_ROTOS;
    public $CIREL_CORTADO;
    public $ELECTRICO;
    public $MECANICO;
    public $SUSTRATO;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->FALTA_TINTA = $args['FALTA_TINTA'] ?? '';
        $this->DERRAME_TINTA = $args['DERRAME_TINTA'] ?? '';
        $this->VISCOSIDAD = $args['VISCOSIDAD'] ?? '';
        $this->PH = $args['PH'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->EMPALME = $args['EMPALME'] ?? '';
        $this->APROBACION_COLOR = $args['APROBACION_COLOR'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';
        $this->CIREL_CORTADO = $args['CIREL_CORTADO'] ?? '';
        $this->ELECTRICO = $args['ELECTRICO'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->SUSTRATO = $args['SUSTRATO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
     
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }

public function calcularTotal()
{
    $this->TOTAL =  
        floatval($this->FALTA_TINTA) +
        floatval($this->DERRAME_TINTA) +
        floatval($this->VISCOSIDAD) +
        floatval($this->PH) +
        floatval($this->CUADRE) +
        floatval($this->EMPALME) +
        floatval($this->APROBACION_COLOR);
        floatval($this->FILOS_ROTOS) +
        floatval($this->CIREL_CORTADO) +
        floatval($this->ELECTRICO) +
        floatval($this->MECANICO) +
        floatval($this->SUSTRATO);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}