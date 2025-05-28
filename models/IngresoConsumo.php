<?php

namespace Model;

class Consumo extends ActiveRecord {
    protected static $tabla = 'consumo';
    protected static $columnasDB = ['id', 'id_orden', 'consumo'];

    public $id;
    public $id_orden;
    public $consumo;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null;
        $this->consumo = $args['consumo'] ?? null;
    }
}



?>