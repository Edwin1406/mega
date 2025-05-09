<?php

namespace Model;

class Bobina extends ActiveRecord
{
    
    protected static $tabla = 'bobinas';
    protected static $columnasDB = ['id', 'tipo_papel', 'gramaje', 'ancho','qr','cantidad','created_at','updated_at'];

    public $id;
    public $tipo_papel;
    public $gramaje;
    public $ancho;
    public $qr;
    public $cantidad;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_papel = $args['tipo_papel'] ?? '';
        $this->gramaje = $args['gramaje'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->qr = $args['qr'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');        
    }


    
    public function validar() {

        if(!$this->tipo_papel) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }

        if(!$this->gramaje) {
            self::$alertas['error'][] = 'El Campo Gramaje es Obligatorio';
        }

        if(!$this->ancho) {
            self::$alertas['error'][] = 'El Campo Ancho es Obligatorio';
        }
        return self::$alertas;
    }


}