<?php

namespace Model;

class Bobina extends ActiveRecord
{
    
protected static $tabla = 'desperdicio_papel';
protected static $columnasDB = [
    'id',
    'tipo_maquina',
    'tipo_clasificacion',
    // CONTROLABLE
    'SINGLEFACE',
    'EMPALME',
    'RECUB',
    'GALLET',
    'HUMEDO',
    'COMBADO',
    'DESPE',
    'ERROM',
    // NO CONTROLABLE
    'DESHOJE',
    'MECANICO',
    'ELECTRICO',
    'FILOS_ROTOS',
    'REFILE_PEQUENO',
    'PEDIDOS_CORTOS',
    'DIFER_ANCHO',
    'SUSTRATO',
    'CAMBIO_GRAMAJE',
    'CAMBIO_PEDIDO',
    'EXTRA_TRIM',
    'CONSUMO',
    'TOTAL',
    'PORCENTAJE',
    'created_at'
];


    public $id;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $SINGLEFACE;
    public $EMPALME;
    public $RECUB;
    public $GALLET;
    public $HUMEDO;
    public $COMBADO;
    public $DESPE;
    public $ERROM;
    // NO CONTROLABLE
    public $DESHOJE;
    public $MECANICO;
    public $ELECTRICO;
    public $FILOS_ROTOS;
    public $REFILE_PEQUENO;
    public $PEDIDOS_CORTOS;
    public $DIFER_ANCHO;
    public $SUSTRATO;
    public $CAMBIO_GRAMAJE;
    public $CAMBIO_PEDIDO;
    public $EXTRA_TRIM;
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
        $this->SINGLEFACE = $args['SINGLEFACE'] ?? '';
        $this->EMPALME = $args['EMPALME'] ?? '';
        $this->RECUB = $args['RECUB'] ?? '';
        $this->GALLET = $args['GALLET'] ?? '';
        $this->HUMEDO = $args['HUMEDO'] ?? '';
        $this->COMBADO = $args['COMBADO'] ?? '';
        $this->DESPE = $args['DESPE'] ?? '';
        $this->ERROM = $args['ERROM'] ?? '';
        // NO CONTROLABLE
        $this->DESHOJE = $args['DESHOJE'] ?? '';
        $this->MECANICO = $args['MECANICO'] ?? '';
        $this->ELECTRICO = $args['ELECTRICO'] ?? '';
        $this->FILOS_ROTOS = $args['FILOS_ROTOS'] ?? '';
        $this->REFILE_PEQUENO = $args['REFILE_PEQUENO'] ?? '';
        $this->PEDIDOS_CORTOS = $args['PEDIDOS_CORTOS'] ?? '';
        $this->DIFER_ANCHO = $args['DIFER_ANCHO'] ?? '';
        $this->SUSTRATO = $args['SUSTRATO'] ?? '';
        $this->CAMBIO_GRAMAJE = $args['CAMBIO_GRAMAJE'] ?? '';
        $this->CAMBIO_PEDIDO = $args['CAMBIO_PEDIDO'] ?? '';
        $this->EXTRA_TRIM = $args['EXTRA_TRIM'] ?? '';
    
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



public static function sumarTodasLasColumnas()
{
    $columnas = [
        'SINGLEFACE', 'EMPALME', 'RECUB', 'MECANICO', 'GALLET',
        'HUMEDO', 'COMBADO', 'DESPE', 'ERROM', 'DESHOJE',
        'CAMBIO_PEDIDO', 'FILOS_ROTOS', 'OTROS', 'PEDIDOS_CORTOS',
        'DIFER_ANCHO', 'CAMBIO_GRAMAJE', 'EXTRA_TRIM',
        'CONSUMO', 'TOTAL', 'PORCENTAJE'
    ];

    $columnasEscapadas = array_map(fn($col) => "`" . self::$db->real_escape_string($col) . "`", $columnas);
    $query = "SELECT " . implode(", ", array_map(fn($col) => "SUM($col) AS $col", $columnasEscapadas)) . " FROM " . static::$tabla;

    $resultado = self::$db->query($query);
    return $resultado->fetch_assoc();
}




public function calcularTotal()
{
    $this->TOTAL =  
        floatval($this->SINGLEFACE) +
        floatval($this->EMPALME) +
        floatval($this->RECUB) +
        floatval($this->MECANICO) +
        floatval($this->GALLET) +
        floatval($this->HUMEDO) +
        floatval($this->COMBADO) +
        floatval($this->DESPE) +
        floatval($this->ERROM) +
        floatval($this->DESHOJE) +
        floatval($this->CAMBIO_PEDIDO) +
        floatval($this->FILOS_ROTOS) +
        floatval($this->OTROS) +
        floatval($this->PEDIDOS_CORTOS) +
        floatval($this->DIFER_ANCHO) +
        floatval($this->CAMBIO_GRAMAJE) +
        floatval($this->EXTRA_TRIM);
}




}