<?php
namespace Model;

class ControlEmpaque extends ActiveRecord {
    protected static $tabla = 'control_empaque';
    protected static $columnasDB = [
        'id',
        'fecha',
        'turno',
        'personal',
        'producto',
        'medidas',
        'cantidad',
        'hora_inicio',
        'hora_fin',
        'total_horas'

    ];

    public $id;
    public $fecha;
    public $turno;
    public $personal;
    public $producto;
    public $medidas;
    public $cantidad;
    public $hora_inicio;
    public $hora_fin;
    public $total_horas;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->turno = $args['turno'] ?? '';
        $this->personal = $args['personal'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->medidas = $args['medidas'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->hora_inicio = $args['hora_inicio'] ?? '';
        $this->hora_fin = $args['hora_fin'] ?? '';
        $this->total_horas = $args['total_horas'] ?? '';
    }

    public function validar() {
        if(!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        if(!$this->turno) {
            self::$alertas['error'][] = 'El turno es obligatorio';
        }
        if(!$this->personal) {
            self::$alertas['error'][] = 'El personal es obligatorio';
        }
        if(!$this->producto) {
            self::$alertas['error'][] = 'El producto es obligatorio';
        }
        if(!$this->medidas) {
            self::$alertas['error'][] = 'Las medidas son obligatorias';
        }
        if(!$this->cantidad || $this->cantidad <= 0) {
            self::$alertas['error'][] = 'La cantidad debe ser mayor a 0';
        }
        if(!$this->hora_inicio) {
            self::$alertas['error'][] = 'La hora de inicio es obligatoria';
        }
        if(!$this->hora_fin) {
            self::$alertas['error'][] = 'La hora de fin es obligatoria';
        }

        return self::$alertas;
    }

    







}