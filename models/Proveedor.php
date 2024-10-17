<?php

namespace Model;

class Proveedor extends ActiveRecord {

    protected static $tabla = 'area';
    protected static $columnasDB = ['id', 'area', 'url', 'propietarioId'];

    public $id;
    public $area;
    public $url;
    public $propietarioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->area = $args['area'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
  
    }



    public function validar() {

        if(!$this->area) {
            self::$alertas['error'][] = 'El Campo Area es Obligatorio';
        }
       
        return self::$alertas;
    }


}