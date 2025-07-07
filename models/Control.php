<?php
namespace Model;

class Control extends ActiveRecord {
    protected static $tabla = 'control_produccion';
    protected static $columnasDB = [
        'id',
        'fecha',
        'turnos',
        'area',
        'operador',
        'horas_programadas',
        'golpes_maquina',
        'golpes_maquina_hora',
        'cambios_medida',
        'cantidad_separadores',
        'cantidad_cajas',
        'cantidad_papel',
        'desperdicio_kg',
        

    ];

    public $id;
    public $fecha;
    public $turnos; 
    public $area;
    public $operador;
    public $horas_programadas;
    public $golpes_maquina;
    public $golpes_maquina_hora;
    public $cambios_medida;
    public $cantidad_separadores;
    public $cantidad_cajas;
    public $cantidad_papel;
    public $desperdicio_kg;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->turnos = $args['turnos'] ?? '';
        $this->area = $args['area'] ?? 'Troquel';
        $this->operador = $args['operador'] ?? '';
        $this->horas_programadas = $args['horas_programadas'] ?? '';
        $this->golpes_maquina = $args['golpes_maquina'] ?? '';
        $this->golpes_maquina_hora = $args['golpes_maquina_hora'] ?? '';
        $this->cambios_medida = $args['cambios_medida'] ?? '';
        $this->cantidad_separadores = $args['cantidad_separadores'] ?? '';
        $this->cantidad_cajas = $args['cantidad_cajas'] ?? '';
        $this->cantidad_papel = $args['cantidad_papel'] ?? '';
        $this->desperdicio_kg = $args['desperdicio_kg'] ?? '';
    }

    public function validar() {
        if(!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        if(!$this->turnos) {
            self::$alertas['error'][] = 'El número de turno es obligatorio';
        }
        if(!$this->area) {
            self::$alertas['error'][] = 'El área es obligatoria';
        }
        if(!$this->operador) {
            self::$alertas['error'][] = 'El operador es obligatorio';
        }
        if(!$this->horas_programadas) {
            self::$alertas['error'][] = 'Las horas programadas son obligatorias';
        }
        if(!$this->golpes_maquina) {
            self::$alertas['error'][] = 'Los golpes de máquina son obligatorios';
        }
       
        if(!$this->cambios_medida) {
            self::$alertas['error'][] = 'Los cambios de medida son obligatorios';
        }
        if(!$this->cantidad_separadores) {
            self::$alertas['error'][] = 'La cantidad de separadores es obligatoria';
        }
        if(!$this->cantidad_cajas) {
            self::$alertas['error'][] = 'La cantidad de cajas es obligatoria';
        }
        if(!$this->cantidad_papel) {
            self::$alertas['error'][] = 'La cantidad de papel es obligatoria';
        }
        if(!$this->desperdicio_kg) {
            self::$alertas['error'][] = 'El desperdicio en Kg es obligatorio';
        }

        return self::$alertas;
    }





}


// function convertirHoraADecimal($hora_string) {
//     list($horas, $minutos) = explode(':', $hora_string);
//     return (int)$horas + ((int)$minutos / 60);
// }


function convertirHoraADecimal($hora) {
    $partes = explode(':', $hora);
    
    // Asegurar que haya 3 partes (hh:mm:ss)
    while (count($partes) < 3) {
        $partes[] = "00";
    }

    list($h, $m, $s) = $partes;

    // Convertir todo a horas decimales
    return (int)$h + ((int)$m / 60) + ((int)$s / 3600);
}

