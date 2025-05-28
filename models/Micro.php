<?php

namespace Model;

class Micro extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_micro';
protected static $columnasDB = [
    'id',
    'id_orden',
    'tipo_maquina',
    'tipo_clasificacion',
    'GALLET',
    'COMBADO',
    'HUMEDO',
    'FRENO',
    'DESPE',
    'PRESION',
    'ERROM',
    'SINGLEFACE',
    'CUADRE',
    'EMPALME',
    'RECUB',
    'PREPRINTER',
    'DESHOJE',
    'FILOS_ROTOS',
    'ELECTRICO',
    'MECANICO',
    'PEDIDOS_CORTOS',
    'DIFER_ANCHO',
    'REFILE_PEQUENO',
    'CAMBIO_GRAMAJE',
    'EXTRA_TRIM',
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
    public $GALLET;
    public $COMBADO;
    public $HUMEDO;
    public $FRENO;
    public $DESPE;
    public $PRESION;
    public $ERROM;
    public $SINGLEFACE;
    public $CUADRE;
    public $EMPALME;
    public $RECUB;
    public $PREPRINTER;
    public $DESHOJE;
    public $FILOS_ROTOS;
    public $ELECTRICO;
    public $MECANICO;
    public $PEDIDOS_CORTOS;
    public $DIFER_ANCHO;
    public $REFILE_PEQUENO;
    public $CAMBIO_GRAMAJE;
    public $EXTRA_TRIM;
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
        $this->GALLET = $args['GALLET'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->FRENO = $args['FRENO'] ?? '';
        $this->DESPE = $args['DESPE'] ?? '';
        $this->PRESION = $args['PRESION'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        $this->SINGLEFACE = $args['SINGLEFACE'] ?? '';
        $this->CUADRE = $args['CUADRE'] ?? '';
        $this->EMPALME = $args['EMPALME'] ?? '';
        $this->RECUB = $args['RECUB'] ?? '';
        $this->PREPRINTER = $args['PREPRINTER'] ?? '';
        $this->DESHOJE = $args['DESHOJE'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';
        $this->ELECTRICO = $args['ELECTRICO'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->PEDIDOS_CORTOS = $args['PEDIDOS_CORTOS'] ?? '';
        $this->DIFER_ANCHO = $args['DIFER_ANCHO'] ?? '';
        $this->REFILE_PEQUENO = $args['REFILE_PEQUENO'] ?? '';
        $this->CAMBIO_GRAMAJE = $args['CAMBIO_GRAMAJE'] ?? '';
        $this->EXTRA_TRIM = $args['EXTRA_TRIM'] ?? '';
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
        floatval($this->GALLET) +
        floatval($this->COMBADO) +
        floatval($this->HUMEDO) +
        floatval($this->FRENO) +
        floatval($this->DESPE) +
        floatval($this->PRESION) +
        floatval($this->ERROM) +
        floatval($this->SINGLEFACE) +
        floatval($this->CUADRE) +
        floatval($this->EMPALME) +
        floatval($this->RECUB) +
        floatval($this->PREPRINTER) +
        floatval($this->DESHOJE) +
        floatval($this->FILOS_ROTOS) +
        floatval($this->ELECTRICO) +
        floatval($this->MECANICO) +
        floatval($this->PEDIDOS_CORTOS) +
        floatval($this->DIFER_ANCHO) +
        floatval($this->REFILE_PEQUENO) +
        floatval($this->CAMBIO_GRAMAJE) +
        floatval($this->EXTRA_TRIM) +
        floatval($this->SUSTRATO);
    // $this->TOTAL = number_format($this->TOTAL, 2);
    $this->TOTAL = round($this->TOTAL, 2);
    // PPORCENTAJE
    // $this->PORCENTAJE = round(($this->TOTAL / 100) * 100, 2);
    return $this->TOTAL;
        
}






public static function sumarTodasLasColumnas()
{
    $columnas = [
        'GALLET', 'COMBADO', 'HUMEDO', 'FRENO',
        'DESPE', 'PRESION', 'ERROM', 'SINGLEFACE',
        'CUADRE', 'EMPALME', 'RECUB', 'PREPRINTER',
        'DESHOJE', 'FILOS_ROTOS', 'ELECTRICO', 'MECANICO',
        'PEDIDOS_CORTOS', 'DIFER_ANCHO', 'REFILE_PEQUENO',
        'CAMBIO_GRAMAJE', 'EXTRA_TRIM', 'SUSTRATO',
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