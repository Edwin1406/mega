<?php

namespace Model;

class Guillotina_papel extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_guillotina_papel';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'INICIO_CORRIDA',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at',




  
];


    public $id;
    public $id_orden;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $INICIO_CORRIDA;
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->INICIO_CORRIDA = $args['INICIO_CORRIDA'] ?? '';
        $this->CONSUMO = $args['CONSUMO'] ?? '';
        $this->PORCENTAJE = $args['PORCENTAJE'] ?? '';
        $this->TOTAL = $args['TOTAL'] ?? '';
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
    $inicio_corrida = floatval($this->INICIO_CORRIDA);
    // Si quieres usar el valor de $refiles como total:
    $this->TOTAL = round($inicio_corrida, 2);
    return $this->TOTAL;
}




public static function sumarTodasLasColumnas()
{
    $columnas = [
        'INICIO_CORRIDA', 

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
