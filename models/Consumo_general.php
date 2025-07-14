<?php

namespace Model;

class Consumo_general extends ActiveRecord
{
    
protected static $tabla = 'consumo_general';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $created_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function validar()
    {
        if (!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El tipo de máquina es obligatorio';
        }
        return self::$alertas;
    }

    




}
