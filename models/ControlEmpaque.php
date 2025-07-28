<?php
namespace Model;

use DateTime;

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
        'total_horas',
        'x_hora'

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
    public $x_hora;

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
        $this->x_hora = $args['x_hora'] ?? '';
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

    public function sacarTotalHoras() {
        $inicio = new DateTime($this->hora_inicio);
        $fin = new DateTime($this->hora_fin);
        $diferencia = $inicio->diff($fin);
        $this->total_horas = $diferencia->h + ($diferencia->i / 60);
    }



  
 public function convertirHorasADecimal($horas) {
    $horas = trim($horas); // eliminar espacios alrededor
    $partes = explode(':', $horas);
    
    if (count($partes) !== 2 || !is_numeric($partes[0]) || !is_numeric($partes[1])) {
        return 0; // Formato incorrecto
    }

    $horasDecimal = (int)$partes[0] + ((int)$partes[1] / 60);
    return $horasDecimal;
}



}