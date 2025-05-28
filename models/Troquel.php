<?php

namespace Model;

class Troquel extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_troquel';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'COMBADO',
    'MERMA',
    'EXCEDENTES_PLANCHAS',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
  
];


    public $id;
    public $id_orden; // Nuevo campo para almacenar el ID de la orden
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $COMBADO;
    public $MERMA;
    public $EXCEDENTES_PLANCHAS;
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
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->MERMA = $args['MERMA'] ?? '';
        $this->EXCEDENTES_PLANCHAS = $args['EXCEDENTES_PLANCHAS'] ?? '';  
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
        floatval($this->COMBADO) +
        floatval($this->MERMA) +
        floatval($this->EXCEDENTES_PLANCHAS);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    // PORCENTAJE
    // $this->PORCENTAJE = round(($this->TOTAL / 100) * 100, 2); // Assuming you want to calculate percentage based on TOTAL
    return $this->TOTAL;
        
}





public static function sumarTodasLasColumnas()
{
    $columnas = [
        'COMBADO',
        'MERMA',
        'EXCEDENTES_PLANCHAS',
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