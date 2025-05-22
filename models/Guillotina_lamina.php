<?php

namespace Model;

class Guillotina_lamina extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_guillotina_lamina';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'REFILES',
    'TOTAL',
    'PORCENTAJE',
    'created_at',




  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $REFILES;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->REFILES = $args['REFILES'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
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
    $refiles = floatval($this->REFILES);

    // Si quieres usar el valor de $refiles como total:
    $this->TOTAL = round($refiles, 2);

    // Asegurarte que TOTAL es un número antes de dividir
    $this->PORCENTAJE = ((floatval($this->TOTAL) / 100) * 100);

    return $this->TOTAL;
}


}
