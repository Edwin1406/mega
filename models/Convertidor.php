<?php

namespace Model;

class Convertidor extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_convertidor';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE',
    'CAMBIO_MEDIDA',
    'DIFERENCIA_PESO',
    'FILOS_ROTOS',
    'TOTAL'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $CUADRE;
    public $CAMBIO_MEDIDA;
    public $DIFERENCIA_PESO;
    public $FILOS_ROTOS;
    public $TOTAL;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->CAMBIO_MEDIDA = $args['CAMBIO_MEDIDA'] ?? '';
        $this->DIFERENCIA_PESO = $args['DIFERENCIA_PESO'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';  
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
        floatval($this->CUADRE) +
        floatval($this->CAMBIO_MEDIDA) +
        floatval($this->DIFERENCIA_PESO) +
        floatval($this->FILOS_ROTOS);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    return $this->TOTAL;
        
}




}