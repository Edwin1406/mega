<?php

namespace Model;

class Troquel extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_troquel';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'COMBADO',
    'MERMA',
    'EXCEDENTES_PLANCHAS',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $COMBADO;
    public $MERMA;
    public $EXCEDENTES_PLANCHAS;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->MERMA = $args['MERMA'] ?? '';
        $this->EXCEDENTES_PLANCHAS = $args['EXCEDENTES_PLANCHAS'] ?? '';     
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
        floatval($this->COMBADO) +
        floatval($this->MERMA) +
        floatval($this->EXCEDENTES_PLANCHAS);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}