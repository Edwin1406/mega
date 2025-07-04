<?php

namespace Model;

class Desflexografica extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_flexografica';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'CUADRE',
    'FALTA_TINTA',
    'MALTRATO_TRASPORT',
    'MALTRATO_MONTACARGAS',
    'TONALIDAD_TINTAS',
    'TROQUEL',
    'MONTAJE_CLICHE',
    'MECANICO',
    'ELECTRICO',
    'GALLET',
    'COMBADO',
    'HUMEDO',
    'DESPE',
    'ERROM',
    'SUSTRATO',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
  
];


    public $id;
    public $id_orden; // Nuevo campo para almacenar el ID de la orden
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $CUADRE;
    public $FALTA_TINTA;
    public $MALTRATO_TRASPORT;
    public $MALTRATO_MONTACARGAS;
    public $TONALIDAD_TINTAS;
    public $TROQUEL;
    public $MONTAJE_CLICHE;
    public $MECANICO;
    public $ELECTRICO;
    public $GALLET;
    public $COMBADO;
    public $HUMEDO;
    public $DESPE;
    public $ERROM;
    public $SUSTRATO;
    public $CONSUMO;
    public $TOTAL;
    public $PORCENTAJE;
    public $created_at;

    
   

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Guayaquil');

        $this->id = $args['id'] ?? null;
        $this->id_orden = $args['id_orden'] ?? null; // Asignar el ID de la orden
        $this->tipo_maquina = $args['tipo_maquina'] ?? '';
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->FALTA_TINTA = $args['FALTA_TINTA'] ?? '';
        $this->MALTRATO_TRASPORT = $args['MALTRATO_TRASPORT'] ?? '';
        $this->MALTRATO_MONTACARGAS = $args['MALTRATO_MONTACARGAS'] ?? '';
        $this->TONALIDAD_TINTAS = $args['TONALIDAD_TINTAS'] ?? '';
        $this->TROQUEL = $args['TROQUEL'] ?? '';
        $this->MONTAJE_CLICHE = $args['MONTAJE_CLICHE'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->ELECTRICO = $args['ELECTRICO'] ?? '';
        $this->GALLET = $args['GALLET'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->DESPE = $args['DESPE'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        $this->SUSTRATO = $args['SUSTRATO'] ?? '';   
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
        floatval($this->FALTA_TINTA) +
        floatval($this->MALTRATO_TRASPORT) +
        floatval($this->MALTRATO_MONTACARGAS) +
        floatval($this->TONALIDAD_TINTAS) +
        floatval($this->TROQUEL) +
        floatval($this->MONTAJE_CLICHE) +
        floatval($this->MECANICO) +
        floatval($this->ELECTRICO) +
        floatval($this->GALLET) +
        floatval($this->COMBADO) +
        floatval($this->HUMEDO) +
        floatval($this->DESPE) +
        floatval($this->ERROM) +
        floatval($this->SUSTRATO);
   
    // 
    $this->TOTAL = number_format($this->TOTAL, 2, '.', '');
    return $this->TOTAL;
        
}






public static function sumarTodasLasColumnas()
{
    $columnas = [
        'CUADRE', 'FALTA_TINTA', 'MALTRATO_TRASPORT', 'MALTRATO_MONTACARGAS',
        'TONALIDAD_TINTAS', 'TROQUEL', 'MONTAJE_CLICHE', 'MECANICO', 'ELECTRICO',
        'GALLET', 'COMBADO', 'HUMEDO', 'DESPE', 'ERROM', 'SUSTRATO',

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