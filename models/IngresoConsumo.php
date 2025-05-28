<?php

namespace Model;

class IngresoConsumo extends ActiveRecord {
    protected static $tabla = 'ingresos_consumo';
    protected static $columnasDB = ['id', 'id_orden', 'consumo','total', 'porcentaje', 'created_at'];

    public $id;
    public $id_orden;
    public $consumo;
    public $total;
    public $porcentaje;
    public $created_at;


    public function __construct($args = []) {
        date_default_timezone_set('America/Guayaquil');
        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null;
        $this->consumo = $args['consumo'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->porcentaje = $args['porcentaje'] ?? null;
        $this->created_at = date('Y-m-d'); // Establecer la fecha y hora actual
    }
}



?>