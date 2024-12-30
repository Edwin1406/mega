<?php

namespace Model;

class MateriaPrima extends ActiveRecord
{
    protected static $tabla = 'materias_prima';
    protected static $columnasDB = ['id', 'tipo', 'ancho','barcode','peso','created_at'];

    public $id;
    public $tipo;
    public $ancho;
    public $barcode;
    public $peso;
    public $created_at;

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
        $this->ancho = $args['ancho'] ?? '';
        $this->barcode = $args['barcode'] ?? '';
        $this->peso = $args['peso'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    }


    public function validar() {

        if(!$this->tipo) {
            self::$alertas['error'][] = 'El Campo Tipo es Obligatorio';
        }

        if(!$this->ancho) {
            self::$alertas['error'][] = 'El Campo Ancho  es Obligatorio';
        }

        if(!$this->peso) {
            self::$alertas['error'][] = 'El Campo Peso es Obligatorio';
        }

        return self::$alertas;

    }



}



?>