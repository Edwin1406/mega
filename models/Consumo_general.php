<?php

namespace Model;

class Consumo_general extends ActiveRecord
{
    
protected static $tabla = 'consumo_general';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'total_general',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $total_general;
    public $created_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->total_general = $args['total_general'] ?? '';
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function validar()
    {
        if (!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El tipo de máquina es obligatorio';
        }
        if (!$this->total_general) {
            self::$alertas['error'][] = 'El total general es obligatorio';
        } elseif (!is_numeric($this->total_general)) {
            self::$alertas['error'][] = 'El total general debe ser un número';
        }
        return self::$alertas;
    }

    




}
