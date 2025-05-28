<?php

namespace Model;

class IngresoConsumo extends ActiveRecord {
    protected static $tabla = 'ingresos_consumo';
    protected static $columnasDB = ['id', 'id_orden', 'consumo','total', 'porcentaje'];

    public $id;
    public $id_orden;
    public $consumo;
    public $total;
    public $porcentaje;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null;
        $this->consumo = $args['consumo'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->porcentaje = $args['porcentaje'] ?? null;
    }
}



?>