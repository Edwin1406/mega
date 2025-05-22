<?php

namespace Model;

class Doblado extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_doblado';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'MAL_DOBLADO_CEJA',
    'EXCESO_GOMA',
    'DESCUADRE_GOMA',
    'LAM_HUMEDA',
    'LAM_SECA',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $MAL_DOBLADO_CEJA;
    public $EXCESO_GOMA;
    public $DESCUADRE_GOMA;
    public $LAM_HUMEDA;
    public $LAM_SECA;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->MAL_DOBLADO_CEJA = $args['MAL_DOBLADO_CEJA'] ?? '';
        $this->EXCESO_GOMA = $args['EXCESO_GOMA'] ?? '';
        $this->DESCUADRE_GOMA = $args['DESCUADRE_GOMA'] ?? '';
        $this->LAM_HUMEDA = $args['LAM_HUMEDA'] ?? '';
        $this->LAM_SECA = $args['LAM_SECA'] ?? '';
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
        floatval($this->MAL_DOBLADO_CEJA) +
        floatval($this->EXCESO_GOMA) +
        floatval($this->DESCUADRE_GOMA) +
        floatval($this->LAM_HUMEDA) +
        floatval($this->LAM_SECA);
        
        
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}