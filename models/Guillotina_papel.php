<?php

namespace Model;

class Guillotina_papel extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_guillotina_papel';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'INICIO_CORRIDA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at',




  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $INICIO_CORRIDA;
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->INICIO_CORRIDA = $args['INICIO_CORRIDA'] ?? '';
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->created_at = date('Y-m-d');
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }

public function calcularTotal()
{
    $inicio_corrida = floatval($this->INICIO_CORRIDA);
    // Si quieres usar el valor de $refiles como total:
    $this->TOTAL = round($inicio_corrida, 2);
    return $this->TOTAL;
}



}
