<?php

namespace Model;

class Empaque extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_empaque';

protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'GALLET',
    'COMBADO',
    'HUMEDO',
    'FRENO',
    'DESPE',
    'PRESION',
    'ERROM',
    'CUADRE',
    'RECUB',
    'FALTA_TINTA',
    'DERRAME_TINTA',
    'SUSTRATO',
    'MAL_DOBLADO_CEJA',
    'EXCESO_GOMA',
    'CUADRE_SIERRA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $GALLET;
    public $COMBADO;
    public $HUMEDO;
    public $FRENO;
    public $DESPE;
    public $PRESION;
    public $ERROM;
    public $CUADRE;
    public $RECUB;
    public $FALTA_TINTA;
    public $DERRAME_TINTA;
    public $SUSTRATO;
    public $MAL_DOBLADO_CEJA;
    public $EXCESO_GOMA;
    public $CUADRE_SIERRA;    
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->GALLET = $args['GALLET'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->FRENO = $args['FRENO'] ?? '';
        $this->DESPE = $args['DESPE'] ?? '';
        $this->PRESION = $args['PRESION'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->RECUB = $args['RECUB'] ?? '';
        $this->FALTA_TINTA = $args['FALTA_TINTA'] ?? '';
        $this->DERRAME_TINTA = $args['DERRAME_TINTA'] ?? '';
        $this->SUSTRATO = $args['SUSTRATO'] ?? '';
        $this->MAL_DOBLADO_CEJA = $args['MAL_DOBLADO_CEJA'] ?? '';
        $this->EXCESO_GOMA = $args['EXCESO_GOMA'] ?? '';
        $this->CUADRE_SIERRA = $args['CUADRE_SIERRA'] ?? '';
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d');
        
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }








// public function calcularTotal()
// {
//     $this->TOTAL =  
//         floatval($this->GALLET) +
//         floatval($this->COMBADO) +
//         floatval($this->HUMEDO) +
//         floatval($this->FRENO) +
//         floatval($this->DESPE) +
//         floatval($this->PRESION) +
//         floatval($this->ERROM) +
//         floatval($this->CUADRE) +
//         floatval($this->RECUB) +
//         floatval($this->FALTA_TINTA) +
//         floatval($this->DERRAME_TINTA) +
//         floatval($this->SUSTRATO) +
//         floatval($this->MAL_DOBLADO_CEJA) +
//         floatval($this->EXCESO_GOMA) +
//         floatval($this->CUADRE_SIERRA) +
//         floatval($this->CONSUMO);
   
//         $this->TOTAL = round($this->TOTAL, 2);
// }







public static function sumarTodasLasColumnas()
{
    $columnas = [
        'GALLET', 'COMBADO', 'HUMEDO', 'FRENO', 'DESPE',
        'PRESION', 'ERROM', 'CUADRE', 'RECUB', 'FALTA_TINTA',
        'DERRAME_TINTA', 'SUSTRATO', 'MAL_DOBLADO_CEJA', 'EXCESO_GOMA',
        'CUADRE_SIERRA',

        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}





}




