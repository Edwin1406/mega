<?php

namespace Model;

class Doblado extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_doblado';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'MAL_DOBLADO_CEJA',
    'EXCESO_GOMA',
    'DESCUADRE_DOBLADO',
    'LAM_HUMEDA',
    'LAM_SECA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
  
];


    public $id;
    public $id_orden; // Nuevo campo para almacenar el ID de la orden
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $MAL_DOBLADO_CEJA;
    public $EXCESO_GOMA;
    public $DESCUADRE_DOBLADO;
    public $LAM_HUMEDA;
    public $LAM_SECA;
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null; // Inicializar el ID de la orden
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->MAL_DOBLADO_CEJA = $args['MAL_DOBLADO_CEJA'] ?? '';
        $this->EXCESO_GOMA = $args['EXCESO_GOMA'] ?? '';
        $this->DESCUADRE_DOBLADO = $args['DESCUADRE_DOBLADO'] ?? '';
        $this->LAM_HUMEDA = $args['LAM_HUMEDA'] ?? '';
        $this->LAM_SECA = $args['LAM_SECA'] ?? '';
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->created_at = date('Y-m-d');
    }


    
    public function validar() {

        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El Campo Tipo papel es Obligatorio';
        }
       
        
        return self::$alertas;
    }

public function calcularTotal()
{
    $this->TOTAL =  
        floatval($this->MAL_DOBLADO_CEJA) +
        floatval($this->EXCESO_GOMA) +
        floatval($this->DESCUADRE_DOBLADO) +
        floatval($this->LAM_HUMEDA) +
        floatval($this->LAM_SECA);

           $this->TOTAL = round($this->TOTAL, 2);
 
    // PORCENTAJE
    // $this->PORCENTAJE = ($this->TOTAL / 100) * 100;
    return $this->TOTAL;
        
}






public static function sumarTodasLasColumnas()
{
    $columnas = [
         'MAL_DOBLADO_CEJA',
        'EXCESO_GOMA', 'DESCUADRE_DOBLADO', 'LAM_HUMEDA','LAM_SECA',
        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}

public function generarIdUnico()
{
    $this->id_orden = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
    return $this->id_orden;
}



}
