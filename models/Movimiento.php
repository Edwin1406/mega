<?php

namespace Model;


class Movimiento  extends ActiveRecord
{
    protected static $tabla = 'movimientos_stock';
    protected static $columnasDB = ['id', 'id_producto','id_area','tipo_movimiento','cantidad','fecha_movimiento'];

    public $id;
    public $id_producto;
    public $id_area;
    public $tipo_movimiento;
    public $cantidad;
    public $fecha_movimiento;


    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        $this->id_area = $args['id_area'] ?? '';
        $this->tipo_movimiento = $args['tipo_movimiento'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->fecha_movimiento = $args['fecha_movimiento'] ?? date('Y-m-d H:i:s');

    }


    
}

