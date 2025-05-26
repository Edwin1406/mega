<?php

namespace Model;

class Convertidor extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_convertidor';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE',
    'CAMBIO_MEDIDA',
    'DIFERENCIA_PESO',
    'FILOS_ROTOS',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
  
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $CUADRE;
    public $CAMBIO_MEDIDA;
    public $DIFERENCIA_PESO;
    public $FILOS_ROTOS;
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
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->CAMBIO_MEDIDA = $args['CAMBIO_MEDIDA'] ?? '';
        $this->DIFERENCIA_PESO = $args['DIFERENCIA_PESO'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';  
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
        floatval($this->CUADRE) +
        floatval($this->CAMBIO_MEDIDA) +
        floatval($this->DIFERENCIA_PESO) +
        floatval($this->FILOS_ROTOS);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    // $this->PORCENTAJE = ($this->TOTAL / 100) * 100;
    return $this->TOTAL;
        
}




public static function sumarTodasLasColumnas()
{
    $columnas = [
         'CUADRE', 'CAMBIO_MEDIDA', 'DIFERENCIA_PESO', 'FILOS_ROTOS',
                          'CONSUMO', 'TOTAL', 'PORCENTAJE',
        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}




}