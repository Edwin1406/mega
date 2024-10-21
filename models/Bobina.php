<?php

namespace Model;

class Bobina extends ActiveRecord
{
    protected static $tabla = 'bobina';
    protected static $columnasDB = ['id', 'tipo_papel', 'gramaje', 'ancho','created_at','updated_at'];

    public $id;
    public $tipo_papel;
    public $gramaje;
    public $ancho;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipo_papel = $args['tipo_papel'] ?? '';
        $this->gramaje = $args['gramaje'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
    }


    
    public function validar() {

        if(!$this->tipo_papel) {
            self::$alertas['error'][] = 'El Campo Area es Obligatorio';
        }

        if(!$this->gramaje) {
            self::$alertas['error'][] = 'El Campo Area es Obligatorio';
        }

        if(!$this->ancho) {
            self::$alertas['error'][] = 'El Campo Area es Obligatorio';
        }
        return self::$alertas;
    }


}