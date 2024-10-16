<?php

namespace Model;

class Provvedor extends ActiveRecord {

    protected static $tabla = 'proveedor';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'ciudad'];

    public $id;
    public $nombre;
    public $apellido;
    public $ciudad;
   


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
  
    }



    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->ciudad) {
            self::$alertas['error'][] = 'El Campo Ciudad es Obligatorio';
        }
       
    
        return self::$alertas;
    }


}