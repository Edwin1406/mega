<?php

namespace Model;

class Maquinas extends ActiveRecord {
    protected static $tabla = 'maquinas';
    protected static $columnasDB = ['id', 'nombre', 'num_cuchillas', 'ancho_maximo', 'gramaje_maximo','created_at','updated_at'];

    public $id;
    public $nombre;
    public $num_cuchillas;
    public $ancho_maximo;
    public $gramaje_maximo;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->num_cuchillas = $args['num_cuchillas'] ?? '';
        $this->ancho_maximo = $args['ancho_maximo'] ?? '';
        $this->gramaje_maximo = $args['gramaje_maximo'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');  
    }

    public function validar() {

        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Campo Nombre es Obligatorio';
        }

        if(!$this->num_cuchillas) {
            self::$alertas['error'][] = 'El Campo Numero de Cuchillas es Obligatorio';
        }

        if(!$this->ancho_maximo) {
            self::$alertas['error'][] = 'El Campo Ancho Maximo es Obligatorio';
        }

        if(!$this->gramaje_maximo) {
            self::$alertas['error'][] = 'El Campo Gramaje Maximo es Obligatorio';
        }
       
        return self::$alertas;
    }


}