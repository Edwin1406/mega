<?php

namespace Model;

class Preprinter extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_preprinter';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'hola',
    'mdo',
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $hola;
    public $mdo;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->hola = $args['hola'] ?? '';
        $this->mdo = $args['mdo'] ?? '';
     
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }





}