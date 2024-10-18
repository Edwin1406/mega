<?php

namespace Model;

class Maquinas extends ActiveRecord {
    protected static $tabla = 'maquinas';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar() {

        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }
       
        return self::$alertas;
    }


}