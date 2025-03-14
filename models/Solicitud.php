<?php

namespace Model;

class Solicitud extends ActiveRecord {

    protected static $tabla = 'solicitud_inventario';
    protected static $columnasDB = ['id','array'];

    public $id;
    public $array;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->array = $args['array'] ?? '';
  
    }




}