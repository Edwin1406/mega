<?php
namespace Model;

class Citas extends ActiveRecord {
    protected static $tabla = 'citas';
    protected static $columnasDB = [
        'id',
        'nombre_paciente',
        'fecha',
        'hora',
        'telefono',
        'doctor',
        'asunto'
    ];

    public $id;
    public $nombre_paciente;
    public $fecha;
    public $hora;
    public $telefono;
    public $doctor;
    public $asunto;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre_paciente = $args['nombre_paciente'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->doctor = $args['doctor'] ?? '';
        $this->asunto = $args['asunto'] ?? '';
    }
}
