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
    'APROBACION_COLOR',
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
    public $APROBACION_COLOR;
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
        $this->APROBACION_COLOR = $args['APROBACION_COLOR'] ?? '';
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
        floatval($this->APROBACION_COLOR);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}