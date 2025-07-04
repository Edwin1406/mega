<?php

namespace Model;

class Corte_ceja extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_corte_ceja';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE_SIERRA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
  
];


    public $id;
    public $id_orden; // Nuevo campo para almacenar el ID de la orden
    public $tipo_maquina;
    public $tipo_clasificacion;
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
        $this->CUADRE_SIERRA = $args['CUADRE_SIERRA'] ?? '';
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
    $cuadreSierra = floatval($this->CUADRE_SIERRA);

    $this->TOTAL = round($cuadreSierra, 2);
    // $this->PORCENTAJE = round(($cuadreSierra / 100) * 100, 2); // Assuming you want to calculate percentage based on CUADRE_SIERRA
    return $this->TOTAL;
}




public static function sumarTodasLasColumnas()
{
    $columnas = [
         'CUADRE_SIERRA',
        'CONSUMO', 'TOTAL', 'PORCENTAJE',
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



public static function find_orden($id_orden) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id_orden = ?";
    $stmt = self::$db->prepare($query);
    $stmt->bind_param('s', $id_orden);  // 's' = string. Usa 'i' si es integer.
    $stmt->execute();

    $resultado = $stmt->get_result();
    $registros = [];

    while ($fila = $resultado->fetch_assoc()) {
        $registros[] = $fila;
    }

    return $registros;
}


}
