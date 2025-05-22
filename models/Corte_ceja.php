<?php

namespace Model;

class Corte_ceja extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_corte_ceja';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE_SIERRA',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $CUADRE_SIERRA;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->CUADRE_SIERRA = $args['CUADRE_SIERRA'] ?? '';
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
    $cuadreSierra = floatval($this->CUADRE_SIERRA);

    $this->TOTAL = round($cuadreSierra, 2);
    return $this->TOTAL;
}


}
