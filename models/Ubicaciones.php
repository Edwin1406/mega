<?php

namespace Model;

class Ubicaciones extends ActiveRecord {

    protected static $tabla = 'ubicaciones';
    protected static $columnasDB = ['id', 'camion_id','latitud', 'longitud', 'velocidad','hora_registro'];

    public $id;
    public $camion_id;
    public $latitud;
    public $longitud;
    public $velocidad;
    public $hora_registro;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->camion_id = $args['camion_id'] ?? '';
        $this->latitud = $args['latitud'] ?? '';
        $this->longitud = $args['longitud'] ?? '';
        $this->velocidad = $args['velocidad'] ?? '';
        $this->hora_registro = $args['hora_registro'] ?? '';
    }
}
