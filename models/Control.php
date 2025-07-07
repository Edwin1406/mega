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
function convertirHoraADecimalExcel($hora) {
    // Separar horas, minutos y segundos
    $partes = explode(':', $hora);

    // Completar partes faltantes con "00"
    while (count($partes) < 3) {
        $partes[] = "00";
    }

    list($h, $m, $s) = $partes;

    // Convertir todo a decimal
    return (int)$h + ((int)$m / 60) + ((int)$s / 3600);
}

// Calcular golpes por hora como en Excel
if (!empty($control->horas_programadas) && !empty($control->golpes_maquina)) {
    $horas_decimal = convertirHoraADecimalExcel($control->horas_programadas);

    if ($horas_decimal > 0) {
        $resultado = $control->golpes_maquina / (($horas_decimal * 1440) / 60);

        // ✅ Convertir a entero como en Excel
        $control->golpes_maquina_hora = intval(round($resultado));
    } else {
        $control->golpes_maquina_hora = 0;
    }
} else {
    $control->golpes_maquina_hora = 0;
}



